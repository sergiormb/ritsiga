<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 22/04/15
 * Time: 12:48
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * AcademicDegree
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\AcademicDegreeRepository")
 */
class AcademicDegree
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
     * @ORM\Column(name="category", type="string", length=100)
     */
    private $category;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\College", mappedBy="academic_degrees")
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
     * @return AcademicDegree
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
     * Set category
     *
     * @param string $category
     *
     * @return AcademicDegree
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return AcademicDegree
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
     * @return AcademicDegree
     */
    public function addCollege(\AppBundle\Entity\College $college)
    {
        $college->addAcademicDegree($this);
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

    public function __toString()
    {
        return (string) $this->getName();
    }
}
