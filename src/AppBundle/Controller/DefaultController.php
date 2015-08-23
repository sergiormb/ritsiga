<?php

namespace AppBundle\Controller;

use AppBundle\Entity\College;
use AppBundle\Entity\University;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conventions = $this->getDoctrine()->getRepository('AppBundle:Convention')->findConventionsAvailables();
	    return $this->render(':frontend/conventions:list_convetions.html.twig', array('conventions' => $conventions,
        'user'=> $user,));
    }

    /**
     * @Route("/profile/facultades/{id}", name="colleges_list")
     */
    public function getColleges(University $university)
    {
        $response = $this->getDoctrine()->getRepository('AppBundle:College')->findCollegeByUniversity($university);
        return new Response(json_encode($response), 200, array(
            'Content-Type' => 'application/json'
        ));
    }

    /**
     * @Route("/profile/delegaciones/{id}", name="students_delegations_list")
     */
    public function getStudentsDelegations(College $college)
    {
        $response = $this->getDoctrine()->getRepository('AppBundle:StudentDelegation')->findStudentDelegationByCollege($college);

        return new Response(json_encode($response), 200, array(
            'Content-Type' => 'application/json'
        ));
    }
}
