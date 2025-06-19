<?php

namespace App\Controller;

use App\Entity\Alternance;
use App\Entity\Etudiant;
use App\Form\AlternanceForm;
use App\Repository\AlternanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/alternance')]
final class AlternanceController extends AbstractController
{
    #[Route(name: 'app_alternance_index', methods: ['GET'])]
    public function index(AlternanceRepository $alternanceRepository): Response
    {
        return $this->render('alternance/index.html.twig', [
            'alternances' => $alternanceRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_alternance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ?Etudiant $etudiant = null): Response
    {
        $alternance = new Alternance();
        $form = $this->createForm(AlternanceForm::class, $alternance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($alternance);

            if ($etudiant !== null) {
                $etudiant->setRefAlternance($alternance);
                $entityManager->persist($etudiant);
            }

            $entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return $this->json([
                    'message' => 'Stage créé avec succès',
                    'alternanceId' => $alternance->getId(),
                    'alternanceLabel' => $alternance->getPoste(),
                ]);
            }

            return $this->redirectToRoute('app_etudiant_show', ['id' => $etudiant->getId()]);
        }

        return $this->render('stage/new.html.twig', [
            'alternance' => $alternance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alternance_show', methods: ['GET'])]
    public function show(Alternance $alternance): Response
    {
        return $this->render('alternance/show.html.twig', [
            'alternance' => $alternance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alternance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alternance $alternance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlternanceForm::class, $alternance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_alternance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alternance/edit.html.twig', [
            'alternance' => $alternance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alternance_delete', methods: ['POST'])]
    public function delete(Request $request, Alternance $alternance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alternance->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($alternance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_alternance_index', [], Response::HTTP_SEE_OTHER);
    }
}
