<?php


namespace App\Model\Base;


use App\Model\AnimalStatsGenerator;
use App\Settings\Config;

abstract class BaseClassicAnimal extends BaseAnimal
{

    public string $weight;


    /**
     * @throws \Exception
     */
    public function __construct(AnimalStatsGenerator $generator, $stats = [])
    {
        $generator->generate($this, $stats);
    }

    /**
     * @throws \Exception
     */
    public function getWeightValueInGrams(): int
    {

        $weightData = explode(' ',$this->weight);


        if (count($weightData) !== 2){
            throw new \Exception('The weight must contain the value and the mass unit type',400);
        }

        if (!is_numeric($weightData[0])){
           throw new \Exception('The first element in the weight must be a number',400);
        }

        if (!in_array($weightData[1],Config::PERMITTED_MASS_UNIT_TYPES)){
            throw new \Exception(sprintf('The permitted unit types are : %s',implode(', ',Config::PERMITTED_MASS_UNIT_TYPES)),400 );
        }



        $weightValue = (float) $weightData[0];
        $isKilograms = $weightData[1] === 'kilograms';


        if ($isKilograms) {
            $weightValue *= 1000;
        }

        return $weightValue;

    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }


}