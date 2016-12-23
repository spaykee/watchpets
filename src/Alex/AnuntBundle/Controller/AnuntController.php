<?php

namespace Alex\AnuntBundle\Controller;

use Alex\AnuntBundle\Entity\Anunt;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Anunt controller.
 *
 * @Route("/")
 */
class AnuntController extends Controller
{
    /**
     * Lists all anunt entities.
     *
     * @Route("/", name="_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $anunts = $em->getRepository('AlexAnuntBundle:Anunt')->findAll();

        return $this->render('anunt/index.html.twig', array(
            'anunts' => $anunts,
        ));
    }

    /**
     * Creates a new anunt entity.
     *
     * @Route("/new", name="_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $this->enforceUserSecurity();

        $anunt = new Anunt();
        $form = $this->createForm('Alex\AnuntBundle\Form\AnuntType', $anunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($anunt);
            $em->flush($anunt);

            return $this->redirectToRoute('_show', array('id' => $anunt->getId()));
        }

        return $this->render('anunt/new.html.twig', array(
            'anunt' => $anunt,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a anunt entity.
     *
     * @Route("/{id}", name="_show")
     * @Method("GET")
     */
    public function showAction(Anunt $anunt)
    {
        $deleteForm = $this->createDeleteForm($anunt);

        return $this->render('anunt/show.html.twig', array(
            'anunt' => $anunt,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing anunt entity.
     *
     * @Route("/{id}/edit", name="_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Anunt $anunt)
    {
        $this->enforceUserSecurity();

        $deleteForm = $this->createDeleteForm($anunt);
        $editForm = $this->createForm('Alex\AnuntBundle\Form\AnuntType', $anunt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('_edit', array('id' => $anunt->getId()));
        }

        return $this->render('anunt/edit.html.twig', array(
            'anunt' => $anunt,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a anunt entity.
     *
     * @Route("/{id}", name="_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Anunt $anunt)
    {
        $this->enforceUserSecurity();

        $form = $this->createDeleteForm($anunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($anunt);
            $em->flush($anunt);
        }

        return $this->redirectToRoute('_index');
    }

    /**
     * Creates a form to delete a anunt entity.
     *
     * @param Anunt $anunt The anunt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Anunt $anunt)
    {
        $this->enforceUserSecurity();

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $anunt->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function enforceUserSecurity()
    {
        $securityContext = $this->container->get('security.context');
        if (!$securityContext->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Need ROLE_USER!');
        }
    }
}
