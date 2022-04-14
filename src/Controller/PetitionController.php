<?php

namespace App\Controller;

use App\Entity\Petition;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PetitionController extends AbstractController
{
    /**
     * @Route("/api/petitions", methods={"GET"}, name="list_petitions")
     */
    public function all(ManagerRegistry $doctrine)
    {
        return new JsonResponse($doctrine->getRepository(Petition::class)
            ->findAll());
    }
}