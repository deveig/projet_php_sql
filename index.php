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

            $new_ingredient = new MoreIngredient();
            $ingredients = $new_ingredient->add($ingredient, $quantity, $unit);
        } else {
            $error = 'required fields';
        }
    }

    if (isset($_POST["minus"])) {
        if (!empty($ingredients)) {
            $deleted_ingredient = new LessIngredient();
            $ingredients = $deleted_ingredient->remove();
        } else {
            $error = 'no ingredient to remove';
        }
    }
} catch (Exception $error) {
    die("Erreur !: " . $error->getMessage(). "\n");
}

require('view.php');
