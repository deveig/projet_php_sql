<?php

function display_ingredients($list_of_ingredients) {
    return $list_of_ingredients->display();
}

function add_ingredient($name, $quantity, $metric, $new_ingredient) {
    if (!empty($name) && !empty($quantity) && !empty($metric)) {
        if (preg_match("/\d+/", $name) === 0 && preg_match("/\D+/", $quantity) === 0 && preg_match("/\d+/", $metric) === 0) {
            $ingredient = htmlspecialchars($name);
            $quantity = htmlspecialchars($quantity);
            $unit = htmlspecialchars($metric);

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