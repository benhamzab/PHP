<?php

namespace App\Controller;

use App\Entity\Secretary;
use App\Form\SecretaryType;
use App\Repository\SecretaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

#[Route('/secretary')]
final class SecretaryController extends AbstractController
{
        #[Route('/login', name: 'app_login')]
        public function login(): Response
        {
            return $this->render('security/login.html.twig');
        }
    
        #[Route('/logout', name: 'app_logout')]
        public function logout(): void
        {
            throw new \LogicException('This will be handled by Symfony firewall.');
        }

    // List all secretaries
    #[Route('/', name: 'app_secretary_index', methods: ['GET'])]
    public function index(SecretaryRepository $secretaryRepository, LoggerInterface $logger): Response
    {
        // Fetch all secretaries from the database
        $secretaries = $secretaryRepository->findAll();

        // Log to check if function is called
        $logger->info('SecretaryController: index method called, found ' . count($secretaries) . ' records.');

        return $this->render('secretary/index.html.twig', [
            'secretaries' => $secretaries,
        ]);
    }

    // Create a new secretary
    #[Route('/new', name: 'app_secretary_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secretary = new Secretary();
        $form = $this->createForm(SecretaryType::class, $secretary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secretary);
            $entityManager->flush();

            $this->addFlash('success', 'Secretary added successfully!');

            return $this->redirectToRoute('app_secretary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secretary/form.html.twig', [
            'form' => $form->createView(),
            'formTitle' => 'Add New Secretary'
        ]);
    }

    // Show secretary details
    #[Route('/{id}', name: 'app_secretary_show', methods: ['GET'])]
    public function show(Secretary $secretary): Response
    {
        return $this->render('secretary/show.html.twig', [
            'secretary' => $secretary,
        ]);
    }

    // Edit secretary details
    #[Route('/{id}/edit', name: 'app_secretary_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Secretary $secretary, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecretaryType::class, $secretary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Secretary updated successfully!');
            return $this->redirectToRoute('app_secretary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secretary/edit.html.twig', [
            'secretary' => $secretary,
            'form' => $form->createView(),
        ]);
    }

    // Delete a secretary
    #[Route('/{id}', name: 'app_secretary_delete', methods: ['POST'])]
    public function delete(Request $request, Secretary $secretary, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secretary->getId(), $request->request->get('_token'))) {
            $entityManager->remove($secretary);
            $entityManager->flush();

            $this->addFlash('success', 'Secretary deleted successfully!');
        }

        return $this->redirectToRoute('app_secretary_index', [], Response::HTTP_SEE_OTHER);
    }
}
