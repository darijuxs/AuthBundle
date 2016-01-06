<?php

namespace AuthBundle\Authentication;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DoctrineManager
 * @package AuthBundle\Authentication
 */
class DoctrineManager
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @return EntityManager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Choose correct doctrine manager: ODM or ORM
     *
     * @param ContainerInterface $containerInterface
     * @return EntityManager
     */
    public function setManager(ContainerInterface $containerInterface)
    {
        $this->manager = $containerInterface->get(
            $containerInterface->getParameter("auth.db_manager")
        );
    }
}
