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
        $cartouches = $this->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository('CartoucheCartoucheBundle:Cartouche')
            ->getCartoucheToNotify();

        // TODO: send mail!

        $output->writeln('Done.');
    }
}
