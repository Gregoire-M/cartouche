<?php

namespace Cartouche\CartoucheBundle\Factory;

use Cartouche\CartoucheBundle\Entity\Cartouche;
use Symfony\Component\Security\Core\Util\SecureRandom;

class CartoucheFactory
{
    private $secureRandom;

    public function __construct(SecureRandom $secureRandom)
    {
        $this->secureRandom = $secureRandom;
    }

    /**
     * @return Cartouche
     */
    public function create()
    {
        $cartouche = new Cartouche();
        $cartouche->setUrl($this->generateUrl());

        return $cartouche;
    }

    private function generateUrl()
    {
        return bin2hex($this->secureRandom->nextBytes(4));
    }
}
