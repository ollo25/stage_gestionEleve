<?php

namespace App\Controller;

use App\Entity\Convocation;
use App\Entity\Etudiant;
use App\Form\ConvocationForm;
use App\Repository\ConvocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EtudiantRepository;

#[Route('/convocation')]
final class ConvocationController extends AbstractController
{
    #[Route('/new', name: 'app_convocation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EtudiantRepository $etudiantRepository
    ): Response {
        $convocation = new Convocation();
        $etudiant = null;
        $etudiantId = $request->query->get('etudiant');
        if ($etudiantId) {
            $etudiant = $etudiantRepository->find($etudiantId);
            if ($etudiant) {
                $convocation->setRefEtudiant($etudiant);
            }
        }

        $form = $this->createForm(ConvocationForm::class, $convocation);
        $form->handleRequest($request);


        if ($etudiant) {
            $convocation->setRefEtudiant($etudiant);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($convocation);
            $entityManager->flush();

            return $this->redirectToRoute('app_etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('convocation/new.html.twig', [
            'convocation' => $convocation,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_convocation_show', methods: ['GET'])]
    public function show(Convocation $convocation): Response
    {
        return $this->render('convocation/show.html.twig', [
            'convocation' => $convocation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_convocation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Convocation $convocation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConvocationForm::class, $convocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_convocation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('convocation/edit.html.twig', [
            'convocation' => $convocation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_convocation_delete', methods: ['POST'])]
    public function delete(Request $request, Convocation $convocation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$convocation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($convocation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_convocation_index', [], Response::HTTP_SEE_OTHER);
    }
}
