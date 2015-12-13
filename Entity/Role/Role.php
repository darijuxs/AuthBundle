<?php

namespace AuthBundle\Entity\Role;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use RAPIBundle\DataMapper\Annotation as DataMapper;
use AuthBundle\Entity\User\User;
use AuthBundle\Entity\Access\Access;

/**
 * Class Role
 *
 * @ORM\Entity()
 * @ORM\Table(name="role")
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
    protected $role;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\User\User", inversedBy="role")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @DataMapper\Object()
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

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
