<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class API extends AbstractController
{
    #[Route('/api', name: 'api')]
    public function index(): Response
    {
        return new JsonResponse([
            'message' => 'API v1',
        ]);
    }
}