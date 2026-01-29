<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

class DatabaseConnection 
{
    private static $instance = null;

    private static $dotenv;

    private function __construct() {
        // Le constructeur est privé pour empêcher l'instanciation directe
    }

    public static function getConnection() {
        if(self::$instance === null) {
            self::$dotenv = Dotenv::createImmutable(__DIR__);
            self::$dotenv->load();
            $db_url = $_ENV['DB_URL'];
            $db_username = $_ENV['DB_USERNAME'];
            $db_password = $_ENV['DB_PASSWORD'];
            self::$instance = new PDO("mysql:host={$db_url}", $db_username, $db_password);
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
