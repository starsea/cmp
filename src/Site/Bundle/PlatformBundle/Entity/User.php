<?php


namespace Site\Bundle\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Site\Bundle\PlatformBundle\Entity\UserRepository")
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, name="name")
     *
     * @var string $name
     */
    protected $name;


    /**
     * @ORM\Column(type="string", length=255,name="email")
     *
     * @var string $email
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255 ,name="password")
     *
     * @var string $password
     */

    protected $password;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var \DateTime $createdAt
     */

    protected $createdAt;


    /**
     * @ORM\OneToMany(targetEntity="Requirement", mappedBy="contact")
     */
    protected $requirement;


    /**
     * @ORM\Column(type="string", length=255,name="department")
     *
     * @var string $department
     */
    protected $department;

    /**
     * @ORM\Column(type="string", length=255,name="location")
     *
     * @var string $location
     */
    protected $location;


    /**
     * @ORM\Column(type="string", length=255,name="phone")
     *
     * @var string $phone
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=255,name="hupu_account")
     *
     * @var string $hupuAccount
     */
    protected $hupuAccount;


    /**
     * Constructs a new instance of User
     */
    public function __construct()
    {
        $this->requirement = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = md5($password);

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add requirement
     *
     * @param \Site\Bundle\PlatformBundle\Entity\Requirement $requirement
     * @return User
     */
    public function addRequirement(\Site\Bundle\PlatformBundle\Entity\Requirement $requirement)
    {
        $this->requirement[] = $requirement;

        return $this;
    }

    /**
     * Remove requirement
     *
     * @param \Site\Bundle\PlatformBundle\Entity\Requirement $requirement
     */
    public function removeRequirement(\Site\Bundle\PlatformBundle\Entity\Requirement $requirement)
    {
        $this->requirement->removeElement($requirement);
    }

    /**
     * Get requirement
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequirement()
    {
        return $this->requirement;
    }

    /**
     * Set department
     *
     * @param string $department
     * @return User
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return User
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set hupuAccount
     *
     * @param string $hupuAccount
     * @return User
     */
    public function setHupuAccount($hupuAccount)
    {
        $this->hupuAccount = $hupuAccount;

        return $this;
    }

    /**
     * Get hupuAccount
     *
     * @return string 
     */
    public function getHupuAccount()
    {
        return $this->hupuAccount;
    }
}
