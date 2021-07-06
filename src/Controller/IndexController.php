<?php


namespace App\Controller;

use App\Services\AnimalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    private AnimalService $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
    }

    /**
     * @Route ("/{animalName}")
     */
    public function getAnimalByName(string $animalName): JsonResponse
    {

        try {
            $animal = $this->animalService->getAnimalsByName($animalName);
            return new JsonResponse($animal);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * @Route ("/{firstAnimalName}/{secondAnimalName}")
     */
    public function getNewAnimalBreed($firstAnimalName, $secondAnimalName): JsonResponse
    {

        try {
            $animals = $this->animalService->getNewAnimal($firstAnimalName, $secondAnimalName);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), $exception->getCode());
        }


        return new JsonResponse($animals);
    }
}