<?php

namespace AuthBundle\Command;

use AuthBundle\Entity\User\UserService;
use InvalidArgumentException;
use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\Access\AccessService;
use AuthBundle\Exception\AuthenticationException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\User\User;

/**
 * Class AccessCommand
 * @package AuthBundle\Command
 */
class UserCommand extends Command
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * RoleCommand constructor.
     * @param UserService $accessService
     */
    public function __construct(UserService $accessService)
    {
        parent::__construct();
        $this->userService = $accessService;
    }

    protected function configure()
    {
        $this
            ->setName('auth:user:add')
            ->setDescription('Generate access')
            ->addOption("username", null, InputOption::VALUE_REQUIRED, "User username", "admin")
            ->addOption("password", null, InputOption::VALUE_REQUIRED, "User password", "admin")
            ->addOption("role", null, InputOption::VALUE_REQUIRED, "User role", "admin");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $user = $this
                ->userService
                ->create(
                    $input->getOption("username"),
                    $input->getOption("password"),
                    $input->getOption("role")
                );
        } catch (AuthenticationException $e) {
            $output->writeln('<fg=red>' . $e->getMessage() . '</>');
            return;
        }

        $output->writeln(sprintf('<fg=green>Access rule created successfully for route: %s.</>', $user->getUsername()));
    }
}