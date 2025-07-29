<?php

namespace App\Core;
use PDO;
use PDOException;

class Database{
    private static ?Database $instance = null;
    public ?PDO $pdo = null;


    private function __construct(){
        // Charger les variables d'environnement depuis le fichier .env (en local) ou depuis l'environnement système (en production)
        $this->loadEnv();
        
        $host = $this->getEnvVar('DB_HOST', 'localhost');
        $port = $this->getEnvVar('DB_PORT', '5432');
        $dbname = $this->getEnvVar('DB_NAME', 'sama_base_de_donnees');
        $user = $this->getEnvVar('DB_USER', 'postgres');
        $password = $this->getEnvVar('DB_PASSWORD', 'admin123');
        
        $dsn = "pgsql:host={$host};port={$port};dbname={$dbname};";
        
        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function getEnvVar(string $name, string $default = ''): string {
        // Priorité : variables d'environnement système > $_ENV > valeur par défaut
        return getenv($name) ?: ($_ENV[$name] ?? $default);
    }

    private function loadEnv() {
        $envFile = __DIR__ . '/../../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                if (strpos($line, '=') !== false) {
                    list($name, $value) = explode('=', $line, 2);
                    $_ENV[trim($name)] = trim($value);
                }
            }
        }
    }

    public static function getInstance(): self{
        if(self::$instance===null){
            self::$instance = new Self();
        }
        return self::$instance;
    }
    
}