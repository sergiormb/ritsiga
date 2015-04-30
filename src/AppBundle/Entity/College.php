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
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UniversityRepository")
 */
class College {
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;
    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;
    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="text")
     */
    private $ciudad;
    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="text")
     */
    private $provincia;
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_postal", type="integer", length=5)
     */
    private $cod_postal;
    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer", length=20, nullable=true)
     */
    private $telefono;
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
    private $universidad;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AcademicDegree", mappedBy="colleges")
     */
    private $academic_degrees;

    /**
     * @return mixed
     */
    public function getAcademicDegrees()
    {
        return $this->academic_degrees;
    }

    /**
     * @param mixed $academic_degrees
     */
    public function setAcademicDegrees($academic_degrees)
    {
        $this->academic_degrees = $academic_degrees;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param string $ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param string $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * @return int
     */
    public function getCodPostal()
    {
        return $this->cod_postal;
    }

    /**
     * @param int $cod_postal
     */
    public function setCodPostal($cod_postal)
    {
        $this->cod_postal = $cod_postal;
    }

    /**
     * @return int
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param int $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return int
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param int $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
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
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return University
     */
    public function getUniversidad()
    {
        return $this->universidad;
    }

    /**
     * @param University $universidad
     */
    public function setUniversidad(University $universidad)
    {
        $this->universidad = $universidad;
    }
}