<?php

namespace App\Controller;

use App\Form\CsvImportTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiant;

class EtudiantImportController extends AbstractController
{
    #[Route('/import_etudiant', name: 'import_etudiant')]
    public function importEtudiant(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CsvImportTypeForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['csv_file']->getData();

            if (($handle = fopen($file->getPathname(), 'r')) !== FALSE) {
                $header = fgetcsv($handle, 1000, ";");

                while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $eleve = new Etudiant();
                    $eleve->setNom($row[0]);
                    $eleve->setPrenom($row[1]);
                    $eleve->setEmail($row[2]);
                    $eleve->setTelephone($row[3]);


                    $manager->persist($eleve);
                }
                fclose($handle);
                $manager->flush();

                $this->addFlash('success', 'Import avec succes');
                return $this->redirectToRoute('app_etudiant_index');
            }
        }
        return $this->render('import/etudiant.html.twig', [
            'form' => $form->createView(),]);
    }
}
