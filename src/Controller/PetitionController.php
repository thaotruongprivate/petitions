<?php

namespace App\Controller;

use App\Entity\Petition;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PetitionController extends AbstractController
{
    /**
     * @Route("/api/petitions", methods={"GET"}, name="list_petitions")
     */
    public function all(ManagerRegistry $doctrine): JsonResponse
    {
        return new JsonResponse(array_map(function (Petition $petition) {
            return $this->parsePetition($petition);
        },
            $doctrine->getRepository(Petition::class)
                ->findAll()));
    }

    /**
     * @Route("/api/petitions", methods={"POST"}, name="create_petition")
     */
    public function create(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        try {
            $body = json_decode($request->getContent(), true);
            if (json_last_error()) {
                throw new Exception('Request body is not json');
            }
            if (empty($body['name']) || empty($body['country'] || empty($body['description']))) {
                throw new Exception('Missing information for petition creation');
            }
            $petition = new Petition();
            $petition->setName($body['name'])->setCountry($body['country'])
                ->setDescription($body['description']);
            $doctrine->getManager()->persist($petition);
            $doctrine->getManager()->flush();
            return new JsonResponse([
                'error' => false,
                'petition' => $this->parsePetition($petition)
            ], 201);
        } catch (Exception $exception) {
            return new JsonResponse([
                'error' => true,
                'errorMessage' => $exception->getMessage()
            ], 500);
        }
    }

    #[ArrayShape(['id' => "", 'name' => "", 'description' => "", 'country' => "", 'dateCreated' => ""])] private function parsePetition(Petition $petition): array
    {
        return [
            'id' => $petition->getId(),
            'name' => $petition->getName(),
            'description' => $petition->getDescription(),
            'country' => $petition->getCountry(),
            'dateCreated' => $petition->getDateCreated()->format('Y-m-d H:i:s')
        ];
    }
}