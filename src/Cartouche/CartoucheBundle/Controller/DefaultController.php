<?php

namespace Cartouche\CartoucheBundle\Controller;

use Cartouche\CartoucheBundle\Entity\Cartouche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Util\SecureRandom;
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

		$cartouche = new Cartouche();

		die($this->generateCartoucheUrl());

        return array();
    }

    private function generateCartoucheUrl()
    {
		$generator = new SecureRandom();

		return bin2hex($generator->nextBytes(4));
    }
}
