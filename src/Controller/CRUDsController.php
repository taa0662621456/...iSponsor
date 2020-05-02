<?php

namespace App\Controller;


use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CRUDsController extends AbstractController
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    private $object;

    public $crud;

    private $route;

    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $path;


    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $object = (string)ucfirst(current(explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 2)));
        $this->object = '\\App\\Entity\\' . $object . '\\' . $object . 's'; //TODO: не продумано для Entity
        $crud = explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 2);
        $this->crud = $crud[1];
        $this->route = mb_strtolower($object);
        $this->type = '\\App\\src\\Form\\' . $object . '\\' . $object . 'Type';
        $this->path = mb_strtolower($object . '/' . $object . '/' . $crud[1] . '.html.twig');
        //TODO: не продумана структура папок, в частности не клеится с Categories (окончание не "y")
    }

    /**
     * @Route("vendors/", name="vendor_index", methods={"GET"})
     * @Route("products/", name="product_index", methods={"GET"})
     * @Route("projects/", name="project_index", methods={"GET"})
     * @Route("categories/", name="category_index", methods={"GET"})
     * @Route("attachments/", name="attachment_index", methods={"GET"})
     * @Route("product/reviews/", name="product_review_index", methods={"GET"})
     * @Route("project/reviews/", name="project_review_index", methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        /*
         * проверка прав на листинг записей
         * первый вариант: $this->denyAccessUnlessGranted('view', $post); // вместо 'view' взять из роута 'index'
         *
         */
        return $this->render($this->path, array(
                $this->route => new $this->object->findAll(),
            )
        );
    }

    /**
     * @Route("vendor/new", name="vendor_new", methods={"GET","POST"})
     * @Route("project/new", name="project_new", methods={"GET","POST"})
     * @Route("product/new", name="product_new", methods={"GET","POST"})
     * @Route("category/new", name="category_new", methods={"GET","POST"})
     * @Route("attachment/new", name="attachment_new", methods={"GET","POST"})
     * @Route("product/reviews/new", name="product_review_new", methods={"GET", "POST"})
     * @Route("project/reviews/new", name="project_review_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        //TODO: need VendorTypeAttach for difference Docs and Media
        $slug = new Slugify();
        $object = new $this->object;
        $objectEnGb = $this->object . 'EnGb';
        $objectEnGb = new $objectEnGb;
        $objectAttachment = $this->object . 'Attachment';
        $objectAttachment = new $objectAttachment;
        $type =& $this->type;
        $form = $this->createForm($type, $object);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            if (true==$form->getData()->objectEnGb->getSlug()){
                $object->setSlug($slug->slugify($objectEnGb->get000000()));//TODO: нужно продумать для всех объектов поле-эквивалент FirstName (для Vendor) или вынести в отдельного слушателя для отдельного объекта
            }
            $em->persist($object);
            $em->flush();

            return $this->redirect($object);
        }

        return $this->render($this->path, array(
            'object' => $this->object,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("vendor/{id<\d+>}", name="vendor_show", methods={"GET"})
     * @Route("project/{id<\d+>}", name="project_show", methods={"GET"})
     * @Route("product/{id<\d+>}", name="product_show", methods={"GET"})
     * @Route("category/{id<\d+>}", name="category_show", methods={"GET"})
     * @Route("attachment/{id<\d+>}", name="attachment_show", methods={"GET"})
     * @Route("product/review/{id<\d+>}", name="product_review_show", methods={"GET"})
     * @Route("project/review/{id<\d+>}", name="project_review_show", methods={"GET"})
     *
     * @return Response
     */
    public function show(): Response
    {
        return $this->render($this->path, array(
            $this->route => new $this->object,
        ));
    }

    /**
     * @Route("vendor/edit/{id<\d+>}", name="vendor_edit", methods={"GET","POST"})
     * @Route("project/edit/{id<\d+>}", name="project_edit", methods={"GET","POST"})
     * @Route("product/edit/{id<\d+>}", name="product_edit", methods={"GET","POST"})
     * @Route("category/edit/{id<\d+>}", name="category_edit", methods={"GET","POST"})
     * @Route("attachment/edit/{id<\d+>}", name="attachment_edit", methods={"GET","POST"})
     * @Route("product/review/edit/{id<\d+>}", name="product_review_edit", methods={"GET", "POST"})
     * @Route("project/review/edit/{id<\d+>}", name="project_review_edit", methods={"GET", "POST"})
     *
     * @return Response
     */
    public function edit(): Response
    {
        $form = $this->createForm($this->type, $this->object);
        $form->handleRequest($this->object);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($this->object);
        }

        return $this->render($this->path, array(
            $this->route => new $this->object,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("vendor/delete/{id<\d+>}", name="vendor_delete", methods={"DELETE"})
     * @Route("project/delete/{id<\d+>}", name="project_delete", methods={"DELETE"})
     * @Route("product/delete/{id<\d+>}", name="product_delete", methods={"DELETE"})
     * @Route("category/delete/{id<\d+>}", name="category_delete", methods={"DELETE"})
     * @Route("attachment/delete/{id<\d+>}", name="attachment_delete", methods={"DELETE"})
     * @Route("product/review/delete/{id<\d+>}", name="product_review_delete", methods={"DELETE"})
     * @Route("project/review/delete/{id<\d+>}", name="project_review_delete", methods={"DELETE"})
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $this->object->getId(), $request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($this->object);
            $entityManager->flush();
        }

        return $this->redirectToRoute($this->object);
    }
}