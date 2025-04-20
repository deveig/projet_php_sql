<?php

require("functions.php");

try {
    $error = false;

    $list_of_ingredients = new Ingredients();
    $ingredients = display_ingredients($list_of_ingredients);
            
    if (isset($_POST["plus"])) {
        $name = $_POST["name"];
        $quantity = $_POST["quantity"];
        $metric = $_POST["metric"];
        $new_ingredient = new IngredientAdder();
        $error = add_ingredient($name, $quantity, $metric, $new_ingredient);
        $ingredients = $new_ingredient->display();
    }

    if (isset($_POST["minus"])) {
        $last_ingredient = new IngredientRemover();
        $error = remove_ingredient($ingredients, $last_ingredient);
        $ingredients = $last_ingredient->display();
    }
} catch (Exception $error) {
    die("No ingredients !");
}
