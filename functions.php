<?php

function display_ingredients($list_of_ingredients) {
    return $list_of_ingredients->display();
}

function add_ingredient($name, $quantity, $metric, $new_ingredient) {
    if (!empty($name) && !empty($quantity) && !empty($metric)) {
        if (preg_match("/\d+/", $_POST["name"]) === 0 && preg_match("/\D+/", $_POST["quantity"]) === 0 && preg_match("/\d+/", $_POST["metric"]) === 0) {
            $ingredient = htmlspecialchars($_POST["name"]);
            $quantity = htmlspecialchars($_POST["quantity"]);
            $unit = htmlspecialchars($_POST["metric"]);

            $new_ingredient->add($ingredient, $quantity, $unit);
            return false;
        } else {
            return 'type';
        }
    } else {
        return 'required fields';
    }
}

function remove_ingredient($ingredients, $last_ingredient) {
    if (!empty($ingredients)) {
        $last_ingredient->remove($ingredients);
        return false;
    } else {
        return 'no ingredient to remove';
    }
}