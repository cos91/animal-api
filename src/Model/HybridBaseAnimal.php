<?php


namespace App\Model;


use App\Model\Base\BaseAnimal;
use App\Model\Interfaces\AnimalInterface;

class HybridBaseAnimal extends BaseAnimal
{
    public AnimalInterface $firstAnimal;

    public AnimalInterface $secondAnimal;

    public function initFirstAnimal(AnimalInterface $firstAnimal)
    {
        $this->firstAnimal = $firstAnimal;
        return $this;
    }

    public function initSecondAnimal(AnimalInterface $secondAnimal)
    {
        $this->secondAnimal = $secondAnimal;
        return $this;
    }


    public function getName(): string
    {
        return $this->firstAnimal->getName() . 'o' . $this->secondAnimal->getName();
    }

    public function getDescription(): string
    {


        $firstAnimalFeatures = get_object_vars($this->firstAnimal);
        $secondAnimalFeatures = get_object_vars($this->secondAnimal);

        $hybridAnimalSpecialFeatures = array_merge_recursive($firstAnimalFeatures, $secondAnimalFeatures);
        unset($hybridAnimalSpecialFeatures['name']);
        unset($hybridAnimalSpecialFeatures['weight']);

        $message = ' has ';

        foreach ($hybridAnimalSpecialFeatures as $animalSpecialFeatureName => $specialFeatureValue) {
            if (is_array($specialFeatureValue)) {
                if (count(array_count_values($specialFeatureValue)) > 1) {
                    $message .= implode(' or ', $specialFeatureValue);
                } else {
                    $message .= ' ' . $specialFeatureValue[0];
                }

            } else {

                $separator = ', ';
                if (str_word_count($message) === 1) {
                    $separator = '';
                }
                $message .= $separator . $specialFeatureValue;
            }

            $message .= ' ' . $animalSpecialFeatureName;

        }

        return $this->getName() . $message;
    }


}