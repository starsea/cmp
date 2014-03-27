<?php

namespace Site\Bundle\PlatformBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Site\Bundle\PlatformBundle\lib\MyConst;

class RequirementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('sports', 'choice', array(
                'choices' => MyConst::$sportsZhArr,
                //'required' => false,
                'label' => '运动项目',
                'empty_value' => '-请选择-',
                'empty_data' => null
            ))
            ->add('companyType', 'choice', array(
                'choices' => MyConst::$companyTypeZhArr,
                //  'required' => false,
                'label' => '单位性质',
                'empty_value' => '-请选择-',
                'empty_data' => ''
            ))
            ->add('country', 'hidden')
            ->add('province', 'hidden')
            ->add('city', 'hidden')
            ->add('description')
            // ->add('updateTime')
            ->add('reportTime')
            ->add('department', 'choice', array(
                'choices' => MyConst::$departmentZhArr,
                // 'required' => false,
                'label' => '部门',
                'empty_value' => '-请选择-',
                'empty_data' => 'ss'
            ))
            ->add('contact', 'entity', array(
                'class' => 'SitePlatformBundle:User',
                'property' => 'name',
                'query_builder' => function (EntityRepository $repository) {
                        return $repository->createQueryBuilder('u');
                    }));
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\Bundle\PlatformBundle\Entity\Requirement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_bundle_platformbundle_requirement';
    }
}
