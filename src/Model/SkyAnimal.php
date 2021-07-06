<?php


namespace App\Model;


use App\Model\Base\BaseClassicAnimal;
use App\Model\Interfaces\SkyAnimalInterface;

class SkyAnimal extends BaseClassicAnimal implements SkyAnimalInterface
{

    public int $wings;

    public function __construct(AnimalStatsGenerator $generator, $stats = [])
    {
        parent::__construct($generator, $stats);
    }


    public function getWings(): int
    {
        return $this->wings;
    }


    public function setWings($wings)
    {
        $this->wings = $wings;
    }

    public function getDescription(): string
    {
        return sprintf('%s weights %s grams and has %s wings', $this->getName(), $this->getWeightValueInGrams(), $this->getWings());
    }


}