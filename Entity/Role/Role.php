<?php

namespace AuthBundle\Entity\Role;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use RAPIBundle\DataMapper\Annotation as DataMapper;
use AuthBundle\Entity\Access\Access;

/**
 * Class Role
 *
 * @ORM\Entity()
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="AuthBundle\Entity\Role\RoleRepository")
 * @DataMapper\Mapper()
 */
class Role
{
    const ID = "id";
    const ROLE = "role";
    const USER = "user";
    const ACCESSES = "accesses";

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, unique=true)
     */
    protected $name;

    /**
     * @var Access[]
     * @ORM\OneToMany(targetEntity="AuthBundle\Entity\Access\Access", mappedBy="role")
     */
    protected $accesses;

    public function __construct()
    {
        $this->accesses = new ArrayCollection();
    }

    /**
     * @DataMapper\Int()
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @DataMapper\String()
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @DataMapper\Object()
     * @return Access[]
     */
    public function getAccesses()
    {
        return $this->accesses;
    }
}
