<?php

namespace App\Controller;

use App\Entity\MedicalPrescription;
use App\Form\MedicalPrescriptionType;
use App\Repository\MedicalPrescriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/medical/prescription')]
final class MedicalPrescriptionController extends AbstractController
{
    #[Route(name: 'app_medical_prescription_index', methods: ['GET'])]
    public function index(MedicalPrescriptionRepository $medicalPrescriptionRepository): Response
    {
        return $this->render('medical_prescription/index.html.twig', [
            'medical_prescriptions' => $medicalPrescriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_medical_prescription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $medicalPrescription = new MedicalPrescription();
        $form = $this->createForm(MedicalPrescriptionType::class, $medicalPrescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($medicalPrescription);
            $entityManager->flush();

            return $this->redirectToRoute('app_medical_prescription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medical_prescription/new.html.twig', [
            'medical_prescription' => $medicalPrescription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medical_prescription_show', methods: ['GET'])]
    public function show(MedicalPrescription $medicalPrescription): Response
    {
        return $this->render('medical_prescription/show.html.twig', [
            'medical_prescription' => $medicalPrescription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medical_prescription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MedicalPrescription $medicalPrescription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MedicalPrescriptionType::class, $medicalPrescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_medical_prescription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('medical_prescription/edit.html.twig', [
            'medical_prescription' => $medicalPrescription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medical_prescription_delete', methods: ['POST'])]
    public function delete(Request $request, MedicalPrescription $medicalPrescription, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicalPrescription->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($medicalPrescription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_medical_prescription_index', [], Response::HTTP_SEE_OTHER);
    }
}
