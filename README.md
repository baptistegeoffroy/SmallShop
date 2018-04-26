# Simple Product/Basket application

This project is a simple website featuring a simple Basket system from Products loaded from database, all generated in
symfony back-end environnement

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

PHP 7.1.9
Composer
Yarn is usefull

### Installing

Once you got php configured, check if your server meets the requirements by running

```
php bin/symfony_requirements
```

Then you install vendor dependencies, if needed 

```
composer instal --no-dev --optimize-autoloader
```

You can also clear the cache to avoid any errors :

```
 php bin/console cache:clear --env=dev --no-debug
```

Next, you may want to recompile the Encore assets,depending on your setup

```
 ./node_modules/.bin/encore production
```

 or using yarn :
 
```
 yarn run encore production
```
 
 Once it's done,import the fixtures on your server :
```
php bin/console doctrine:fixtures:load
```

And then migrate the database :

```
php bin/console doctrine:migrations:migrate
```


## Running the tests


You can run them with:

```
./vendor/bin/simple-phpunit
```

### Details about tests

There is 2 tests and 3 assertions in this project.

UserControllerTest.php test is the /home page give the correct HTTP response (500), and check if the number of products is 12, by checking
the number of "Voir la fiche" (number of products is not dynamic for now and has to be changed  manually if the number of products change)

PanierTest.php is a simple unit test that asserts that the function calculating Prices is correct. For now this Test only Entity/Panier.php
while in controller the class is manipulated with Services/PanierMaker.php 

### Deploying

You must set the environnement variables on your server. Look into the .env file to see which ones are needed.

### Additionnal information
Please contact me on the github or on my email.


## Built With

* [Symfony4](https://symfony.com) - The web framework
* [Bootstrap](https://getbootstrap.com/) - The HTML/CSS framework
* [Atom](https://atom.io/) - The IDE used to develop this project



## Authors

* **Baptiste Geoffroy** 

