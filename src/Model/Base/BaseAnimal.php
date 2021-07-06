<?php


namespace App\Model\Base;


use App\Model\Interfaces\AnimalInterface;

abstract class BaseAnimal implements AnimalInterface
{
    public $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return '';
    }

}