<?php
/**
 * Created by PhpStorm.
 * User: tfg
 * Date: 18/08/15
 * Time: 17:12
 */

namespace AppBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use ZipArchive;
use AppBundle\Entity\Convention;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\BrowserKit\Response;

class ConventionCRUDController extends Controller
{
    public function acreditationAction(Convention $convention, Request $request)
    {
        $registrations = $convention->getRegistrations();

        $zip = new ZipArchive();
        $title = $convention->getDomain();
        $filename = tempnam('/tmp/','ritsiGA-'.$title.'-');
        unlink($filename);

        if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
            throw new \Exception ("cannot open <$filename>\n");
        }

        if (FALSE === $zip->addEmptyDir($title)) {
            throw new \Exception ("cannot add empty dir $title\n");
        }

        $route_dir = $this->container->getParameter('kernel.root_dir');
        foreach ($registrations as $registration)
        {
            foreach ($registration->getParticipants() as $participant)
            {
                $single_file = $route_dir . '/../private/documents/acreditations/' . $participant->getId() . '.pdf';
                if (FALSE === file_exists($single_file)) {
                    continue;
                }
                $name = $participant->getId();
                if (FALSE === $zip->addFile (
                        $single_file,
                        implode('/', array ($title, $name.'.pdf'))
                    )) {
                    throw new \Exception ("cannot add file\n");
                }
            }

        }
        if (FALSE === $zip->close()) {
            throw new \Exception ("cannot close <$filename>\n");
        }

        $response = new BinaryFileResponse($filename);
        $response->trustXSendfileTypeHeader();
        $response->prepare($request);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $convention->getDomain().'-acreditaciones.zip',
            iconv('UTF-8', 'ASCII//TRANSLIT', $convention->getDomain().'-acreditaciones.zip')
        );

        return $response;
    }

    public function invoiceAction(Convention $convention, Request $request)
    {
        $registrations = $convention->getRegistrations();

        $zip = new ZipArchive();
        $title = $convention->getDomain();
        $filename = tempnam('/tmp/','ritsiGA-'.$title.'-');
        unlink($filename);

        if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
            throw new \Exception ("cannot open <$filename>\n");
        }

        if (FALSE === $zip->addEmptyDir($title)) {
            throw new \Exception ("cannot add empty dir $title\n");
        }

        $route_dir = $this->container->getParameter('kernel.root_dir');
        foreach ($registrations as $registration)
        {

            $single_file = $route_dir . '/../private/documents/invoices/' . $registration->getId() . '.pdf';
            if (FALSE === file_exists($single_file)) {
                continue;
            }
            $name = $registration->getId();
            if (FALSE === $zip->addFile (
                    $single_file,
                    implode('/', array ($title, $name.'.pdf'))
                )) {
                throw new \Exception ("cannot add file\n");
            }

        }
        if (FALSE === $zip->close()) {
            throw new \Exception ("cannot close <$filename>\n");
        }

        $response = new BinaryFileResponse($filename);
        $response->trustXSendfileTypeHeader();
        $response->prepare($request);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $convention->getDomain().'-facturas.zip',
            iconv('UTF-8', 'ASCII//TRANSLIT', $convention->getDomain().'-facturas.zip')
        );

        return $response;
    }
}