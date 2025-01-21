<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // If the user is logged in, redirect to the secretary page
        if ($this->getUser()) {
            return $this->redirectToRoute('app_secretary_index');
        }

        // If the user is not logged in, redirect to login
        return $this->redirectToRoute('app_login');
    }
}

