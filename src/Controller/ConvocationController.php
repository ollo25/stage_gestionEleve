<?php

namespace App\Controller;

use App\Entity\Convocation;
use App\Entity\Etudiant;
use App\Form\ConvocationForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EtudiantRepository;

#[Route('/convocation')]
final class ConvocationController extends AbstractController
{
    #[Route('/new/{id}', name: 'app_convocation_new', methods: ['GET', 'POST'])]
    public function new(Request $request,Etudiant $etudiant =  null, EntityManagerInterface $entityManager, EtudiantRepository $etudiantRepository
    ): Response {
        $convocation = new Convocation();
        $form = $this->createForm(ConvocationForm::class, $convocation);
        $form->handleRequest($request);


        if ($etudiant) {
            $convocation->setRefEtudiant($etudiant);
        }
        $convocation->setRefResponsable($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $convocation->setEstOuverte(true);
            $entityManager->persist($convocation);
            $entityManager->flush();

            return $this->redirectToRoute('app_etudiant_show', ['id' => $convocation->getRefEtudiant()->getId()]);
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
    #[Route('/convocation/{id}/fermer', name: 'app_convocation_fermer', methods: ['POST'])]
    public function fermer(Convocation $convocation, EntityManagerInterface $em, Request $request): Response
    {
        if ($this->isCsrfTokenValid('fermer' . $convocation->getId(), $request->getPayload()->getString('_token'))) {
            $convocation->setEstOuverte(false);
            $em->flush();
        }

        return $this->redirectToRoute('app_etudiant_show', ['id' => $convocation->getRefEtudiant()->getId()]);
    }
}
