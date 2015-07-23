<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 19/04/15
 * Time: 19:53
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $last_name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9)
     */
    private $dni;

    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Registration", inversedBy="participants") */
    private $registration;

    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\ParticipantType", inversedBy="participants_types") */
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
     * Set address
     *
     * @param string $address
     *
     * @return Participant
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
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Participant
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
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
}
