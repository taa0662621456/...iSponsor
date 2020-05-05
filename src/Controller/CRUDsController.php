<?php

namespace App\Controller;

use App\Service\RequestDispatcher;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CRUDsController extends AbstractController
{
    /**
     * @var RequestDispatcher
     */
    private $requestDispatcher;


    public function __construct(RequestDispatcher $requestDispatcher)
    {
        $this->requestDispatcher = $requestDispatcher;
    }

    /**
     * @Route("vendors/", name="vendor_index", methods={"GET"})
     * @Route("products/", name="product_index", methods={"GET"})
     * @Route("projects/", name="project_index", methods={"GET"})
     * @Route("categories/", name="category_index", methods={"GET"})
     * @Route("attachments/", name="attachment_index", methods={"GET"})
     * @Route("reviews/product/", name="review_product_index", methods={"GET"})
     * @Route("reviews/project/", name="review_project_index", methods={"GET"})
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
        $em = $this->getDoctrine()->getManager();
        return $this->render($this->requestDispatcher->layOutPath(), array(
                $this->requestDispatcher->route() => $em->getRepository($this->requestDispatcher->object())->findAll(),
            )
        );
    }

    /**
     * @Route("vendor/new", name="vendor_new", methods={"GET","POST"})
     * @Route("project/new", name="project_new", methods={"GET","POST"})
     * @Route("product/new", name="product_new", methods={"GET","POST"})
     * @Route("category/new", name="category_new", methods={"GET","POST"})
     * @Route("attachment/new", name="attachment_new", methods={"GET","POST"})
     * @Route("reviews/product/new", name="review_product_new", methods={"GET", "POST"})
     * @Route("reviews/project/new", name="review_project_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        //TODO: need VendorTypeAttach for difference Docs and Media
        $slug = new Slugify();

        $object = $this->requestDispatcher->object();
        $object = new $object;

        $objectEnGb = $this->requestDispatcher->objectEnGb();
        $objectEnGb = new $objectEnGb;

        $objectAttachment = $this->requestDispatcher->objectAttachment();
        $objectAttachment = new $objectAttachment;

        $form = $this->createForm($this->requestDispatcher->objectType(), $this->requestDispatcher->object());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (true == $form->getData()->objectEnGb->getSlug()) {
                $object->setSlug($slug->slugify($objectEnGb->get000000()));//TODO: нужно продумать для всех объектов поле-эквивалент FirstName (для Vendor) или вынести в отдельного слушателя для отдельного объекта
            }
            $em->persist($object);
            $em->flush();

            return $this->redirect($object);
        }

        return $this->render($this->requestDispatcher->layOutPath(), array(
            'object' => $this->requestDispatcher->object(),
            'form' => $form->createView(),
        ));
    }

    /**
     * WARNING! Routes by 'id' for Back-end only
     * @Route("vendor/{id<\d+>}", name="vendor_id_show", methods={"GET"})
     * @Route("project/{id<\d+>}", name="project_id_show", methods={"GET"})
     * @Route("product/{id<\d+>}", name="product_id_show", methods={"GET"})
     * @Route("category/{id<\d+>}", name="category_id_show", methods={"GET"})
     * @Route("attachment/{id<\d+>}", name="attachment_id_show", methods={"GET"})
     * @Route("review/product/{id<\d+>}", name="review_product_id_show", methods={"GET"})
     * @Route("review/project/{id<\d+>}", name="review_project_id_show", methods={"GET"})
     *
     * Routes by 'slug' for Front-end and Back-end
     * @Route("vendor/{slug}", name="vendor_slug_show", methods={"GET"})
     * @Route("project/{slug}", name="project_slug_show", methods={"GET"})
     * @Route("product/{slug}", name="product_slug_show", methods={"GET"})
     * @Route("category/{slug}", name="category_slug_show", methods={"GET"})
     * @Route("attachment/{slug}", name="attachment_slug_show", methods={"GET"})
     * @Route("review/product/{slug}", name="review_product_slug_show", methods={"GET"})
     * @Route("review/project/{slug}", name="review_project_slug_show", methods={"GET"})
     *
     * @return Response
     */
    public function show(): Response
    {
        $object = $this->requestDispatcher->object();
        return $this->render($this->requestDispatcher->layOutPath(), array(
            $this->requestDispatcher->route() => new $object,
        ));
    }

    /**
     * WARNING! Routes by 'id' for Back-end only
     * @Route("vendor/edit/{id<\d+>}", name="vendor_id_edit", methods={"GET","POST"})
     * @Route("project/edit/{id<\d+>}", name="project_id_edit", methods={"GET","POST"})
     * @Route("product/edit/{id<\d+>}", name="product_id_edit", methods={"GET","POST"})
     * @Route("category/edit/{id<\d+>}", name="category_id_edit", methods={"GET","POST"})
     * @Route("attachment/edit/{id<\d+>}", name="attachment_id_edit", methods={"GET","POST"})
     * @Route("review/product/edit/{id<\d+>}", name="review_product_id_edit", methods={"GET", "POST"})
     * @Route("review/project/edit/{id<\d+>}", name="review_project_id_edit", methods={"GET", "POST"})
     *
     * Routes by 'slug' for Front-end and Back-end
     * @Route("vendor/edit/{slug}", name="vendor_slug_edit", methods={"GET","POST"})
     * @Route("project/edit/{slug}", name="project_slug_edit", methods={"GET","POST"})
     * @Route("product/edit/{slug}", name="product_slug_edit", methods={"GET","POST"})
     * @Route("category/edit/{slug}", name="category_slug_edit", methods={"GET","POST"})
     * @Route("attachment/edit/{slug}", name="attachment_slug_edit", methods={"GET","POST"})
     * @Route("review/product/edit/{slug}", name="review_product_slug_edit", methods={"GET", "POST"})
     * @Route("review/project/edit/{slug}", name="review_project_slug_edit", methods={"GET", "POST"})
     *
     * @return Response
     */
    public function edit(): Response
    {
        $object = $this->requestDispatcher->object();
        $form = $this->createForm($this->requestDispatcher->objectType(), $this->requestDispatcher->object());
        $form->handleRequest($this->requestDispatcher->object());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($this->requestDispatcher->object());
        }

        return $this->render($this->requestDispatcher->layOutPath(), array(
            $this->requestDispatcher->route() => new $object,
            'form' => $form->createView(),
        ));
    }


    /**
     * WARNING! Routes by 'id' for Back-end only
     * @Route("vendor/delete/{id<\d+>}", name="vendor_id_delete", methods={"DELETE"})
     * @Route("project/delete/{id<\d+>}", name="project_id_delete", methods={"DELETE"})
     * @Route("product/delete/{id<\d+>}", name="product_id_delete", methods={"DELETE"})
     * @Route("category/delete/{id<\d+>}", name="category_id_delete", methods={"DELETE"})
     * @Route("attachment/delete/{id<\d+>}", name="attachment_id_delete", methods={"DELETE"})
     * @Route("review/product/delete/{id<\d+>}", name="review_product_id_delete", methods={"DELETE"})
     * @Route("review/project/delete/{id<\d+>}", name="review_project_id_delete", methods={"DELETE"})
     *
     * Routes by 'slug' for Front-end and Back-end
     * @Route("vendor/delete/{slug}", name="vendor_slug_delete", methods={"DELETE"})
     * @Route("project/delete/{slug}", name="project_slug_delete", methods={"DELETE"})
     * @Route("product/delete/{slug}", name="product_slug_delete", methods={"DELETE"})
     * @Route("category/delete/{slug}", name="category_slug_delete", methods={"DELETE"})
     * @Route("attachment/delete/{slug}", name="attachment_slug_delete", methods={"DELETE"})
     * @Route("review/product/delete/{slug}", name="review_product_slug_delete", methods={"DELETE"})
     * @Route("review/project/delete/{slug}", name="review_project_slug_delete", methods={"DELETE"})
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $this->requestDispatcher->object()->getId(), $request->get('_token'))) { //TODO: в этой строке сделать get по тому признаку, который определен в роуте id/slug
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove((object)$this->requestDispatcher->object());
            $entityManager->flush();
        }

        return $this->redirectToRoute($this->requestDispatcher->object());
    }
}