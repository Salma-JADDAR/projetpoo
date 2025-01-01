<?php
require_once 'User.php';
require_once 'BasicUser.php';
require_once 'ProUser.php';
require_once 'Administrator.php';
require_once 'Moderator.php';

use App\Entities\BasicUser;
use App\Entities\ProUser;
use App\Entities\Administrator;
use App\Entities\Moderator;

$basic = new BasicUser('salma', 'salma@gmail.com', 'salma123', 'Utilisateur Basic');
$pro = new ProUser('zahra', 'zahra@gmail.com', 'zahra123', 'Photographe Pro', 'zahra.png','2025-01-01','2026-01-01');
$admin = new Administrator('salouma', 'salouma@gmail.com', 'salouma123', true, 'Administratrice principale');
$mod = new Moderator('zahira', 'zahira@gmail.com', 'zahira123', 'senior');

echo $basic . "\n";
echo "<br>";
echo "<br>";
echo "<br>";
echo $pro . "\n";
echo "<br>";
echo "<br>";
echo "<br>";
echo $admin . "\n";
echo "<br>";
echo "<br>";
echo "<br>";
echo $mod . "\n";
?>
