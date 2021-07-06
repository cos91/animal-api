<?php


namespace App\Tests;


use App\Factory\AnimalFactory;
use App\Factory\HybridFactory;
use App\Model\Base\BaseAnimal;
use App\Model\Interfaces\AnimalInterface;
use App\Services\AnimalService;
use App\Settings\Config;
use Exception;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{
    private AnimalFactory $animalFactory;
    private HybridFactory $hybridFactory;
    private AnimalService $animalService;

    public function setUp(): void
    {

        $this->animalFactory = new AnimalFactory();
        $this->hybridFactory = new HybridFactory();
        $this->animalService = new AnimalService();


    }


    public function testAnimalService()
    {

        $animals = $this->animalService->getAllAvailableAnimals();


        foreach ($animals as $animal) {


            echo " {$animal->getName()} \r\n";

            $this->assertInstanceOf(BaseAnimal::class, $animal);
        }


        $jsonData = $this->invokeMethod($this->animalService, 'fetchAllAnimalsFromJson', [file_get_contents(Config::JSON_URL)]);

        foreach ($jsonData as $data) {
            echo $data['name'] . " \r\n";
        }

    }

    public function testAnimalFactory()
    {

        $testAnimalNames = ['colibri', 'shark', 'horse'];


        $jsonData = $this->invokeMethod($this->animalService, 'fetchAllAnimalsFromJson', [file_get_contents(Config::JSON_URL)]);


        foreach ($jsonData as $data) {

            if (in_array($data['name'], $testAnimalNames)) {
                try {
                    $animal = $this->animalFactory::create($data);
                } catch (Exception $e) {
                    print_r($e->getMessage());
                }

                echo get_class($animal) . " \n";

                $this->assertInstanceOf(AnimalInterface::class, $animal);
            }

        }

    }


    public function testHybridFactory()
    {

        $jsonData = $this->invokeMethod($this->animalService, 'fetchAllAnimalsFromJson', [file_get_contents(Config::JSON_URL)]);

        $animal1 = $this->animalFactory::create($jsonData[rand(0, count($jsonData) - 1)]);
        $animal2 = $this->animalFactory::create($jsonData[rand(0, count($jsonData) - 1)]);


        try {
            $newAnimal = $this->hybridFactory::create($animal1, $animal2);
        } catch (Exception $e) {
            print_r($e->getMessage());

            $this->assertInstanceOf(\Exception::class,$e);
        }

        if (isset($newAnimal)){
            echo get_class($newAnimal) . " \n";
            echo $newAnimal->getName() . " \n";
            echo $newAnimal->getDescription() . " \n";
            $this->assertInstanceOf(AnimalInterface::class, $newAnimal);
        }

    }


    private function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}