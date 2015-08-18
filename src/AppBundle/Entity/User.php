<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 24/03/15
 * Time: 22:09
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Convention", mappedBy="administrators")
     */
    private $admin_conventions;


    /** @ORM\ManyToOne(targetEntity="\AppBundle\Entity\StudentDelegation", inversedBy="users") */
    private $student_delegation;


    /**
     * @return mixed
     */
    public function getCollege()
    {
        return $this->getStudentDelegation()->getCollege();
    }

    /**
     * @return mixed
     */
    public function getUniversity()
    {
        return $this->getStudentDelegation()->getCollege()->getUniversity();
    }

    /**
     * @return mixed
     */
    public function getStudentDelegation()
    {
        return $this->student_delegation;
    }

    /**
     * @param mixed $student_delegation
     */
    public function setStudentDelegation($student_delegation)
    {
        $this->student_delegation = $student_delegation;
    }

    /**
     * @return mixed
     */
    public function getAdminConventions()
    {
        return $this->admin_conventions;
    }

    /**
     * @param mixed $admin_conventions
     */
    public function setAdminConventions($admin_conventions)
    {
        $this->admin_conventions = $admin_conventions;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

    /**
     * @return mixed
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * @param mixed $google_id
     */
    public function setGoogleId($google_id)
    {
        $this->google_id = $google_id;
    }

    /**
     * @return mixed
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }

    /**
     * @param mixed $google_access_token
     */
    public function setGoogleAccessToken($google_access_token)
    {
        $this->google_access_token = $google_access_token;
    }



    /**
     * Add adminConvention
     *
     * @param \AppBundle\Entity\Convention $adminConvention
     *
     * @return User
     */
    public function addAdminConvention(\AppBundle\Entity\Convention $adminConvention)
    {
        $this->admin_conventions[] = $adminConvention;

        return $this;
    }

    /**
     * Remove adminConvention
     *
     * @param \AppBundle\Entity\Convention $adminConvention
     */
    public function removeAdminConvention(\AppBundle\Entity\Convention $adminConvention)
    {
        $this->admin_conventions->removeElement($adminConvention);
    }

    /*
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param integer $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $this->getEmail() ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}
