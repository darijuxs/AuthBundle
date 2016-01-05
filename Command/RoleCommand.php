<?php

namespace AuthBundle\Command;

use AuthBundle\Entity\Role\RoleService;
use AuthBundle\Exception\RoleExistsException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RoleCommand
 * @package AuthBundle\Command
 */
class RoleCommand extends Command
{
    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * RoleCommand constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        parent::__construct();

        $this->roleService = $roleService;
    }

    protected function configure()
    {
        $this
            ->setName('auth:role:add')
            ->setDescription('Generate role')
            ->addArgument('name', InputArgument::REQUIRED, 'User role name. Example: admin, user, super_admin.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $role = $this
                ->roleService
                ->create(
                    $input->getArgument('name')
                );
        } catch (RoleExistsException $e) {
            $output->writeln('<fg=red>'.$e->getMessage().'</>');
            return;
        }

        $output->writeln(sprintf('<fg=green> Role "%s" created successfully.</>', $role->getName()));
    }
}