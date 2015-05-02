<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/04/15
 * Time: 12:43
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * University
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\UniversityRepository")
 */
class University {
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
     * @ORM\Column(name="cif", type="string", length=9)
     */
    private $cif;
    /**
     * @var string
     *
     * @ORM\Column(name="type",  type="string", length=100)
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="College",mappedBy="university")
     */
    private $colleges;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->colleges = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * Set cif
     *
     * @param string $cif
     *
     * @return University
     */
    public function setCif($cif)
    {
        $this->cif = $cif;

        return $this;
    }

    /**
     * Get cif
     *
     * @return string
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * Set typo
     *
     * @param string $typo
     *
     * @return University
     */
    public function setTypo($typo)
    {
        $this->typo = $typo;

        return $this;
    }

    /**
     * Get typo
     *
     * @return string
     */
    public function getTypo()
    {
        return $this->typo;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return University
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
     * Add college
     *
     * @param \AppBundle\Entity\College $college
     *
     * @return University
     */
    public function addCollege(\AppBundle\Entity\College $college)
    {
        $this->colleges[] = $college;

        return $this;
    }

    /**
     * Remove college
     *
     * @param \AppBundle\Entity\College $college
     */
    public function removeCollege(\AppBundle\Entity\College $college)
    {
        $this->colleges->removeElement($college);
    }

    /**
     * Get colleges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getColleges()
    {
        return $this->colleges;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return University
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
