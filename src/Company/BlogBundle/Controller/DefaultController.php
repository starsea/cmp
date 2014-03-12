<?php

namespace Company\BlogBundle\Controller;

use Company\BlogBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }


    /**
     * @Route("/test")
     *
     */
    public function createAction()
    {
        $user = new User();
        $user->setEmail('fuck@hupu.com');
        $user->setFirstName('deng');
        $user->setLastName('xinghai');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('Created product id ' . $user->getId());

    }


    /**
     *
     * @Route("/show/{id}",requirements={"id" = "\d+"}, defaults={"id" = 1})
     * @Template()
     */

    public function showAction($id)
    {
        $userInfos = $this->getDoctrine()
            ->getRepository('CompanyBlogBundle:User')
            ->findAll();

        //$list=$this->getDoctrine()->getManager()->getRepository('CompanyBlogBundle:User')->findAllByTime();

        return array('userInfos'=>$userInfos);

    }
}
