<?php

namespace Site\Bundle\PlatformBundle\Form;

use Doctrine\ORM\EntityRepository;
use Site\Bundle\PlatformBundle\Entity\Requirement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
                'choices' => Requirement::$sportsZhArr,
                'required' => false,
                'label' => '状态',
                'empty_value' => '-运动项目-',
                'empty_data' => null
            ))
            ->add('company')
            ->add('country')
            ->add('province')
            ->add('city')
            ->add('description')
           // ->add('updateTime')
            ->add('reportTime')
            ->add('department')
            ->add('contact', 'entity', array(
                'class' => 'SitePlatformBundle:User',
                'property' => 'name',
                'query_builder' => function (EntityRepository $repository) {
                        return $repository->createQueryBuilder('u')
                           ;
                    }))
        ;
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
