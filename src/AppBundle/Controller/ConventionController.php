<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 19/04/15
 * Time: 20:24
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Convention;
use AppBundle\Entity\Registration;
use AppBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ConventionController extends Controller
{
    /**
     * @Route("/", name="convention")
     */
    public function showConvention()
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();


        $user = $this->get('security.token_storage')->getToken()->getUser();



        return $this->render('Conventions/convention.html.twig', array(
            'convention' => $convention,
            'user'=> $user,
        ));
    }

    /**
     * @Route("/inscripcion", name="registration")
     * @Security("has_role('ROLE_USER')")
     */
    public function registrationAction()
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $registration= new Registration();
        $registration->setConvention($convention);
        $form = $this->createForm(new RegistrationType(), $registration);

        return $this->render('Conventions/registration.html.twig', array(
            'convention' => $convention,
            'form' => $form->createView(),
        ));
    }
}