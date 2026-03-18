<?php

require("functions.php");

try {
    session_start();

    $user_error = "";
    $ingredient_error = "";

    if (isset($_POST["plus_name"])) {
        $user_name = $_POST["user_name"];
        $new_user = new Users();
        $data = add_user($user_name, $new_user);
        $user_error = $data[0];
        if (count($data) == 2) {
            $user_hash = $data[1];
            $_SESSION["user_id"] = get_user($new_user,$user_hash)[0]["id"];
            $_SESSION["user"] = get_user($new_user,$user_hash)[0]["user"];
        }
    }
            
    if (isset($_POST["plus"])) {
        if ($_SESSION["user_id"]) {
            $name = $_POST["name"];
            $quantity = $_POST["quantity"];
            $metric = $_POST["metric"];
            $new_ingredient = new IngredientAdder();
            $ingredient_error = add_ingredient($name, $quantity, $metric, $new_ingredient, $_SESSION["user_id"]);
            $_SESSION["ingredients"] = display_ingredients($new_ingredient, $_SESSION["user_id"]);
        } else {
            $user_error = 'Please enter your name !';
        }
    }

    if (isset($_POST["minus"])) {
        if ($_SESSION["user_id"]) {
            $last_ingredient = new IngredientRemover();
            $ingredient_error = remove_ingredient($_SESSION["ingredients"], $last_ingredient, $_SESSION["user_id"]);
            $_SESSION["ingredients"] = display_ingredients($last_ingredient, $_SESSION["user_id"]);
        } else {
            $user_error = 'Please enter your name !';
        }
    }
} catch (Exception $error) {
    die('No ingredients !');
}
