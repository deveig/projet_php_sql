<?php

require("model.php");

try {

    $error = false;
    $ingredients = new Ingredients();
    $ingredients = $ingredients->display();
            
    if (isset($_POST["plus"])) {
        if (!empty($_POST["name"]) && !empty($_POST["quantity"]) && !empty($_POST["metric"])) {
            $ingredient = htmlspecialchars($_POST["name"]);
            $quantity = htmlspecialchars($_POST["quantity"]);
            $unit = htmlspecialchars($_POST["metric"]);

            $newIngredient = new MoreIngredient();
            $newIngredient->add($ingredient, $quantity, $unit);
            $ingredients = $newIngredient->display();
        } else {
            $error = 'required fields';
        }
    }

    if (isset($_POST["minus"])) {
        if (!empty($ingredients)) {
            $deletedIngredient = new LessIngredient();
            $deletedIngredient->remove($ingredients);
            $ingredients = $deletedIngredient->display();
        } else {
            $error = 'no ingredient to remove';
        }
    }
} catch (Exception $error) {
    die("Erreur !: " . $error->getMessage(). "\n");
}

require('view.php');

