<?php

namespace AuthBundle\Entity\Access;

use Doctrine\ORM\Mapping as ORM;
use RAPIBundle\DataMapper\Annotation as DataMapper;
use AuthBundle\Entity\User\User;
use AuthBundle\Entity\Role\Role;

/**
 * Class Access
 *
 * @ORM\Entity()
 * @ORM\Table(name="access")
 * @DataMapper\Mapper()
 */
class Access
{
    const ID = "id";
    const ROUTE = "route";
    const USER = "user";
    const ROLE = "role";

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $route;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\User\User", inversedBy="accesses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $user;

    /**
     * @var Role
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\Role\Role", inversedBy="accesses")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
     */
    protected $role;

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
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param $route
     * @return $this
     */
    public function setRoute($route)
    {
        $this->route = $route;

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
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function setRole(Role $role)
    {
        $this->role = $role;

        return $this;
    }
}
