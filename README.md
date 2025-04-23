# Cooking recipe web page

Development of a cooking recipe web page with PHP and using [MAMP](https://www.mamp.info/en/downloads/).

## Root folder 

Place project folder in 'htdocs' folder of MAMP.

## Database with phpMyAdmin

Import 'recipe.sql' file to create the database with phpMyAdmin. See parameters of connection to MySQL Server in webstart page of MAMP. 

## Run tests with PhpUnit

Install PhpUnit (https://docs.phpunit.de/en/12.1/). Command line to run tests is `phpunit ./tests/unit/IngredientTest.php`.