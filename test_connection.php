<?php
require_once __DIR__ . "/../../Autoloader.php";

use App\Config\Database;

$db = new Database();
$conn = $db->getConnection();

echo "Connexion réussie !";
