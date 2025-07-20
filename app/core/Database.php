<?php

namespace App\Core;
use PDO;
use PDOException;

class Database{
    private static ?Database $instance = null;
    public ?PDO $pdo = null;


    private function __construct(){
        $dsn = 'pgsql:host=localhost;port=5433;dbname=sama_base_de_donnees;';
        try {
            $this->pdo = new PDO($dsn, 'postgres', 'admin123');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connection successful";
        } catch (PDOException $e) {
          
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public static function getInstance(): self{
        if(self::$instance===null){
            self::$instance = new Self();
        }
        return self::$instance;
    }
    
}