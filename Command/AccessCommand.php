<?php

namespace AuthBundle\Command;

use Exception;
use UnexpectedValueException;
use InvalidArgumentException;
use AuthBundle\Entity\Access\AccessService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AccessCommand
 * @package AuthBundle\Command
 */
class AccessCommand extends Command
{
    /**
     * @var AccessService
     */
    private $accessService;

    /**
     * RoleCommand constructor.
     * @param AccessService $accessService
     */
    public function __construct(AccessService $accessService)
    {
        parent::__construct();

        $this->accessService = $accessService;
    }

    protected function configure()
    {
        $this
            ->setName('auth:access:add')
            ->setDescription('Generate access')
            ->addArgument('route', InputArgument::REQUIRED, 'Route name')
            ->addOption("type", null, InputOption::VALUE_REQUIRED, "Access type")
            ->addOption("value", null, InputOption::VALUE_REQUIRED, "Access type value")
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $access = $this
                ->accessService
                ->create(
                    $input->getArgument('route'),
                    $this->getType($input),
                    $this->getValue($input)
                );
        } catch (Exception $e) {
            $output->writeln('<fg=red>'.$e->getMessage().'</>');
            return;
        }

        $output->writeln(sprintf('<fg=green>Access rule created successfully for route: %s.</>', $access->getRoute()));
    }

    /**
     * Parse option "type" value and select correct type.
     *
     * @param InputInterface $input
     * @return mixed
     */
    private function getType(InputInterface $input)
    {
        $parameter = $input->getOption("type");

        if ($parameter === AccessService::ACCESS_BY_ROLE or $parameter === AccessService::ACCESS_BY_USER) {
            return $parameter;
        }

        if (!$parameter) {
            throw new UnexpectedValueException(sprintf('Option "--type" is required'));
        }

        throw new InvalidArgumentException(sprintf(
            'Type "%s" is invalid. Valid types are "%s" and "%s".',
            $parameter,
            AccessService::ACCESS_BY_ROLE,
            AccessService::ACCESS_BY_USER
        ));
    }

    /**
     * Parse option "value" value .
     *
     * @param InputInterface $input
     * @return mixed
     */
    private function getValue(InputInterface $input)
    {
        $value = $input->getOption("value");

        if ($value) {
            return $value;
        }

        throw new UnexpectedValueException(sprintf('Option "--value" is required'));
    }
}