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
            $convocation->setEtat(true);
            $entityManager->persist($convocation);
            $entityManager->flush();

            return $this->redirectToRoute('app_etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('convocation/new.html.twig', [
            'convocation' => $convocation,
            'form' => $form,
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
