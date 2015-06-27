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



class ConventionController extends Controller
{
    /**
     * @Route("/", name="convention", host="{hostname}.%base_host%")
     */
    public function showConvention()
    {
        $siteManager = $this->container->get('ritsiga.site.manager');
        $convention = $siteManager->getCurrentSite();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $registrations = $convention->getRegistrations();
        $inscriptions = count($registrations);

        return $this->render('Conventions/convention.html.twig', array(
            'convention' => $convention,
            'user'=> $user,
            'inscriptions' => $inscriptions,
        ));
    }

}