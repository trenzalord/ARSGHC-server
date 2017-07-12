<?php
/**
 * Created by PhpStorm.
 * User: Quentin Gangler
 * Date: 12/07/2017
 * Time: 19:35
 */

namespace ApiBundle\Command;


use FOS\OAuthServerBundle\Entity\ClientManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClientCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('arsghc:oauth-server:create-client')
            ->setDescription('Create a new client')
            ->addOption('redirect-uri', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Sets redirect uri for client. Use this option multiple times to set multiple redirect URIs.', null)
            ->addOption('grant-type', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Sets allowed grant type for client. Use this option multiple times to set multiple grant types.', null)
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $clientManager ClientManager */
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris($input->getOption('redirect-uri'));
        $client->setAllowedGrantTypes($input->getOption('grant-type'));
        $clientManager->updateClient($client);
        $output->writeln(sprintf('Added a new client with public id <info>%s</info>.', $client->getPublicId()));
    }
}