<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Chargement de .env
$env = parse_ini_file(__DIR__ . '/../.env');

$driver = $env['DB_DRIVER'];
$host = $env['DB_HOST'];
$port = $env['DB_PORT'];
$dbname = $env['DB_NAME'];
$user = $env['DB_USER'];
$pass = $env['DB_PASSWORD'];

$dsn = "$driver:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Connexion à la base de données réussie.\n";

    // Types utilisateur
    $pdo->exec("INSERT INTO typeuser (type) VALUES
        ('ADMIN'),
        ('CLIENT'),
        ('GESTIONNAIRE')
    ON CONFLICT DO NOTHING;");

    // Utilisateurs
    $pdo->exec("INSERT INTO \"user\" (nom, prenom, adresse, numero_carte_identite, photo_recto, photo_verso, password, type_id, login) VALUES
        ('Sene', 'Baye', 'Dakar', 'CNI12345', 'recto.jpg', 'verso.jpg', 'pass123', 1, 'bayeadmin'),
        ('Diop', 'Fatou', 'Thiès', 'CNI67890', 'recto2.jpg', 'verso2.jpg', 'pass456', 2, 'fatouclient')
    ON CONFLICT DO NOTHING;");

    // Comptes
    $pdo->exec("INSERT INTO compte (numero_compte, solde, user_id, type, numero_telephone) VALUES
        ('CPT001', 100000.00, 1, 'PRINCIPALE', '771234567'),
        ('CPT002', 50000.00, 2, 'SECONDAIRE', '778765432')
    ON CONFLICT DO NOTHING;");

    // Service commercial
    $pdo->exec("INSERT INTO servicecommercial (login, motdepasse) VALUES
        ('service1', 'secret123')
    ON CONFLICT DO NOTHING;");

    // Transactions
    $pdo->exec("INSERT INTO transaction (compte_id, montant, type) VALUES
        (1, 15000.00, 'depot'),
        (2, 10000.00, 'retrait'),
        (1, 5000.00, 'transfert')
    ;");

    echo "✅ Données insérées avec succès.\n";
} catch (Exception $e) {
    echo "❌ Erreur lors du seed : " . $e->getMessage() . "\n";
}
