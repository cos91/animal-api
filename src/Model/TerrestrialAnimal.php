<?php


namespace App\Model;


use App\Model\Base\BaseClassicAnimal;
use App\Model\Interfaces\TerrestrialAnimalInterface;

class TerrestrialAnimal extends BaseClassicAnimal implements TerrestrialAnimalInterface
{

    public int $hands;
    public int $legs;

    public function __construct(AnimalStatsGenerator $generator, $stats = [])
    {
        parent::__construct($generator, $stats);
    }


    public function getHands(): int
    {
        return $this->hands;
    }

    public function setHands($hands): void
    {
        $this->hands = $hands;
    }

    public function getLegs(): int
    {
        return $this->legs;
    }

    public function setLegs($legs)
    {
        $this->legs = $legs;
    }

    public function getDescription(): string
    {
        return sprintf('%s weights %s grams and has %s hands, %s legs', $this->getName(), $this->getWeightValueInGrams(), $this->getHands(), $this->getLegs());
    }


}