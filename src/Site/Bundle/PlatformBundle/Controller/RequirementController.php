<?php

namespace Site\Bundle\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Site\Bundle\PlatformBundle\Entity\Requirement;
use Site\Bundle\PlatformBundle\Form\RequirementType;
use Site\Bundle\PlatformBundle\lib\Page;

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
     * @Route("/p/{page}/", name="requirement",defaults={"page" = 1},requirements={"page" = "\d*"})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request,$page)
    {
        $em = $this->getDoctrine()->getManager();

        $defaultData = array('keywords' => '请输入关键字查询');


        $form = $this->get('site.common.controller')->createSearchForm($defaultData);


        $formData = $request->query->get('form');

        $params = $this->filterSearchData($formData);

        /*参数*/
        $count = count($em->getRepository('SitePlatformBundle:Requirement')->findAll());
        $limit = 10;
        $offset = ($page-1) * $limit;

        if (empty($params)) {

            $entities = $em->getRepository('SitePlatformBundle:Requirement')->findBy(
                array(),
                array('updateTime' => 'DESC'),
                $limit,
                $offset
            );

        } else {

            // var_dump($params);

            $entities = $em->getRepository('SitePlatformBundle:Requirement')->search($params, $offset, $limit);
            $count = count($entities);
            $entities = array_slice($entities,$offset,$offset+$limit);
        };

        $config = array(
            'total_rows' => $count,
            'per_page' => $limit,
            'num_links' => 3,
            'curr_page' => $page,
            'url_rule' => "#(/requirement/p/)\d+/?#iU",
            'page_container_tag_style'=>'pageWrap',
            'prev_tag_style'=>'prev',
            'next_tag_style'=>'next',
        );


        $paging = new Page($config);
        $pageHtml = $paging->display();

        return array(
            'entities' => $entities,
            'form' => $form,
            'pageHtml' => $pageHtml
        );

    }

    //过滤
    protected function filterSearchData($data)
    {
        if(empty($data)){
            return array();
        }

        $data = array_filter($data);

        if ($data['keywords'] == '请输入关键字查询') {
            unset($data['keywords']);
        }
        if ($data['country'] == '国家') {
            unset($data['country']);
        }
        if ($data['province'] == '省份/州') {
            unset($data['province']);
        }
        if ($data['city'] == '城市') {
            unset($data['city']);
        }
        return $data;
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
       // var_dump($form);exit;

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

       // $form->add('submit', 'submit', array('label' => 'Create'));

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

        //$form->add('submit', 'submit', array('label' => '更新'));

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
        $entity->setUpdateTime(new \DateTime());
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
     //   var_dump(111111);exit;
        if ($editForm->isValid()) {
            $em->flush();

            //return $this->redirect($this->generateUrl('requirement_edit', array('id' => $id)));
            return $this->redirect($this->generateUrl('requirement_show', array('id' => $id)));
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
            ->add('submit', 'submit', array('label' => '删除'))
            ->getForm();
    }
}
