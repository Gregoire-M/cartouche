<?php

namespace Cartouche\CartoucheBundle\Controller;

use Cartouche\CartoucheBundle\Entity\Cartouche;
use Cartouche\CartoucheBundle\Form\CartoucheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/brita")
 */
class CartoucheController extends Controller
{
    /**
     * @Route("/new", name="cartouche_new")
     * @Method("POST")
     */
    public function newAction()
    {
        $cartouche = $this->get('cartouche.factory')->create();
        $manager = $this->getDoctrine()->getManager();

        $manager->persist($cartouche);
        $manager->flush($cartouche);

        $this->get('session')->getFlashBag()->add(
            'success',
            'Voici la page de gestion de votre cartouche :)'
        );

        return $this->redirect($this->generateUrl('cartouche_show', array('url' => $cartouche->getUrl())));
    }

    /**
     * @Route("/{url}", name="cartouche_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Cartouche $cartouche)
    {
        return array('cartouche' => $cartouche);
    }

    /**
     * @Route("/change/{url}", name="cartouche_change")
     * @Method("GET")
     */
    public function changeAction(Cartouche $cartouche)
    {
        $cartouche->setLastChangeDate(new \DateTime())
            ->setNotificationSent(false);
        $this->getDoctrine()->getManager()->flush($cartouche);

        $this->get('session')->getFlashBag()->add(
            'success',
            'Changement de cartouche enregistré !'
        );

        return $this->redirect($this->generateUrl('cartouche_show', array('url' => $cartouche->getUrl())));
    }

    /**
     * @Route("/edit/{url}", name="cartouche_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Cartouche $cartouche, Request $request)
    {
        $form = $this->createForm(new CartoucheType(), $cartouche);

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush($cartouche);

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Paramètres enregistrés !'
                );

                return $this->redirect($this->generateUrl('cartouche_show', array('url' => $cartouche->getUrl())));
            }
        }

        return array(
            'form' => $form->createView(),
            'cartouche' => $cartouche
        );
    }
}
