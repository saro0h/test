<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class SendSMSCommand extends ContainerAwareCommand
{
     protected function configure()
    {
        $this
            ->setName('send:sms')
        ;
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $array = Yaml::parse(file_get_contents($this->getContainer()->getParameter('kernel.root_dir').'/groupe-soiree.yml'));

        foreach($array as $group) {
            $date = new \DateTime('now');
            if ($date->format('G:i') == $group['heure_d_envoi'] ) {
                foreach($group['names'] as $id => $password) {
                    echo "$id\n";
                    $user = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Participant')->findOneById($id);

                    $messageBird = new \MessageBird\Client($this->getContainer()->getParameter('msgbird-token'));
                    $message = new \MessageBird\Objects\Message();
                    $message->originator = 'MessageBird';
                    $message->recipients = array('33782922697');

                    $heure = str_replace(':', 'h', $group['heure_sur_sms']);

                    $message->body = sprintf("%s, il est l'heure.\n
Ce soir, vous êtes \"%s\".\n
Salle Event, %s. Suivez les affiches et ne soyez pas en retard, les portes ne s'ouvriront qu'une fois.\n
Toute transmission de ce message annule l'entrée.", $user->firstname, $password, $heure);

                    $output->writeln(sprintf("Send SMS to: %s.\nSMS sent: %s", $user->firstname, $user->lastname, $message->body));

                    $response = $messageBird->messages->create($message);
                }

            }
        }

    }
}