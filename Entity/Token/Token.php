<?php

namespace AuthBundle\Entity\Token;

use DateTime;
use AuthBundle\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use RAPIBundle\DataMapper\Annotation as DataMapper;

/**
 * Class Token
 *
 * @ORM\Entity(repositoryClass="AuthBundle\Entity\Token\TokenRepository")
 * @ORM\Table(name="token")
 * @ORM\HasLifecycleCallbacks()
 * @DataMapper\Mapper()
 */
class Token
{
    const ID = "id";
    const TOKEN = "token";
    const USER = "use";
    const CREATED_AT = "createdAt";
    const EXPIRES_AT = "expiresAt";

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
    protected $token;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\User\User", inversedBy="tokens")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    protected $expiresAt;

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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

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
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param DateTime $expiresAt
     * @return $this
     */
    public function setExpiresAt(DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
