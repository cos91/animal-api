<?php


namespace App\Services;


use App\Factory\AnimalFactory;
use App\Factory\HybridFactory;
use App\Model\Base\BaseClassicAnimal;

use App\Settings\Config;


class AnimalService
{
    private static array $animals = [];

    public static function getAnimals(): array
    {

        $jsonAnimalsData = self::fetchAllAnimalsFromJson(file_get_contents(Config::JSON_URL));

        foreach ($jsonAnimalsData as $data) {
            self::$animals[$data['name']] = self::createAnimalsFromData($data);
        }

        return self::$animals;


    }


    /**
     * @throws \Exception
     */
    public function getAnimalsByName($animalName){


        /** @var BaseClassicAnimal[] $availableAnimals */
        $availableAnimals = self::getAnimals();

        if (isset($availableAnimals[$animalName]))
        {
           return $availableAnimals[$animalName]->getDescription();
        }

        throw new \Exception('BaseAnimal not found',404);


    }


    public function getAllAvailableAnimals(): array
    {
        return self::getAnimals();
    }

    /**
     * @throws \Exception
     */
    public function getNewAnimal($firstAnimalName,$secondAnimalName): string
    {

        $availableAnimals = self::getAnimals();

        if (!isset($availableAnimals[$firstAnimalName])){
            throw new \Exception(sprintf("[ERROR] `%s` Not Found",$firstAnimalName),404);
        }

        if (!isset($availableAnimals[$secondAnimalName])){
            throw new \Exception(sprintf("[ERROR] `%s` Not Found",$secondAnimalName),404);
        }


        $hybridAnimal = HybridFactory::create($availableAnimals[$firstAnimalName],$availableAnimals[$secondAnimalName]);


        return $hybridAnimal->getDescription();


    }

    private static function fetchAllAnimalsFromJson($jsonContent)
    {
        if ($jsonContent === '' || $jsonContent === null) {
            throw new \Exception('There is no json content from which the players can be created');
        }

        return json_decode($jsonContent, true);
    }


    /**
     * @throws \Exception
     */
    private static function createAnimalsFromData(array $animalData): BaseClassicAnimal
    {

        if (isset(self::$animals[$animalData['name']])) {
            throw new \Exception(sprintf('You are permitted to have only one %s', $animalData['name']));
        }

        if (isset(self::$animals[$animalData['name']])) {
            throw new \Exception(sprintf('You are permitted to have only one %s', $animalData['name']));
        }

        return AnimalFactory::create($animalData);
    }



}