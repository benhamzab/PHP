<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/medical')]
class MedicalController extends AbstractController
{
    #[Route('/', name: 'app_medical_index')]
    public function index(): Response
    {
        return $this->render('medical/index.html.twig', [
            'controller_name' => 'MedicalController',
        ]);
    }
}
