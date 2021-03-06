<?php

namespace Site\Bundle\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\Container;
use Site\Bundle\PlatformBundle\lib\MyConst;

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
                'choices' => MyConst::$sportsZhArr,
                'required' => false,
                'label' => '状态',
                'empty_value' => '-运动项目-',
                'empty_data' => null
            ))
            ->add('updateTimeMin', 'text', array(
                'required' => false,
                'attr'=> array('onclick'=>'calendar.show(this);')
            ))
            ->add('updateTimeMax', 'text', array(
                'required' => false,
                'attr'=> array('onclick'=>'calendar.show(this);')
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
