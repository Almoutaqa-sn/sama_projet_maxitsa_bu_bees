<?php

require_once __DIR__ . '/../vendor/autoload.php';

function prompt(string $message): string {
    echo $message;
    return trim(fgets(STDIN));
}

function writeEnvIfNotExists(array $config): void {
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        $env = <<<ENV
DB_DRIVER={$config['driver']}
DB_HOST={$config['host']}
DB_PORT={$config['port']}
DB_NAME={$config['dbname']}
DB_USER={$config['user']}
DB_PASSWORD={$config['pass']}
ROUTE_WEB=http://localhost:8000/
TWILIO_ACCOUNT_SID={TWILIO_ACCOUNT_SID}
TWILIO_AUTH_TOKEN={TWILIO_AUTH_TOKEN}
TWILIO_PHONE_NUMBER={TWILIO_PHONE_NUMBER}

dns="{$config['driver']}:host={$config['host']};dbname={$config['dbname']};port={$config['port']}"


ENV;
        file_put_contents($envPath, $env);
        echo ".env généré avec succès à la racine du projet.\n";
    } else {
        echo "Le fichier .env existe déjà, aucune modification.\n";
    }
}

$driver = strtolower(prompt("Quel SGBD utiliser ? (mysql / pgsql) : "));
$host = prompt("Hôte (default: 127.0.0.1) : ") ?: "127.0.0.1";
$port = prompt("Port (default: 3306 ou 5432) : ") ?: ($driver === 'pgsql' ? "5432" : "3306");
$user = prompt("Utilisateur (default: root) : ") ?: "root";
$pass = prompt("Mot de passe : ");
$dbName = prompt("Nom de la base à créer : ");

try {
    $dsn = "$driver:host=$host;port=$port";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($driver === 'mysql') {
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Base MySQL `$dbName` créée avec succès.\n";
        $pdo->exec("USE `$dbName`");
    } elseif ($driver === 'pgsql') {
        $check = $pdo->query("SELECT 1 FROM pg_database WHERE datname = '$dbName'")->fetch();
        if (!$check) {
            $pdo->exec("CREATE DATABASE \"$dbName\"");
            echo "Base PostgreSQL `$dbName` créée.\nRelancez la migration pour créer les tables.\n";
            writeEnvIfNotExists([
                'driver' => $driver,
                'host' => $host,
                'port' => $port,
                'user' => $user,
                'pass' => $pass,
                'dbname' => $dbName
            ]);
            exit;
        } else {
            echo "ℹ Base PostgreSQL `$dbName` déjà existante.\n";
        }
    }

    // Connexion à la base
    $dsn = "$driver:host=$host;port=$port;dbname=$dbName";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // PostgreSQL : créer les types ENUM si nécessaires
    if ($driver === 'pgsql') {
        $pdo->exec("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'typecompteenum') THEN
                CREATE TYPE TypeCompteEnum AS ENUM ('PRINCIPALE', 'SECONDAIRE');
            END IF;
        END$$;");

        $pdo->exec("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'transaction_type') THEN
                CREATE TYPE transaction_type AS ENUM ('depot', 'retrait', 'transfert');
            END IF;
        END$$;");
    }

    if ($driver === 'mysql') {
        $tables = [
            "CREATE TABLE IF NOT EXISTS typeuser (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                type VARCHAR(50) NOT NULL
            );",
            "CREATE TABLE IF NOT EXISTS utilisateur (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                adresse VARCHAR(255),
                numero_carte_identite VARCHAR(255),
                photo_recto VARCHAR(255),
                photo_verso VARCHAR(255),
                password VARCHAR(255),
                type_id INT UNSIGNED NOT NULL,
                login VARCHAR(100) UNIQUE NOT NULL,
                FOREIGN KEY (type_id) REFERENCES typeuser(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS compte (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                numero_compte VARCHAR(20) UNIQUE NOT NULL,
                solde DECIMAL(10,2) DEFAULT 0.00,
                user_id INT UNSIGNED NOT NULL,
                type ENUM('PRINCIPALE', 'SECONDAIRE') DEFAULT 'PRINCIPALE',
                numero_telephone VARCHAR(20) UNIQUE,
                FOREIGN KEY (user_id) REFERENCES utilisateur(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS transaction (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                compte_id INT UNSIGNED NOT NULL,
                montant DECIMAL(10,2) NOT NULL,
                type ENUM('depot', 'retrait', 'transfert') NOT NULL,
                FOREIGN KEY (compte_id) REFERENCES compte(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS servicecommercial (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                login VARCHAR(100) UNIQUE NOT NULL,
                motdepasse VARCHAR(255) NOT NULL
            );"
        ];
    } else {
        $tables = [
            "CREATE TABLE IF NOT EXISTS typeuser (
                id SERIAL PRIMARY KEY,
                type VARCHAR(50) NOT NULL
            );",
            "CREATE TABLE IF NOT EXISTS utilisateur (
                id SERIAL PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                adresse VARCHAR(255),
                numero_carte_identite VARCHAR(255),
                photo_recto VARCHAR(255),
                photo_verso VARCHAR(255),
                password VARCHAR(255),
                type_id INTEGER NOT NULL,
                login VARCHAR(100) UNIQUE NOT NULL,
                FOREIGN KEY (type_id) REFERENCES typeuser(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS compte (
                id SERIAL PRIMARY KEY,
                numero_compte VARCHAR(20) UNIQUE NOT NULL,
                solde DECIMAL(10,2) DEFAULT 0.00,
                user_id INTEGER NOT NULL,
                type TypeCompteEnum NOT NULL DEFAULT 'PRINCIPALE',
                numero_telephone VARCHAR(20) UNIQUE,
                FOREIGN KEY (user_id) REFERENCES utilisateur(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS transaction (
                id SERIAL PRIMARY KEY,
                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                compte_id INTEGER NOT NULL,
                montant DECIMAL(10,2) NOT NULL,
                type transaction_type NOT NULL,
                FOREIGN KEY (compte_id) REFERENCES compte(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS servicecommercial (
                id SERIAL PRIMARY KEY,
                login VARCHAR(100) UNIQUE NOT NULL,
                motdepasse VARCHAR(255) NOT NULL
            );"
        ];
    }

    foreach ($tables as $sql) {
        $pdo->exec($sql);
    }

    echo "✅ Toutes les tables ont été créées avec succès dans `$dbName`.\n";

    writeEnvIfNotExists([
        'driver' => $driver,
        'host' => $host,
        'port' => $port,
        'user' => $user,
        'pass' => $pass,
        'dbname' => $dbName
    ]);
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
}
