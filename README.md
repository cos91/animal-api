# Symfony animal-api


Task
You are given the following set of animals (birds, fishes and mammals) with the supplied
properties:
colibri – 2 wings, weights 150 grams
eagle – 2 wings, weights 4 kilograms
microraptor – 4 wings, weights 3.5 kilograms
dolphin – 8 fins, weights 50 kilograms
shark – 8 fins, weights 80 kilograms
gorilla – 2 hands, 2 legs, weights 100 kilograms
horse – 0 hands, 4 legs, weights 400 kilograms
human – 2 hands, 2 legs, weights 80 kilograms
Write an API that exposes two endpoints:
1. /{animal}
The {animal} parameter is the name of an animal. Return 404 error if it’s not found.
The response should contain all the animal properties.
Example:
/gorilla should show the following message:
gorilla weights 100000 grams and has 2 hands, 2 legs
2. /{animal1}/{animal2}

Both parameters are the name of an animal. Return 404 error if one of them it’s not found.
The response should contain a breed between the two animals following the logic:

• the difference between their weights should be less than half of the one that weights most. If
this validation fails the response should be a 400 error.

• name is built from both animals with letter ‘o’ between them

• properties are merged and the result should contain all of them

Example:
/gorilla/horse should return 400 error
/shark/dolphin should return the following message:
sharkodolphin has 8 fins
/eagle/microraptor should return the following message:
eagleomicroraptor has 2 or 4 wings
/shark/human should return the following message:
sharkohuman has 8 fins, 2 hands, 2 legs

Requirements
Use Symfony (>=4) framework for implementation.
• hopefully you can write some tests
• no doctrine entities
• provide a README file containing clear, simple instructions upon how to execute the code
and tests (if any)
• structure your code as best you can do using OOP, design patterns and SOLID principles



# Requirements
PHP 7.4 or higher;

# Instalation

```
composer install
```

# Tests
Execute this command to run tests:

```
php ./bin/phpunit
or
php ./vendor/bin/phpunit


```
