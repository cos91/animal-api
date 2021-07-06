<?php


namespace App\Model;


use App\Model\Base\BaseClassicAnimal;
use App\Model\Interfaces\AquaticAnimalInterface;

class AquaticAnimal extends BaseClassicAnimal implements AquaticAnimalInterface
{
    public int $fins;

    public function __construct(AnimalStatsGenerator $generator, $stats = [])
    {
        parent::__construct($generator, $stats);
    }


    public function getFins(): int
    {
        return $this->fins;
    }


    public function setFins($fins)
    {
        $this->fins = $fins;

    }


    public function getDescription(): string
    {
        return sprintf('%s weights %s grams and has %s fins', $this->getName(), $this->getWeightValueInGrams(), $this->getFins());
    }


}