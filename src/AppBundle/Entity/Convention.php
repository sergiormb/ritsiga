<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Convention
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\ConventionRepository")
 */
class Convention
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
     * @ORM\Column(name="name", type="string", length=512)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255, nullable=true)
     */
    private $web;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starts_at", type="datetime")
     */
    private $startsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ends_at", type="datetime")
     */
    private $endsAt;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Organization", inversedBy="conventions") */
    private $organization;

    /**
     * @return string
     */
    public function getRegistrations()
    {
        return $this->registrations;
    }

    /**
     * @param string $registrations
     */
    public function setRegistrations($registrations)
    {
        $this->registrations = $registrations;
    }

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Registration",mappedBy="convention")
     */
    private $registrations;

    /**
     * @return mixed
     */
    public function getAdministrators()
    {
        return $this->administrators;
    }

    /**
     * @param mixed $administrators
     */
    public function setAdministrators($administrators)
    {
        $this->administrators = $administrators;
    }

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="admin_conventions")
     */
    private $administrators;

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
     * @return Convention
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
     * Set startsAt
     *
     * @param \DateTime $startsAt
     * @return Convention
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * Get startsAt
     *
     * @return \DateTime 
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * Set endsAt
     *
     * @param \DateTime $endsAt
     * @return Convention
     */
    public function setEndsAt($endsAt)
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    /**
     * Get endsAt
     *
     * @return \DateTime 
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Convention
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

    public function setOrganization(\AppBundle\Entity\Organization $organization) {
        $this->organization = $organization;
    }

    public function getOrganization() {
        return $this->organization;
    }

    /**
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @param string $web
     */
    public function setWeb($web)
    {
        $this->web = $web;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function __toString()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registrations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->administrators = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add registration
     *
     * @param \AppBundle\Entity\Registration $registration
     *
     * @return Convention
     */
    public function addRegistration(\AppBundle\Entity\Registration $registration)
    {
        $this->registrations[] = $registration;

        return $this;
    }

    /**
     * Remove registration
     *
     * @param \AppBundle\Entity\Registration $registration
     */
    public function removeRegistration(\AppBundle\Entity\Registration $registration)
    {
        $this->registrations->removeElement($registration);
    }

    /**
     * Add administrator
     *
     * @param \AppBundle\Entity\User $administrator
     *
     * @return Convention
     */
    public function addAdministrator(\AppBundle\Entity\User $administrator)
    {
        $this->administrators[] = $administrator;

        return $this;
    }

    /**
     * Remove administrator
     *
     * @param \AppBundle\Entity\User $administrator
     */
    public function removeAdministrator(\AppBundle\Entity\User $administrator)
    {
        $this->administrators->removeElement($administrator);
    }
}
