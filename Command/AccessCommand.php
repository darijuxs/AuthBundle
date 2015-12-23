<?php

namespace AuthBundle\Command;

use InvalidArgumentException;
use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\Access\AccessService;
use AuthBundle\Exception\AuthenticationException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AccessCommand
 * @package AuthBundle\Command
 */
class AccessCommand extends Command
{
    /**
     * @var DoctrineManager
     */
    private $manager;

    /**
     * @var AccessService
     */
    private $accessService;

    /**
     * RoleCommand constructor.
     * @param DoctrineManager $manager
     * @param AccessService $accessService
     */
    public function __construct(DoctrineManager $manager, AccessService $accessService)
    {
        parent::__construct();

        $this->manager = $manager;
        $this->accessService = $accessService;
    }

    protected function configure()
    {
        $this
            ->setName('auth:access:add')
            ->setDescription('Generate access')
            ->addArgument(
                'route',
                InputArgument::REQUIRED,
                'Route name'
            )
            ->addArgument(
                'parameter',
                InputArgument::REQUIRED,
                'Role name'
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
            $parameter = $this->parameterParser($input);

            $access = $this
                ->accessService
                ->create(
                    $input->getArgument('route'),
                    $parameter["type"],
                    $parameter["value"]
                );
        } catch (AuthenticationException $e) {
            $output->writeln('<fg=red>'.$e->getMessage().'</>');
            return;
        } catch (InvalidArgumentException $e) {
            $output->writeln('<fg=red>'.$e->getMessage().'</>');
            return;
        }

        $output->writeln(sprintf('<fg=green>Access rule created successfully for route: %s.</>', $access->getRoute()));
    }

    /**
     * Parse input parameter value and select correct type.
     *
     * @param InputInterface $input
     * @return mixed
     */
    private function parameterParser(InputInterface $input)
    {
        $parameters = explode("=", $input->getArgument("parameter"));
        if (isset($parameters[0]) and isset($parameters[1])) {
            if ($parameters[0] === AccessService::ACCESS_BY_ROLE or $parameters[0] === AccessService::ACCESS_BY_USER) {
                return [
                    "type" => $parameters[0],
                    "value" => $parameters[1]
                ];
            }
        }

        throw new InvalidArgumentException(sprintf(
            'Parameter "%s" is invalid. Valid types are "%s" and "%s".',
            $parameters[0],
            AccessService::ACCESS_BY_ROLE,
            AccessService::ACCESS_BY_USER
        ));
    }
}