<?php

class Ingredients
{
    function display()
    {
        $db = new PDO('mysql:host=localhost;dbname=recipe', 'root', 'root');
        $query = $db->prepare('SELECT ingredient, quantity, unit FROM ingredients');
        $query->execute();
        return $query->fetchAll();
    }
}

class MoreIngredient extends Ingredients
{
    function add($ingredient, $quantity, $unit)
    {
        $db = new PDO('mysql:host=localhost;dbname=recipe', 'root', 'root');
        $query = $db->prepare('INSERT INTO ingredients (ingredient, quantity, unit) VALUES (?, ?, ?)');
        $query->execute(array($ingredient, $quantity, $unit));
        return $this->display();
    }
}

class LessIngredient extends Ingredients
{
    function remove()
    {
        $db = new PDO('mysql:host=localhost;dbname=recipe', 'root', 'root');
        $first_request = $db->prepare('SELECT * FROM ingredients');
        $first_request->execute();
        $ingredients = $first_request->fetchAll();
        $index = $first_request->rowCount() - 1;
        $id = $ingredients[$index]['id'];
        $second_request = $db->prepare('DELETE FROM ingredients WHERE id = :id');
        $second_request->bindValue(':id', $id);
        $second_request->execute();
        return $this->display();
    }
};
