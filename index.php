<?php

require("model.php");

try {

    $error = false;
    $ingredients = new Ingredients();
    $ingredients = $ingredients->display();
            
    if (isset($_POST["plus"])) {
        if (!empty($_POST["name"]) && !empty($_POST["quantity"]) && !empty($_POST["metric"])) {
            if (preg_match("/\D+/", $_POST["name"]) && preg_match("/\d+/", $_POST["quantity"]) && preg_match("/\D+/", $_POST["metric"])) {
                $ingredient = htmlspecialchars($_POST["name"]);
                $quantity = htmlspecialchars($_POST["quantity"]);
                $unit = htmlspecialchars($_POST["metric"]);

                $new_ingredient = new MoreIngredient();
                $new_ingredient->add($ingredient, $quantity, $unit);
                $ingredients = $new_ingredient->display();
            } else {
                $error = 'type';
            }
        } else {
            $error = 'required fields';
        }
    }

    if (isset($_POST["minus"])) {
        if (!empty($ingredients)) {
            $deleted_ingredient = new LessIngredient();
            $deleted_ingredient->remove($ingredients);
            $ingredients = $deleted_ingredient->display();
        } else {
            $error = 'no ingredient to remove';
        }
    }
} catch (Exception $error) {
    die("No ingredients !");
}

require('view.php');

