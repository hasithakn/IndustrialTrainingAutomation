<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 12/21/2016
 * Time: 6:41 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\RepositoryORM\Company")
 * @ORM\Table(name="company")
 */
class Company
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
     * @ORM\Column(type="integer", length=10)
     */
    private $noOfTrainees;
    /**
     * @ORM\Column(type="string", length=300)
     */
    private $address;
    /**
     * @ORM\Column(type="string", length=12)
     */
    private $contactNo;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $discription;

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
     * @return Company
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
     * Set noOfTrainees
     *
     * @param integer $noOfTrainees
     * @return Company
     */
    public function setNoOfTrainees($noOfTrainees)
    {
        $this->noOfTrainees = $noOfTrainees;

        return $this;
    }

    /**
     * Get noOfTrainees
     *
     * @return integer 
     */
    public function getNoOfTrainees()
    {
        return $this->noOfTrainees;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Company
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
     * Set contactNo
     *
     * @param string $contactNo
     * @return Company
     */
    public function setContactNo($contactNo)
    {
        $this->contactNo = $contactNo;

        return $this;
    }

    /**
     * Get contactNo
     *
     * @return string 
     */
    public function getContactNo()
    {
        return $this->contactNo;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Company
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
     * Set discription
     *
     * @param string $discription
     * @return Company
     */
    public function setDiscription($discription)
    {
        $this->discription = $discription;

        return $this;
    }

    /**
     * Get discription
     *
     * @return string 
     */
    public function getDiscription()
    {
        return $this->discription;
    }

    public function __toString()
    {
       return $this->id !=null ? $this->getName():'New Recod';

    }
}
