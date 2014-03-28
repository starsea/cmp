<?php

namespace Site\Bundle\PlatformBundle\Form;

use Site\Bundle\PlatformBundle\lib\MyConst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('department', 'choice', array(
                'choices' => MyConst::$departmentZhArr,
                'label' => '部门',
                'empty_value' => '-请选择部门-',
                'empty_data' => ''
            ))
            ->add('location', 'choice', array(
                'choices' => MyConst::$officeLocationZhArr,
                'label' => '办公地点',
                'empty_value' => '-请选择办公地点-',
                'empty_data' => ''
            ))
            ->add('hupuAccount')
            ->add('password', 'repeated', array(
                'required' => false,
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
            ))
//            ->add('password', 'password', array(
//                //'required' => false,
//                'always_empty'=>false,
//            ))
            ->add('phone')
            ->add('email');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\Bundle\PlatformBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_bundle_platformbundle_user';
    }
}
