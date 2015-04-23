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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getConvention()
    {
        return $this->convention;
    }

    /**
     * @param mixed $convention
     */
    public function setConvention($convention)
    {
        $this->convention = $convention;
    }

}