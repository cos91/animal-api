<?php


namespace App\Model;


use App\Model\Interfaces\AnimalInterface;

class AnimalStatsGenerator
{
    const AVAILABLE_ANIMAL_CRITERIA =
        [
            'name', 'weight', 'hands', 'legs', 'wings', 'fins'
        ];

    /**
     * @throws \Exception
     */
    public function generate(AnimalInterface $animal, $stats = [])
    {


        if (empty($stats)) {
            throw new \Exception('The stats cannot be empty');
        }

        foreach ($stats as $key => $value) {


            $method = sprintf("set%s", ucfirst(strtolower($key)));
            if (!in_array($key, self::AVAILABLE_ANIMAL_CRITERIA)) {
                throw new \Exception(sprintf('The criteria %s is not valid', $key));
            }


            if (!method_exists($animal, $method)) {
                throw new \Exception(sprintf('Attribute cannot be set. Method [%s] does not exist.', $method));
            }


            $animal->$method($value);

        }
    }
}