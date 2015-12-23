<?php

namespace AuthBundle\Entity\User;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use RAPIBundle\DataMapper\Annotation as DataMapper;
use Doctrine\Common\Collections\ArrayCollection;
use AuthBundle\Entity\Token\Token;
use AuthBundle\Entity\Role\Role;
use AuthBundle\Entity\Access\Access;

/**
 * Class User
 *
 * @ORM\Entity()
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks()
 * @DataMapper\Mapper()
 */
class User
{
    const ID = "id";
    const USERNAME = "username";
    const PASSWORD = "password";
    const SALT = "salt";
    const EMAIL = "email";
    const ACTIVE = "active";
    const DELETED = "deleted";
    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";
    const ROLE = "role";
    const TOKENS = "tokens";
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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $salt;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $email;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $active = true;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $deleted = false;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var Token[]
     * @ORM\OneToMany(targetEntity="AuthBundle\Entity\Token\Token", mappedBy="user")
     */
    protected $tokens;

    /**
     * @var Role
     * @ORM\OneToOne(targetEntity="AuthBundle\Entity\Role\Role", mappedBy="user")
     */
    private $role;

    /**
     * Get access that is related only to this user, does not get main role access
     *
     * @var Access[]
     * @ORM\OneToMany(targetEntity="AuthBundle\Entity\Access\Access", mappedBy="user")
     */
    protected $accesses;

    public function __construct()
    {
        $this->tokens = new ArrayCollection();
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @DataMapper\String()
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @DataMapper\String()
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @DataMapper\String()
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @DataMapper\Bool()
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->active;
    }

    /**
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = (bool)$active;

        return $this;
    }

    /**
     * @DataMapper\Bool()
     * @return bool
     */
    public function isDeleted()
    {
        return (bool)$this->deleted;
    }

    /**
     * @param $deleted
     * @return $this
     */
    public function setDeleted($deleted)
    {
        $this->deleted = (bool)$deleted;

        return $this;
    }

    /**
     * @DataMapper\DateTime()
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->createdAt = new DateTime();

        return $this;
    }

    /**
     * @DataMapper\DateTime()
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PostUpdate()
     * @return $this
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new DateTime();

        return $this;
    }

    /**
     * @DataMapper\Object()
     * @return Token[]
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @DataMapper\Object()
     * @return Access[]
     */
    public function getAccesses()
    {
        return $this->accesses;
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
