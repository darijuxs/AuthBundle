<?php

namespace AuthBundle\Authentication;

use Doctrine\ORM\EntityManager;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DoctrineManager
 * @package AuthBundle\Authentication
 */
class DoctrineManager
{
    /**
     * @var EntityManager|DocumentManager
     */
    private $manager;

    /**
     * @return DocumentManager|EntityManager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Choose correct doctrine manager: ODM or ORM
     *
     * @param ContainerInterface $containerInterface
     * @return EntityManager|DocumentManager
     */
    public function setManager(ContainerInterface $containerInterface)
    {
        $this->manager = $containerInterface->get(
            $containerInterface->getParameter("auth.data_manager")
        );
    }
}
