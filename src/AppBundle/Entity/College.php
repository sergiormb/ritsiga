<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/04/15
 * Time: 12:45
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * College
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\CollegeRepository")
 */
class College
{
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200)
     */
    private $address;
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=100)
     */
    private $province;
    /**
     * @var integer
     *
     * @ORM\Column(name="postcode", type="integer", length=5)
     */
    private $postcode;
    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", length=20, nullable=true)
     */
    private $phone;
    /**
     * @var integer
     *
     * @ORM\Column(name="fax", type="integer", length=20, nullable=true)
     */
    private $fax;
    /**
     * @var string
     *
     * @ORM\Column(name="web", type="text", nullable=true)
     */
    private $web;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", nullable=true)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="text", nullable=true)
     */
    private $twitter;
    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="text", nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @var University
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\University", inversedBy="colleges")
     */
    private $university;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AcademicDegree", mappedBy="colleges")
     */
    private $academic_degrees;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="College", mappedBy="college")
     */
    private $students_delegations;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->academic_degrees = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return College
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
     * Set address
     *
     * @param string $address
     *
     * @return College
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
     * Set city
     *
     * @param string $city
     *
     * @return College
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
     * Set province
     *
     * @param string $province
     *
     * @return College
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
     * Set postcode
     *
     * @param integer $postcode
     *
     * @return College
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return integer
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return College
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     *
     * @return College
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set web
     *
     * @param string $web
     *
     * @return College
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return College
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
     * Set twitter
     *
     * @param string $twitter
     *
     * @return College
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return College
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return College
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set university
     *
     * @param \AppBundle\Entity\University $university
     *
     * @return College
     */
    public function setUniversity(\AppBundle\Entity\University $university = null)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university
     *
     * @return \AppBundle\Entity\University
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Add academicDegree
     *
     * @param \AppBundle\Entity\AcademicDegree $academicDegree
     *
     * @return College
     */
    public function addAcademicDegree(\AppBundle\Entity\AcademicDegree $academicDegree)
    {
        $this->academic_degrees[] = $academicDegree;

        return $this;
    }

    /**
     * Remove academicDegree
     *
     * @param \AppBundle\Entity\AcademicDegree $academicDegree
     */
    public function removeAcademicDegree(\AppBundle\Entity\AcademicDegree $academicDegree)
    {
        $this->academic_degrees->removeElement($academicDegree);
    }

    /**
     * Get academicDegrees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcademicDegrees()
    {
        return $this->academic_degrees;
    }

    /**
     * Add studentsDelegation
     *
     * @param \AppBundle\Entity\College $studentsDelegation
     *
     * @return College
     */
    public function addStudentsDelegation(\AppBundle\Entity\College $studentsDelegation)
    {
        $this->students_delegations[] = $studentsDelegation;

        return $this;
    }

    /**
     * Remove studentsDelegation
     *
     * @param \AppBundle\Entity\College $studentsDelegation
     */
    public function removeStudentsDelegation(\AppBundle\Entity\College $studentsDelegation)
    {
        $this->students_delegations->removeElement($studentsDelegation);
    }

    /**
     * Get studentsDelegations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudentsDelegations()
    {
        return $this->students_delegations;
    }

    public function __toString()
    {
        return $this->name;
    }
}
