<?php

namespace App\Command;

use App\Entity\Formulaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:generate-missing-tokens')]
class GenerateMissingTokensCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $formulaires = $this->em->getRepository(Formulaire::class)->findBy(['societySignToken' => null]);
        $slugger = new AsciiSlugger();

        foreach ($formulaires as $formulaire) {
            $token = $slugger->slug($formulaire->getSocietyName())->lower() . '-' . $formulaire->getId() . '-' . bin2hex(random_bytes(4));
            $formulaire->setSocietySignToken($token);
            $output->writeln('Token generated for formulaire #' . $formulaire->getId() . ': ' . $token);
        }

        $this->em->flush();
        $output->writeln('All missing tokens have been generated successfully.');

        return Command::SUCCESS;
    }
}