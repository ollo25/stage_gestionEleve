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
    #[Route('/etudiant/import', name: 'app_etudiant_import', methods: ['POST'])] 
    public function import(Request $request, EntityManagerInterface $entityManager): Response
    {
        $file = $request->files->get('csv_file');

        if (!$file || !$file->isValid()) {
            $this->addFlash('error', 'Fichier CSV invalide');
            return $this->redirectToRoute('app_etudiant_index');
        }

        // Traitement du CSV
        $handle = fopen($file->getPathname(), 'r');
        $delimiter = ';';
        fgetcsv($handle, 1000, $delimiter);

        while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
            $etudiant = new Etudiant();
            $etudiant->setNom($data[1]);
            $etudiant->setPrenom($data[2]);
            $etudiant->setEmail($data[8]);
            $etudiant->setTelephone($data[9]);
            $etudiant->setRefPromotion($data[4]);
            $entityManager->persist($etudiant);
        }

        fclose($handle);
        $entityManager->flush();
        $this->addFlash('success', 'Import réussi !');

        return $this->redirectToRoute('app_etudiant_index');
    }
}
