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

    public function display($user_id)
    {
        $query = $this->db->prepare('SELECT * FROM ingredients WHERE user = :user');
        $query->bindValue(':user', $user_id);
        $query->execute();
        return $query->fetchAll();
    }
}

class IngredientAdder extends Ingredients
{
    public function add($ingredient, $quantity, $unit, $user_id)
    {
        $query = $this->db->prepare('INSERT INTO ingredients (ingredient, quantity, unit, user) VALUES (?, ?, ?, ?)'); 
        $query->execute(array($ingredient, $quantity, $unit, $user_id));
    }
}

class IngredientRemover extends Ingredients
{
    public function remove($ingredients, $user_id)
    {
        $index = count($ingredients) - 1;
        $id = $ingredients[$index]['id'];
        $second_request = $this->db->prepare('DELETE FROM ingredients WHERE id = :id AND user = :user');
        $second_request->bindValue(':id', $id);
        $second_request->bindValue(':user', $user_id);
        $second_request->execute();
        return true;
    }
}

class Users
{
    protected $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getConnection();
    }

    public function signup($user, $user_hash)
    {
        $query = $this->db->prepare('INSERT INTO users (user, user_hash) VALUES (?, ?)');
        $query->execute(array($user, $user_hash));
    }

    public function get_user_data($user_hash) 
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE user_hash = :user_hash');
        $query->bindValue(':user_hash', $user_hash);
        $query->execute();
        return $query->fetchAll();
    } 
};
