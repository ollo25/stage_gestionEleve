<?php

namespace App\Controller;

use App\Entity\PotentielEleve;
use App\Form\PotentielEleveForm;
use App\Repository\PotentielEleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/potentiel_eleve')]
final class PotentielEleveController extends AbstractController
{
    #[Route(name: 'app_potentiel_eleve_index', methods: ['GET'])]
    public function index(PotentielEleveRepository $potentielEleveRepository): Response
    {
        return $this->render('potentiel_eleve/index.html.twig', [
            'potentiel_eleves' => $potentielEleveRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_potentiel_eleve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $potentielEleve = new PotentielEleve();
        $form = $this->createForm(PotentielEleveForm::class, $potentielEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($potentielEleve);
            $entityManager->flush();

            return $this->redirectToRoute('app_potentiel_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('potentiel_eleve/new.html.twig', [
            'potentiel_eleve' => $potentielEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_potentiel_eleve_show', methods: ['GET'])]
    public function show(PotentielEleve $potentielEleve): Response
    {
        return $this->render('potentiel_eleve/show.html.twig', [
            'potentiel_eleve' => $potentielEleve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_potentiel_eleve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PotentielEleve $potentielEleve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PotentielEleveForm::class, $potentielEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_potentiel_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('potentiel_eleve/edit.html.twig', [
            'potentiel_eleve' => $potentielEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_potentiel_eleve_delete', methods: ['POST'])]
    public function delete(Request $request, PotentielEleve $potentielEleve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$potentielEleve->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($potentielEleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_potentiel_eleve_index', [], Response::HTTP_SEE_OTHER);
    }
}
