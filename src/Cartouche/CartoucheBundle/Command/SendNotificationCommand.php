<?php

namespace Cartouche\CartoucheBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SendNotificationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cartouche:send-notification')
            ->setDescription('Sends notification for users who should change thier Cartouche')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $mailer = $this->getContainer()->get('mailer');
        $twigEnvironment = $this->getContainer()->get('twig');

        foreach ($manager->getRepository('CartoucheCartoucheBundle:Cartouche')->getCartoucheToNotify() as $cartouche) {
            /** @var \Cartouche\CartoucheBundle\Entity\Cartouche $cartouche */

            $message = new \Swift_Message();
            $message->setTo($cartouche->getEmail())
                ->setFrom('noreply@estcequejedoischangermacartouche.fr')
                ->setSubject("C'est l'heure de changer votre cartouche")
                ->setBody(
                    $twigEnvironment->render(
                        'CartoucheCartoucheBundle:Cartouche:mail.html.twig',
                        array('cartouche' => $cartouche)
                    ),
                    'text/html'
                );

            if ($mailer->send($message)) {
                $cartouche->setNotificationSent(true);
            }
        }

        $manager->flush();

        $spool = $mailer->getTransport()->getSpool();
        $transport = $this->getContainer()->get('swiftmailer.transport.real');
        $spool->flushQueue($transport);

        $output->writeln('Done.');
    }
}
