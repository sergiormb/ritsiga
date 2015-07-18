<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Convention
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Organization
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255)
     */
    private $web;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getOrganizations()
    {
        return $this->organizations;
    }

    /**
     * @param string $organizations
     */
    public function setOrganizations($organizations)
    {
        $this->organizations = $organizations;
    }

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Convention",mappedBy="organization")
     */
    private $conventions;


    /**
     * @return string
     */
    public function getConventions()
    {
        return $this->conventions;
    }

    /**
     * @param string $conventions
     */
    public function setConventions($conventions)
    {
        $this->conventions = $conventions;
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
     * Constructor
     */
    public function __construct()
    {
        $this->conventions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add convention
     *
     * @param \AppBundle\Entity\Convention $convention
     *
     * @return Organization
     */
    public function addConvention(\AppBundle\Entity\Convention $convention)
    {
        $this->conventions[] = $convention;

        return $this;
    }

    /**
     * Remove convention
     *
     * @param \AppBundle\Entity\Convention $convention
     */
    public function removeConvention(\AppBundle\Entity\Convention $convention)
    {
        $this->conventions->removeElement($convention);
    }

    public function __toString()
    {
        return $this->name;
    }
}
