<?php

namespace Site\Bundle\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\Bundle\PlatformBundle\Entity\Requirement;
use Site\Bundle\PlatformBundle\Form\RequirementType;

/**
 * Requirement controller.
 *
 * @Route("/requirement")
 */
class RequirementController extends Controller
{


    /**
     * Lists all Requirement entities.
     *
     * @Route("/", name="requirement")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $requirement = new Requirement();

        //list search form
        $form = $this->createFormBuilder($requirement)
            ->add('subject', 'text', array(
                'required' => false,
                'label' => '需求主题',
            ))
            ->add('company', 'text', array('required' => false))
            ->add('status', 'choice', array(
                'choices' => $requirement::$statusZhArr,
                'required' => false,
                'empty_value' => '当前状态',
                'empty_data' => null
            ))
            ->add('startTime','date',array(
                'widget' => 'single_text',
                'required' => false,
            ))
            ->add('endTime','date',array(
                'widget' => 'single_text',
                'required' => false,
            ))
            ->add('background','country',array(
                'required' => false,
            ))
            ->getForm();


        if (!$request->query->get('form')) {

            $entities = $em->getRepository('SitePlatformBundle:Requirement')->findAll();

        } else {
            var_dump($request->query->get('form'));
            $params = array_filter($request->query->get('form'));

            $entities = $em->getRepository('SitePlatformBundle:Requirement')->getListBy($params);
        };


        return array(
            'entities' => $entities,
            'form' => $form->createView(),
        );

    }


    /**
     * search all Requirement entities.
     *
     * @Route("/search", name="requirement_search")
     * @Method("GET")
     * @Template()
     */
    public function searchAction(Request $request)
    {

        $params = array_filter($request->query->get('form'));

//        var_dump($request->query->get('form'));
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SitePlatformBundle:Requirement')->getListBy($params);

        $requirement = new Requirement();

        //list search form
        $form = $this->createFormBuilder($requirement)
            ->add('subject', 'text', array('required' => false))
            ->add('company', 'text', array('required' => false))
            ->add('status', 'choice', array(
                'choices' => $requirement::$statusZhArr,
                'required' => false,
                'empty_value' => '当前状态',
                'empty_data' => null
            ))
            ->getForm();

        return array(
            'entities' => $entities,
            'form' => $form->createView(),
        );

    }


    /**
     * Creates a new Requirement entity.
     *
     * @Route("/", name="requirement_create")
     * @Method("POST")
     * @Template("SitePlatformBundle:Requirement:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Requirement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('requirement_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Requirement entity.
     *
     * @param Requirement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Requirement $entity)
    {
        $form = $this->createForm(new RequirementType(), $entity, array(
            'action' => $this->generateUrl('requirement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Requirement entity.
     *
     * @Route("/new", name="requirement_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Requirement();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     *
     * @Route("/test", name="requirement_test")
     * @Method("GET")
     * @Template()
     */
    public function testAction()
    {
        $task = new Requirement();

        $task->setSubject('aaaa');
        $form = $this->createFormBuilder($task)
            ->add('subject')
            ->add('company')
            ->add('background')
            ->add('description')
            ->add('startTime')
            ->add('endTime')
            ->add('status', 'choice', array(
                'choices' => array(
                    '1' => '客户沟通',
                    '2' => '需求收集',
                    '3' => '项目进行',
                    '4' => '需求结束'),
                'empty_value' => '-请选择-',
                'empty_data' => null,
            ))
            ->add('category')
            ->add('initiator')
            ->getForm();

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Requirement entity.
     *
     * @Route("/{id}", name="requirement_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SitePlatformBundle:Requirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Requirement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Displays a form to edit an existing Requirement entity.
     *
     * @Route("/{id}/edit", name="requirement_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SitePlatformBundle:Requirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Requirement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Creates a form to edit a Requirement entity.
     *
     * @param Requirement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Requirement $entity)
    {
        $form = $this->createForm(new RequirementType(), $entity, array(
            'action' => $this->generateUrl('requirement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Requirement entity.
     *
     * @Route("/{id}", name="requirement_update")
     * @Method("PUT")
     * @Template("SitePlatformBundle:Requirement:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SitePlatformBundle:Requirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Requirement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('requirement_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Requirement entity.
     *
     * @Route("/{id}", name="requirement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SitePlatformBundle:Requirement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Requirement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('requirement'));
    }

    /**
     * Creates a form to delete a Requirement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('requirement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }


}
