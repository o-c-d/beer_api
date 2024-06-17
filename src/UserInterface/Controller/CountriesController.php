<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\Store\BrasserieStore;
use App\Entity\Brasserie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CountriesController extends AbstractController
{
    #[Route(
        name: 'country_count',
        path: '/api/countries',
        methods: ['GET'],
    )]
    public function countriesByBrasserie(BrasserieStore $brasserieStore): JsonResponse
    {
        $results = $brasserieStore->countBrasseriesByCountry();
        return new JsonResponse($results);
    }
}