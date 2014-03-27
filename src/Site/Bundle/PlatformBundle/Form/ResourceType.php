<?php

namespace Site\Bundle\PlatformBundle\Form;

use Doctrine\ORM\EntityRepository;
use Site\Bundle\PlatformBundle\Entity\Requirement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResourceType extends AbstractType
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
                'choices' => Requirement::$sportsZhArr,
                //'required' => false,
                'label' => '运动项目',
                'empty_value' => '-请选择-',
                'empty_data' => null
            ))
            ->add('companyType', 'choice', array(
                'choices' => Requirement::$companyTypeZhArr,
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
                'choices' => Requirement::$departmentZhArr,
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
            'data_class' => 'Site\Bundle\PlatformBundle\Entity\Resource'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_bundle_platformbundle_resource';
    }
}
