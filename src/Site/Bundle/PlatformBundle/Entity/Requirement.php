<?php

namespace Site\Bundle\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Site\Bundle\PlatformBundle\lib\MyConst;

/**
 * Requirement
 *
 * @ORM\Table(name="requirement")
 * @ORM\Entity(repositoryClass="Site\Bundle\PlatformBundle\Entity\RequirementRepository")
 */
class Requirement
{

    /**
     * Constructs a new instance of User
     */
    public function __construct()
    {
        $this->updateTime = new \DateTime();
    }

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
     * @ORM\Column(name="company_type", type="string", length=255)
     */
    private $companyType;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;


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
     * @ORM\Column(name="update_time", type="datetime")
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="requirement")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    private $contact;


    /**
     * @var string //部门
     *
     * @ORM\Column(name="department", type="string", length=255)
     */
    private $department;

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
     * Get subject
     *
     * @return string
     */
    public function getFormatSubject()
    {

        if (!empty($this->subject) && (mb_strlen($this->subject, 'utf-8') > 15)) {
            return mb_strcut($this->subject, 0, 40, 'utf-8') . '...';
        }

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
        $sports = MyConst::$sportsZhArr;
        if ($this->sports) {
            return $sports[$this->sports];
        } else {
            return '';
        }
    }


    /**
     * Get getDepartmentZh
     *
     * @return string
     */
    public function getDepartmentZh()
    {
        $department = MyConst::$departmentZhArr;
        if ($this->department) {
            return $department[$this->department];
        } else {
            return '';
        }
    }


    /**
     * Get getCompanyTypeZh
     *
     * @return string
     */
    public function getCompanyTypeZh()
    {
        $arr = MyConst::$companyTypeZhArr;
        if ($this->companyType) {
            return $arr[$this->companyType];
        } else {
            return '';
        }
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Requirement
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set department
     *
     * @param string $department
     * @return Requirement
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
     * Set companyType
     *
     * @param string $companyType
     * @return Requirement
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * Get companyType
     *
     * @return string
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }
}
