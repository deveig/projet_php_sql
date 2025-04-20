<?php

class DatabaseConnection 
{
    private static $instance = null;

    private function __construct() {
        // Le constructeur est privé pour empêcher l'instanciation directe
    }

    public static function getConnection() {
        if(self::$instance === null) {
            self::$instance = new PDO('mysql:host=localhost:8889;dbname=recipe', 'root', 'root');
        }
        return self::$instance;
    }
}

class Ingredients
{
    protected $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getConnection();
    }

    public function display()
    {
        $query = $this->db->prepare('SELECT * FROM ingredients');
        $query->execute();
        return $query->fetchAll();
    }
}

class IngredientAdder extends Ingredients
{
    public function add($ingredient, $quantity, $unit)
    {
        $query = $this->db->prepare('INSERT INTO ingredients (ingredient, quantity, unit) VALUES (?, ?, ?)');
        $query->execute(array($ingredient, $quantity, $unit));
    }
}

class IngredientRemover extends Ingredients
{
    public function remove($ingredients)
    {
        $index = count($ingredients) - 1;
        $id = $ingredients[$index]['id'];
        $second_request = $this->db->prepare('DELETE FROM ingredients WHERE id = :id');
        $second_request->bindValue(':id', $id);
        $second_request->execute();
        return true;
    }
};
