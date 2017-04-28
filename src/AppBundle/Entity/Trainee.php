<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 12/20/2016
 * Time: 11:36 AM
 */

namespace AppBundle\Entity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\RepositoryORM\Trainee")
 * @ORM\Table(name="trainee")
 */
use Doctrine\ORM\Mapping as ORM;

class Trainee
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=200)
     */
    private $email;
    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $age;
    /**
     * @ORM\Column(type="string", length=400)
     */
    private $address;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $mobile;
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $gender;
    /**
     * @ORM\Column(type="float", length=6)
     */
    private $gpa;
    /**
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="gpaCompany",referencedColumnName="id")
     */
    private $gpaCompany;
    /**
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="luckListCompany",referencedColumnName="id")
     */
    private $luckListCompany;
    /**
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="selectedCompany",referencedColumnName="id")
     */
    private $selectedCompany;
    /**
     * @ORM\Column(name="luckNo",type="integer", length=100)
     */
    private $luckNo;
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
     * @return Trainee
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
     * @return Trainee
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
     * Set age
     *
     * @param integer $age
     * @return Trainee
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Trainee
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Trainee
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     * @return Trainee
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set gpa
     *
     * @param string $gpa
     * @return Trainee
     */
    public function setGpa($gpa)
    {
        $this->gpa = $gpa;

        return $this;
    }

    /**
     * Get gpa
     *
     * @return string
     */
    public function getGpa()
    {
        return $this->gpa;
    }

    /**
     * Set gpaCompany
     *
     * @param \AppBundle\Entity\Company $gpaCompany
     * @return Trainee
     */
    public function setGpaCompany(\AppBundle\Entity\Company $gpaCompany = null)
    {
        $this->gpaCompany = $gpaCompany;

        return $this;
    }

    /**
     * Get gpaCompany
     *
     * @return \AppBundle\Entity\Company 
     */
    public function getGpaCompany()
    {
        return $this->gpaCompany;
    }

    /**
     * Set luckListCompany
     *
     * @param \AppBundle\Entity\Company $luckListCompany
     * @return Trainee
     */
    public function setLuckListCompany(\AppBundle\Entity\Company $luckListCompany = null)
    {
        $this->luckListCompany = $luckListCompany;

        return $this;
    }

    /**
     * Get luckListCompany
     *
     * @return \AppBundle\Entity\Company 
     */
    public function getLuckListCompany()
    {
        return $this->luckListCompany;
    }

    /**
     * Set selectedCompany
     *
     * @param \AppBundle\Entity\Company $selectedCompany
     * @return Trainee
     */
    public function setSelectedCompany(\AppBundle\Entity\Company $selectedCompany = null)
    {
        $this->selectedCompany = $selectedCompany;

        return $this;
    }

    /**
     * Get selectedCompany
     *
     * @return \AppBundle\Entity\Company 
     */
    public function getSelectedCompany()
    {
        return $this->selectedCompany;
    }

    /**
     * Set luckNo
     *
     * @param integer $luckNo
     * @return Trainee
     */
    public function setLuckNo($luckNo)
    {
        $this->luckNo = $luckNo;

        return $this;
    }

    /**
     * Get luckNo
     *
     * @return integer 
     */
    public function getLuckNo()
    {
        return $this->luckNo;
    }
}
