<?php

namespace Site\Bundle\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\Bundle\PlatformBundle\Entity\Requirement;
use Symfony\Component\DependencyInjection\Container;

class CommonController extends Controller
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    public function createSearchForm($defaultData)
    {
        //list search form
        $form = $this->createFormBuilder($defaultData)

            ->add('sports', 'choice', array(
                'choices' => Requirement::$sportsZhArr,
                'required' => false,
                'label' => '状态',
                'empty_value' => '-运动项目-',
                'empty_data' => null
            ))
            ->add('updateTimeMin', 'date', array(
                'widget' => 'single_text',
                'required' => false,
            ))
            ->add('updateTimeMax', 'date', array(
                'widget' => 'single_text',
                'required' => false,
            ))
            ->add('country', 'choice', array(
                'required' => false,
                'empty_value' => '-运动项目-',
                'empty_data' => null
            ))
            ->add('province', 'choice', array(
                'required' => false,
            ))
            ->add('city', 'choice', array(
                'required' => false,
            ))
            ->add('keywords', 'text', array(
                'required' => false,
                'empty_data' => ''

            ))

//            ->add('time', new TestType(), array(
//                'data_class' => 'Site\\Bundle\\PlatformBundle\\Entity\\Requirement'
//            ))

            ->getForm();

        return $form->createView();
    }

    public function navigationAction()
    {

    }

}
