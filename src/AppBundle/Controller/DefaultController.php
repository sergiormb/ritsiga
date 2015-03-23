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
        $conventions = $this->getDoctrine()->getRepository('AppBundle:Convention')->findConventionsAvailables();
	    return $this->render('Default/index.html.twig', array('conventions' => $conventions));
    }
}
