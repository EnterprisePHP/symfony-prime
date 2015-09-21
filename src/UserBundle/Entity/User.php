<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;


/**
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    use SoftDeleteableEntity;
    use TimestampableEntity;
    use BlameableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\Versioned
     * @inheritdoc
     */
    protected $email;

    /**
     * @Gedmo\Versioned
     * @inheritdoc
     */
    protected $username;

    /**
     * @Gedmo\Versioned
     * @inheritdoc
     */
    protected $password;

    /**
     * @Gedmo\Versioned
     * @inheritdoc
     */
    protected $roles;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $firstName;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $lastName;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
}
