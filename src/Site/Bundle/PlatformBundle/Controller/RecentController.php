<?php

namespace Site\Bundle\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Requirement controller.
 *
 * @Route("/recent")
 */
class RecentController extends Controller
{
    /**
     * @Route("/",name="recent")
     * @Template()
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $requirements = $em->getRepository('SitePlatformBundle:Requirement')->findBy(
            array(),
            array('updateTime' => 'DESC'),
            20
        );

        $resources = $em->getRepository('SitePlatformBundle:Resource')->findBy(
            array(),
            array('updateTime' => 'DESC'),
            20
        );

        return array(
            'requirements' => $requirements,
            'resources' => $resources,
        );
    }

}
