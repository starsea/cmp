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
    const SPORTS_BASKETBALL = 'basketball';
    const SPORTS_FOOTBALL = 'football';
    const SPORTS_BADMINTON = 'badminton';
    const SPORTS_TENNIS = 'tennis';
    const SPORTS_PINGPANG = 'pingpang';
    const SPORTS_OTHER= 'other';






    // 运动项目
    public static $sportsZhArr = array(
        self::SPORTS_BASKETBALL => '篮球',
        self::SPORTS_FOOTBALL => '足球',
        self::SPORTS_BADMINTON => '羽毛球',
        self::SPORTS_TENNIS => '网球',
        self::SPORTS_PINGPANG => '乒乓球',
        self::SPORTS_OTHER => '其他',
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
     * @var string //需求主题
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string //运动项目
     *
     * @ORM\Column(name="sports", type="string", length=255)
     */
    private $sports;


    /**
     * @var string //单位性质
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
     * @var string //需求简述
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * //更新时间
     *
     * @ORM\Column(name="update_time", type="date")
     */
    private $updateTime;


    /**
     * @var \DateTime
     *
     * //报告时间
     *
     * @ORM\Column(name="report_time", type="date")
     */
    private $reportTime;


    /**
     * @var object //联系人
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    private $contact;


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
     * Set sports
     *
     * @param string $sports
     * @return Requirement
     */
    public function setSports($sports)
    {
        $this->sports = $sports;

        return $this;
    }

    /**
     * Get sports
     *
     * @return string 
     */
    public function getSports()
    {
        return $this->sports;
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
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Requirement
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set reportTime
     *
     * @param \DateTime $reportTime
     * @return Requirement
     */
    public function setReportTime($reportTime)
    {
        $this->reportTime = $reportTime;

        return $this;
    }

    /**
     * Get reportTime
     *
     * @return \DateTime 
     */
    public function getReportTime()
    {
        return $this->reportTime;
    }

    /**
     * Set contact
     *
     * @param \Site\Bundle\PlatformBundle\Entity\User $contact
     * @return Requirement
     */
    public function setContact(\Site\Bundle\PlatformBundle\Entity\User $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Site\Bundle\PlatformBundle\Entity\User 
     */
    public function getContact()
    {
        return $this->contact;
    }


    /**
     * Get sports for chinese
     *
     * @return string
     */
    public function getSportsZh()
    {
        $sports = self::$sportsZhArr;
        return $sports[$this->sports];
    }
}
