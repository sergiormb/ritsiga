<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 19/04/15
 * Time: 19:53
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Registration
 *
 * @ORM\Entity
 * @ORM\Table(name="Participant")
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\ParticipantRepository")
 */
class Participant {

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
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank
     */
    private $last_name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9)
     * @Assert\NotBlank
     */
    private $dni;

    /**
     * @ORM\JoinColumn(
     *     nullable=false,
     *     onDelete="CASCADE",
     * )
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Registration", inversedBy="participants")
     */
    private $registration;

    /** @ORM\ManyToOne(
     * targetEntity="\AppBundle\Entity\ParticipantType",
     * inversedBy="participants"
     * )
     * @ORM\JoinColumn(
     *     nullable=false,
     *     onDelete="CASCADE",
     * )
     */
    private $participant_type;

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
     * @return Participant
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Participant
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Participant
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
     * Set dni
     *
     * @param string $dni
     *
     * @return Participant
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set registration
     *
     * @param \AppBundle\Entity\Registration $registration
     *
     * @return Participant
     */
    public function setRegistration(\AppBundle\Entity\Registration $registration = null)
    {
        $this->registration = $registration;

        return $this;
    }

    /**
     * Get registration
     *
     * @return \AppBundle\Entity\Registration
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @return mixed
     */
    public function getParticipantType()
    {
        return $this->participant_type;
    }

    /**
     * @param mixed $participant_type
     */
    public function setParticipantType($participant_type)
    {
        $this->participant_type = $participant_type;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * To String
     * @return string
     */
    function __toString()
    {
        return sprintf("%s %s", $this->getName(), $this->getLastName());
    }


}
