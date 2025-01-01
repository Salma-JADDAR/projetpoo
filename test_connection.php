<?php
require_once __DIR__ . '/app/Config/Database.php';

use App\Config\Database;

$db = new Database();
$conn = $db->getConnection();

echo "Connexion réussie !";
