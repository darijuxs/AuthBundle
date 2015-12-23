<?php

namespace AuthBundle\Command;

use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\Role\Exception\RoleExistsException;
use AuthBundle\Entity\Role\RoleService;
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
     * @var DoctrineManager
     */
    private $manager;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * RoleCommand constructor.
     * @param DoctrineManager $manager
     * @param RoleService $roleService
     */
    public function __construct(DoctrineManager $manager, RoleService $roleService)
    {
        parent::__construct();

        $this->manager = $manager;
        $this->roleService = $roleService;
    }

    protected function configure()
    {
        $this
            ->setName('auth:role:add')
            ->setDescription('Generate role')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'User role name. Example: admin, user, super_admin.'
            );
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
            $output->writeln($e->getMessage());
            return;
        }

        $output->writeln($role->getName());
    }
}