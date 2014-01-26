<?php

namespace Cartouche\CartoucheBundle\Controller;

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
     * @Template()
     */
    public function newAction()
    {
        $cartouche = $this->get('cartouche.factory')->create();
        $manager = $this->getDoctrine()->getManager();

        $manager->persist($cartouche);
        $manager->flush();

        die('ok');

        return array();
    }

    public function showAction()
    {
        
    }
}
