<?php

function display_ingredients($ingredient, $user_id) {
    return $ingredient->display($user_id);
}

function add_ingredient($name, $quantity, $metric, $new_ingredient, $user_id) {
    if (!empty($name) && !empty($quantity) && !empty($metric)) {
        if (preg_match("/\d+/", $name) === 0 && preg_match("/\D+/", $quantity) === 0 && preg_match("/\d+/", $metric) === 0) {
            $ingredient = htmlspecialchars($name);
            $quantity = htmlspecialchars($quantity);
            $unit = htmlspecialchars($metric);

            $new_ingredient->add($ingredient, $quantity, $unit, $user_id);
            return false;
        } else {
            return 'type';
        }
    } else {
        return 'required fields';
    }
}

function remove_ingredient($ingredients, $last_ingredient, $user_id) {
    if (!empty($ingredients)) {
        $last_ingredient->remove($ingredients, $user_id);
        return false;
    } else {
        return 'no ingredient to remove';
    }
}

function add_user($user_name, $new_user) {
    if (!empty($user_name)) {
        if (preg_match("/\d+/", $user_name) === 0) {
            $user = htmlspecialchars($user_name);
            $user_hash = password_hash($user_name, PASSWORD_DEFAULT);
            $new_user->signup($user, $user_hash);
            $error = false;
            return [$error, $user_hash];
        } else {
            $error = 'type';
            return [$error];
        }
    } else {
        $error = 'required fields';
        return [$error];
    }
}

function get_user($new_user, $user_hash) {
    return $new_user->get_user_data($user_hash);
}