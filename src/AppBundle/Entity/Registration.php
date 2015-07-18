<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 19/04/15
 * Time: 19:52
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Registration
 *
 * @ORM\Entity
 * @ORM\Table(name="Registration")
 */
class Registration {
    const STATUS_OPEN= 'open';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';

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
     * @ORM\Column(name="name", type="string", length=140)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=100)
     */
    private $position;


    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User", inversedBy="registrations") */
    private $user;

    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Convention", inversedBy="registrations") */
    private $convention;

    /**
     *
     * @ORM\OneToMany(targetEntity="Participant",mappedBy="registration")
     */
    private $participants;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     * @Assert\Choice(choices={"open", "confirmed", "paid", "canceled"})
     * @Serializer\Exclude
     */
    private $status;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->status = self::STATUS_OPEN;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Registration
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
     * Set position
     *
     * @param string $position
     *
     * @return Registration
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add participant
     *
     * @param \AppBundle\Entity\Participant $participant
     *
     * @return Registration
     */
    public function addParticipant(\AppBundle\Entity\Participant $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \AppBundle\Entity\Participant $participant
     */
    public function removeParticipant(\AppBundle\Entity\Participant $participant)
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        if (!in_array($status, self::getStatuses())) {
            throw new \InvalidArgumentException('Wrong status type supplied.');
        }
        $this->status = $status;
        return $this;
    }

    /**
     * Get all status values
     *
     * @return array
     */
    public static function getStatuses()
    {
        return array(self::STATUS_APPROVED, self::STATUS_CHECK, self::STATUS_DENIED, self::STATUS_PENDING);
    }

}
