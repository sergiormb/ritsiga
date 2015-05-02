<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 19/04/15
 * Time: 19:52
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Registration
 *
 * @ORM\Entity
 * @ORM\Table(name="Registration")
 */
class Registration {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User", inversedBy="registrations") */
    private $user;

    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Convention", inversedBy="registrations") */
    private $convention;



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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Registration
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set convention
     *
     * @param \AppBundle\Entity\Convention $convention
     *
     * @return Registration
     */
    public function setConvention(\AppBundle\Entity\Convention $convention = null)
    {
        $this->convention = $convention;

        return $this;
    }

    /**
     * Get convention
     *
     * @return \AppBundle\Entity\Convention
     */
    public function getConvention()
    {
        return $this->convention;
    }
}
