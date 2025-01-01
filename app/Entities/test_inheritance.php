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
echo "BasicUser:\n";echo "<br>";
echo "Username: " . $basic->getUsername() . "\n";echo "<br>";
echo "Role: " . $basic->getRole() . "\n\n";
echo "<br>";
echo "<br>";
echo "<br>";
$pro = new ProUser('zahra','zahra@gmail.com','zahra123','Photographe Pro','zahra.png','2025-01-01','2026-01-01');
echo "ProUser:\n";echo "<br>";
echo "Username: " . $pro->getUsername() ;echo "<br>";
echo "Role: " . $pro->getRole() . "\n";echo "<br>";
echo "Abonnement Start: " . $pro->getAbonnementStart() . "\n";echo "<br>";
echo "Abonnement End: " . $pro->getAbonnementEnd() . "\n\n";
echo "<br>";
echo "<br>";
echo "<br>";
$admin = new Administrator('salouma', 'salouma@gmail.com', 'salouma123', true, 'Administratrice principale');
echo "Administrator:\n";echo "<br>";
echo "Username: " . $admin->getUsername() . "\n";echo "<br>";
echo "Role: " . $admin->getRole() . "\n";echo "<br>";
echo "SuperAdmin: " . ($admin->getIsSuperAdmin() ? 'Yes' : 'No') . "\n\n";echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
 $mod = new Moderator('zahira', 'zahira@gmail.com', 'zahira123', 'senior');
 echo "Moderator:\n";echo "<br>";
 echo "Username: " . $mod->getUsername() . "\n";echo "<br>";
 echo "Role: " . $mod->getRole() . "\n";echo "<br>";
echo "Niveau: " . $mod->getNiveau() . "\n\n";echo "<br>";


?>
