<?php

namespace AuthBundle\Command;

use Exception;
use UnexpectedValueException;
use AuthBundle\Entity\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UserCommand
 * @package AuthBundle\Command
 */
class UserCommand extends Command
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserCommand constructor.
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
            ->addOption("username", null, InputOption::VALUE_REQUIRED, "User username")
            ->addOption("password", null, InputOption::VALUE_REQUIRED, "User password")
            ->addOption("role", null, InputOption::VALUE_REQUIRED, "User role");
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
                    $this->getUsername($input),
                    $this->getPassword($input),
                    $this->getRole($input)
                );
        } catch (Exception $e) {
            $output->writeln('<fg=red>' . $e->getMessage() . '</>');
            return;
        }

        $output->writeln(sprintf('<fg=green>Created user: %s.</>', $user->getUsername()));
    }

    /**
     * Parse option "username" value .
     *
     * @param InputInterface $input
     * @return mixed
     */
    private function getUsername(InputInterface $input)
    {
        $username = $input->getOption("username");

        if ($username) {
            return $username;
        }

        throw new UnexpectedValueException(sprintf('Option "--username" is required'));
    }

    /**
     * Parse option "password" value .
     *
     * @param InputInterface $input
     * @return mixed
     */
    private function getPassword(InputInterface $input)
    {
        $password = $input->getOption("password");

        if ($password) {
            return $password;
        }

        throw new UnexpectedValueException(sprintf('Option "--password" is required'));
    }

    /**
     * Parse option "role" value .
     *
     * @param InputInterface $input
     * @return mixed
     */
    private function getRole(InputInterface $input)
    {
        $role = $input->getOption("role");

        if ($role) {
            return $role;
        }

        throw new UnexpectedValueException(sprintf('Option "--role" is required'));
    }
}
