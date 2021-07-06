<?php


namespace App\Factory;


use App\Model\AnimalStatsGenerator;
use App\Model\AquaticAnimal;
use App\Model\SkyAnimal;
use App\Model\TerrestrialAnimal;
use App\Settings\Config;

class AnimalFactory
{
    /**
     * @throws \Exception
     */
    public static function create($animalData)
    {

        $animalType = array_values(array_intersect_key(Config::ANIMAL_TYPE_DISTINCTIONS, $animalData))[0];

        switch ($animalType) {
            case 'sky':
                try {
                    return new SkyAnimal(new AnimalStatsGenerator(), $animalData);
                } catch (\Exception $e) {
                }
                break;
            case 'aquatic':
                try {
                    return new AquaticAnimal(new AnimalStatsGenerator(), $animalData);
                } catch (\Exception $e) {
                }
                break;
            case 'terrestrial':
                try {
                    return new TerrestrialAnimal(new AnimalStatsGenerator(), ($animalData));
                } catch (\Exception $e) {
                }
                break;
            default:
                throw new \Exception('[Error] There is no animal with that criteria', 404);

        }


    }
}