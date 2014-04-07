<?php

namespace Cartouche\CartoucheBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class CartoucheControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Vous avez une carafe Brita ?")')->count()
        );
    }

    public function testCreateShowEditCartouche()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('Je veux gérer une nouvelle carafe !')->form();
        $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirection()
        );

        $crawler = $client->followRedirect();

        $this->assertRegExp('@^/brita/.+@', $client->getRequest()->getRequestUri());

        if (preg_match('@^/brita/(.+)$@', $client->getRequest()->getRequestUri(), $matches) == 0) {
            return;
        }

        $cartoucheUrl = $matches[1];

        $today = new \DateTime();
        $nextChange = clone $today;
        $nextChange->add(new \DateInterval('P28D'));

        $this->assertShowValues($crawler, 'Ma carafe Brita', $today, $nextChange, false, 0);

        $crawler = $client->click(
            $crawler->filter('a:contains("Paramètres")')->first()->link()
        );

        $this->assertEquals(
            sprintf('/brita/edit/%s', $cartoucheUrl),
            $client->getRequest()->getRequestUri()
        );

        $form = $crawler->selectButton('Valider')->form();

        $form['cartouche_cartouchebundle_cartouche[name]'] = 'Ma carafe de test';
        $form['cartouche_cartouchebundle_cartouche[url]'] = $cartoucheUrl . 'test';
        $form['cartouche_cartouchebundle_cartouche[notificationEnabled]']->tick();

        $crawler = $client->submit($form);

        $this->assertEquals(
            1,
            $crawler->filter('html:contains("Vous devez définir un email pour recevoir les notifications")')->count()
        );

        $yesterday = new \DateTime('yesterday');

        $form = $crawler->selectButton('Valider')->form();
        $form['cartouche_cartouchebundle_cartouche[email]'] = 'test@mrchl.fr';
        $form['cartouche_cartouchebundle_cartouche[lastChangeDate]'] = $yesterday->format('d/m/Y');
        $form['cartouche_cartouchebundle_cartouche[duration]'] = '2';

        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertEquals(
            sprintf('/brita/%s', $cartoucheUrl . 'test'),
            $client->getRequest()->getRequestUri()
        );

        $this->assertShowValues($crawler, 'Ma carafe de test', $yesterday, new \DateTime('tomorrow'), true, 50);
    }

    private function assertShowValues(Crawler $crawler, $name, \DateTime $today, \DateTime $nextChange, $isNotification, $percentage)
    {
        $this->assertEquals(
            1,
            $crawler->filter(sprintf('html:contains("%s")', $name))->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter(sprintf('html:contains("%s")', $today->format('d/m/Y')))->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter(sprintf('html:contains("%s")', $nextChange->format('d/m/Y')))->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter(sprintf('html:contains("%s")', $isNotification ? 'Activée' : 'Désactivée'))->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter(sprintf('html:contains("%s%%")', $percentage))->count()
        );
    }
}
