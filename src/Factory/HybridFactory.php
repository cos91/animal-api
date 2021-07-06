<?php


namespace App\Factory;

use App\Model\HybridBaseAnimal;
use App\Model\Interfaces\AnimalInterface;

class HybridFactory
{
    public static function create(AnimalInterface $firstAnimal, AnimalInterface $secondAnimal): HybridBaseAnimal
    {

        $animalsWeight = [$firstAnimal->getWeightValueInGrams(),$secondAnimal->getWeightValueInGrams()];
        if ($firstAnimal->getWeightValueInGrams() > $secondAnimal->getWeightValueInGrams())
        {
            sort($animalsWeight);
        }

        if ($animalsWeight[1] / 2 < $animalsWeight[1] - $animalsWeight[0])
        {
            throw new \Exception('The difference between their weights should be less than half of the one that weights most',400);
        }


        return (new HybridBaseAnimal())
            ->initFirstAnimal($firstAnimal)
            ->initSecondAnimal($secondAnimal);
    }
}