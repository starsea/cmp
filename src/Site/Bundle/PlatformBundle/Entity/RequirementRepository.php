<?php

namespace Site\Bundle\PlatformBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RequirementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RequirementRepository extends EntityRepository
{

    //需求搜索列表
    public function search($data, $offset = null, $limit = null)
    {
        $qb = $this->createQueryBuilder('i');


        foreach ($data as $field => $value) {

            // like  fuck this...
            if (in_array($field, array('keywords', 'subject', 'description'))) {
//                $qb->andWhere('i.' . $field . ' like ' . ':' . $field)
//                    ->setParameter($field, '%' . $value . '%');
                $qb->andWhere("i.subject like '%{$value}%' or i.description like '%{$value}%'");
                continue;
            }
            // 时间范围搜索
            if (in_array($field, array('updateTimeMin', 'updateTimeMax'))) {

                if ($field == 'updateTimeMin') {
                    $operator = '>=';
                } else {
                    $value = date('Y-m-d', strtotime($value) + 86400 );

                    $operator = '<';
                }
                $qb->andWhere('i.' . 'updateTime' . " {$operator} " . ':' . $field)
                    ->setParameter($field, $value);
                continue;
            }

            //filter
            if (!$this->getClassMetadata()->hasField($field)) {
                continue;
            }

            $qb->andWhere($qb->expr()->eq('i.' . $field, ':' . $field))
                ->setParameter($field, $value);
        }

        $qb->addOrderBy('i.updateTime', 'DESC');
            //->setMaxResults($limit)
            //->setFirstResult($offset);

        //var_dump( $qb->getQuery()->getParameters());
        return $qb->getQuery()->getResult();
    }
}
