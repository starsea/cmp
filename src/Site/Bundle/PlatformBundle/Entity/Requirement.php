<?php

namespace Site\Bundle\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Requirement
 *
 * @ORM\Table(name="requirement")
 * @ORM\Entity(repositoryClass="Site\Bundle\PlatformBundle\Entity\RequirementRepository")
 */
class Requirement
{
    const STATUS_COMMUNICATION = 1;
    const STATUS_COLLECTION = 2;
    const STATUS_PROCESS = 3;
    const STATUS_OVER = 4;

    const CATEGORY_ONLINE = 1;
    const CATEGORY_OFFLINE = 2;

    // 需求状态
    public static $statusZhArr = array(
        self::STATUS_COMMUNICATION => '客户沟通',
        self::STATUS_COLLECTION => '需求收集',
        self::STATUS_PROCESS => '项目进行',
        self::STATUS_OVER => '需求结束'
    );

    public static $categoryZhArr = array(
        self::CATEGORY_ONLINE => '线上需求',
        self::CATEGORY_OFFLINE => '线下需求',
    );

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=255)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;


    /**
     * @var string
     *
     * @ORM\Column(name="background", type="text")
     */
    private $background;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="date")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="date")
     */
    private $endTime;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="initiator", type="string", length=255)
     */
    private $initiator;


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
     * Set subject
     *
     * @param string $subject
     * @return Requirement
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Requirement
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set background
     *
     * @param string $background
     * @return Requirement
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Requirement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Requirement
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Requirement
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Requirement
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
//        $status = self::$currStatus;
//        return $status[$this->status];
        return $this->status;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Requirement
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set initiator
     *
     * @param string $initiator
     * @return Requirement
     */
    public function setInitiator($initiator)
    {
        $this->initiator = $initiator;

        return $this;
    }

    /**
     * Get initiator
     *
     * @return string
     */
    public function getInitiator()
    {
        return $this->initiator;
    }


    /**
     * Set province
     *
     * @param string $province
     * @return Requirement
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Requirement
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }


    /**
     * Get status for chinese
     *
     * @return string
     */
    public function getStatusZh()
    {
        $status = self::$statusZhArr;
        return $status[$this->status];
    }


    /**
     * Get category for chinese
     *
     * @return string
     */
    public function getCategoryZh()
    {
        $category = self::$categoryZhArr;
        return $category[$this->$category];
    }
}
