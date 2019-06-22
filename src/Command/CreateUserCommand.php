<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';


    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    private $manager;




    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {
        parent::__construct();
        $this->encoder = $encoder;
        $this->manager = $manager;

    }

    protected function configure()
    {
        $this
            ->setDescription('Create user')
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)

        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $username = $input->getArgument('username');
        $password = $input->getArgument('password');


        $user = new User();
        $user->setUsername($username);
        $encodedPassword = $this->encoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);

        $this->manager->persist($user);
        $this->manager->flush();


        $io->success('Success!');
    }
}
