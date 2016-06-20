<?php

namespace Partage\PartageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Partage\PartageBundle\Entity\Particulier;
use Partage\PartageBundle\Form\ParticulierType;

/**
 * Particulier controller.
 *
 * @Route("/particulier")
 */
class ParticulierController extends Controller
{
    /**
     * Lists all Particulier entities.
     *
     * @Route("/", name="particulier_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $particuliers = $em->getRepository('PartagePartageBundle:Particulier')->findAll();

        return $this->render('particulier/index.html.twig', array(
            'particuliers' => $particuliers,
        ));
    }

    /**
     * Creates a new Particulier entity.
     *
     * @Route("/new", name="particulier_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $particulier = new Particulier();
        $form = $this->createForm('Partage\PartageBundle\Form\ParticulierType', $particulier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($particulier);
            $em->flush();

            return $this->redirectToRoute('particulier_show', array('id' => $particulier->getId()));
        }

        return $this->render('particulier/new.html.twig', array(
            'particulier' => $particulier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Particulier entity.
     *
     * @Route("/{id}", name="particulier_show")
     * @Method("GET")
     */
    public function showAction(Particulier $particulier)
    {
        $deleteForm = $this->createDeleteForm($particulier);

        return $this->render('particulier/show.html.twig', array(
            'particulier' => $particulier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Particulier entity.
     *
     * @Route("/{id}/edit", name="particulier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Particulier $particulier)
    {
        $deleteForm = $this->createDeleteForm($particulier);
        $editForm = $this->createForm('Partage\PartageBundle\Form\ParticulierType', $particulier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($particulier);
            $em->flush();

            return $this->redirectToRoute('particulier_edit', array('id' => $particulier->getId()));
        }

        return $this->render('particulier/edit.html.twig', array(
            'particulier' => $particulier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Particulier entity.
     *
     * @Route("/{id}", name="particulier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Particulier $particulier)
    {
        $form = $this->createDeleteForm($particulier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($particulier);
            $em->flush();
        }

        return $this->redirectToRoute('particulier_index');
    }

    /**
     * Creates a form to delete a Particulier entity.
     *
     * @param Particulier $particulier The Particulier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Particulier $particulier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('particulier_delete', array('id' => $particulier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
