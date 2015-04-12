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
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\UserRepository")
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


}
