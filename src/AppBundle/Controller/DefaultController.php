<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conventions = $this->getDoctrine()->getRepository('AppBundle:Convention')->findConventionsAvailables();
	    return $this->render('Conventions/list_convetions.html.twig', array('conventions' => $conventions,
        'user'=> $user,));
    }
}
