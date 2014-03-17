<?php

namespace Site\Bundle\PlatformBundle\Form;

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
            ->add('company')
            ->add('background')
            ->add('description')
            ->add('startTime')
            ->add('endTime')
            ->add('status')
            ->add('category')
            ->add('initiator')
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
