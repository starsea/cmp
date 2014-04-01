<?php

namespace Site\Bundle\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     *
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function indexAction()
    {


        $recent = $this->generateUrl('recent');

        $login = $this->generateUrl('login');

        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($recent);

        }else{
            return $this->redirect($login);
        }


    }

}
