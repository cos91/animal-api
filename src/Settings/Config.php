<?php


namespace App\Settings;


class Config
{
    const JSON_URL = __DIR__ . '/../Resources/animals.json';
    const ANIMAL_TYPE_DISTINCTIONS = [
        'wings' => 'sky',
        'fins' => 'aquatic',
        'legs' => 'terrestrial'
    ];
    const PERMITTED_MASS_UNIT_TYPES  = ['kilograms','grams'];

}