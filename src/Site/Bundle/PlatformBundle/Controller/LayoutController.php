<?php

namespace Site\Bundle\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
class LayoutController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function navigationAction()
    {
        var_dump($this->getRequest()->get('_controller'));
        return array(
            'controller'=>'recent'
        );
    }
}
