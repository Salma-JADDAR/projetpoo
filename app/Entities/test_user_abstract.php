<?php
require 'User.php';


use App\Entities\User;

try {
    $user = new User('salma', 'salma@gmail.com', '123456', 'Basic');
} catch (Error $e) {
    echo "Impossible d'instancier User directement: " . $e->getMessage();
}
