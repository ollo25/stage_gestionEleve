<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Promotion;
use App\Form\CsvImportTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PromotionRepository;

class EtudiantImportController extends AbstractController
{
    #[Route('/import_etudiant', name: 'import_etudiant')]
    public function import(Request $request, EntityManagerInterface $manager , PromotionRepository $promotionRepository): Response
    {
        $form = $this->createForm(CsvImportTypeForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['csv_file']->getData();

            if (($handle = fopen($file->getPathname(), 'r')) !== false) {
                fgetcsv($handle, 1000, ";"); // ignore l'en-tête

                while (($row = fgetcsv($handle, 1000, ";")) !== false) {
                    $etudiant = new Etudiant();
                    $etudiant->setNom($row[0]);
                    $etudiant->setPrenom($row[1]);
                    $etudiant->setEmail($row[2]);
                    $etudiant->setTelephone($row[3]);

                    $promotion = $promotionRepository->findOneBy(['nom' => $row[4]]);
                    if (!$promotion) {
                        continue;
                    }
                    $etudiant->setRefPromotion($promotion);
                }

                fclose($handle);
                $manager->flush();

                $this->addFlash('success', 'Import réussi.');
            }

            return $this->redirectToRoute('app_etudiant_index');
        }

        // afficher le formulaire sur la même page
        return $this->redirectToRoute('app_etudiant_index');
    }
}
