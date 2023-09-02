<?php

class Ingredients
{
    static $db;

    public function __construct()
    {
        self::$db = new PDO('mysql:host=localhost:8889;dbname=recipe', 'root', 'root');
    }

    public function display()
    {
        $query = self::$db->prepare('SELECT * FROM ingredients');
        $query->execute();
        return $query->fetchAll();
    }
}

class MoreIngredient extends Ingredients
{
    public function add($ingredient, $quantity, $unit)
    {
        $query = parent::$db->prepare('INSERT INTO ingredients (ingredient, quantity, unit) VALUES (?, ?, ?)');
        $query->execute(array($ingredient, $quantity, $unit));
    }
}

class LessIngredient extends Ingredients
{
    public function remove($ingredients)
    {
        $index = count($ingredients) - 1;
        $id = $ingredients[$index]['id'];
        $secondRequest = parent::$db->prepare('DELETE FROM ingredients WHERE id = :id');
        $secondRequest->bindValue(':id', $id);
        $secondRequest->execute();
        return true;
    }
};
