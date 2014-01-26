<?php

namespace Cartouche\CartoucheBundle\Controller;

use Cartouche\CartoucheBundle\Entity\Cartouche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/cartouche")
 */
class DefaultController extends Controller
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
        $manager->flush();

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
}
