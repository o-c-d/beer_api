<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\Store\BiereStore;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class StyleController extends AbstractController
{
    #[Route(
        name: 'style_count',
        path: '/api/styles',
        methods: ['GET'],
    )]
    public function stylesByBiere(BiereStore $repository): JsonResponse
    {
        $results = $repository->countBieresByStyle();
        return new JsonResponse($results);
    }
}