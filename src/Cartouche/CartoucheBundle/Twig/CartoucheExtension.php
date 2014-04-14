<?php

namespace Cartouche\CartoucheBundle\Twig;

class CartoucheExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('answer', array($this, 'getResponseFromWear'))
        );
    }

    public function getResponseFromWear($wear)
    {
        if ($wear <= 0) {
            return 'Non, votre cartouche est neuve !';
        }

        if ($wear > 200) {
            return 'Oui ! Il est plus que temps de la changer...';
        }

        if ($wear >= 100) {
            return 'Oui, c\'est le moment :)';
        }

        if ($wear >= 80) {
            return 'Non, mais c\'est pour bientôt...';
        }

        if ($wear < 10) {
            return 'Non, votre cartouche est quasi neuve !';
        }

        return 'Non, pas encore.';
    }

    public function getName()
    {
        return 'cartouche_extension';
    }
}
