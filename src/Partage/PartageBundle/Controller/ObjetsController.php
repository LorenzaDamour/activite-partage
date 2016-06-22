<?php

namespace Partage\PartageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Partage\PartageBundle\Entity\Objets;
use Partage\PartageBundle\Form\ObjetsType;

/**
 * Objets controller.
 *
 * @Route("/objets")
 */
class ObjetsController extends Controller
{
    /**
     * Lists all Objets entities.
     *
     * @Route("/", name="objets_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $objets = $em->getRepository('PartagePartageBundle:Objets')->findAll();

        return $this->render('objets/index.html.twig', array(
            'objets' => $objets,
        ));
    }

    /**
     * Creates a new Objets entity.
     *
     * @Route("/new", name="objets_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $objet = new Objets();
        $form = $this->createForm('Partage\PartageBundle\Form\ObjetsType', $objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($objet);
            $em->flush();

            return $this->redirectToRoute('objets_show', array('id' => $objet->getId()));
        }

        return $this->render('objets/new.html.twig', array(
            'objet' => $objet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Objets entity.
     *
     * @Route("/{id}", name="objets_show")
     * @Method("GET")
     */
    public function showAction(Objets $objet)
    {
        $deleteForm = $this->createDeleteForm($objet);

        return $this->render('objets/show.html.twig', array(
            'objet' => $objet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Objets entity.
     *
     * @Route("/{id}/edit", name="objets_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Objets $objet)
    {
        $deleteForm = $this->createDeleteForm($objet);
        $editForm = $this->createForm('Partage\PartageBundle\Form\ObjetsType', $objet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($objet);
            $em->flush();

            return $this->redirectToRoute('objets_edit', array('id' => $objet->getId()));
        }

        return $this->render('objets/edit.html.twig', array(
            'objet' => $objet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Objets entity.
     *
     * @Route("/{id}", name="objets_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Objets $objet)
    {
        $form = $this->createDeleteForm($objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($objet);
            $em->flush();
        }

        return $this->redirectToRoute('objets_index');
    }

    /**
     * Creates a form to delete a Objets entity.
     *
     * @param Objets $objet The Objets entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Objets $objet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('objets_delete', array('id' => $objet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
