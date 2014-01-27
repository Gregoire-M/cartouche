<?php

namespace Cartouche\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("", name="homepage")
     * @Template()
     * @Method("GET")
     */
    public function indexAction()
    {
        return array();
    }
}
