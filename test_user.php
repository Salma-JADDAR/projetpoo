

<?php
require_once "Autoloader.php";
Autoloader::register();

use App\Entities\BasicUser;
use App\Entities\ProUser;
use App\Entities\Moderator;
use App\Entities\Administrator;
use App\Repositories\UserRepository;

$repo = new UserRepository();
//////////////////////////////////////////////////////ajouter////////////////////////////////////////
//$basic = new BasicUser("safaa", "safaa2@gmail.com", "123456", "Bio safaa", "safaa.png", 4);
//$pro = new ProUser("hicham", "hicham@gmail.com", "hicham123", "Bio hicham", "hicham.png",7,"2026-01-01", "2027-01-01");
//$moderator = new Moderator("mohamed", "mohamed@gmail.com", "mod123", "senior", "Bio Mohamed", null);
//$admin = new Administrator("admin", "admin2@gmail.com", "admin123", true, "Bio Admin", null);
//$pro1 = new ProUser("hind", "hind@gmail.com", "hind123", "Bio hind", "hind.png",12,"2026-01-01", "2027-01-01");
//$pro2 = new ProUser("hicham", "hich@gmail.com", "hicham123", "Bio hicham", "hicham.png",0,"2026-01-01",  "2027-01-01"  );
//$users = [$basic, $pro, $moderator, $admin,$pro1,$pro2];

//foreach ($users as $user) {
   // if ($repo->add($user)) {
       // echo "Utilisateur " . $user->getUsername() . " ajouté avec succès.<br>";
        
      
    //} else {
       // echo "Email de " . $user->getUsername() . " déjà utilisé.<br>";
   // }
//}

////////////////////////////////////////////////////// modification ////////////////////////////////////////

 //$user = $repo->findById(3);

 //if (!$user) {
     //die(" Utilisateur non trouvé");
 //}

 //echo "<h3> les valeurs Avant modification:</h3>";
 //echo "ID: " . $user->getId() . "<br>";
 //echo "Username: " . $user->getUsername() . "<br>";
 //echo "Email: " . $user->getEmail() . "<br>";
 //echo "Bio: " . $user->getBio() . "<br>";
 //echo "Role: " . $user->getRole() . "<br>";
 //echo "Uploads: " . $user->getUploadCountMensuel() . "<br>";


 //if ($user instanceof \App\Entities\ProUser) {
    // echo "Abonnement Start: " . $user->getAbonnementStart() . "<br>";
     //echo "Abonnement End: " . $user->getAbonnementEnd() . "<br>";
 //}

 //if ($user instanceof \App\Entities\Moderator) {
    // echo "Niveau: " . $user->getNiveau() . "<br>";
 //}

 //if ($user instanceof \App\Entities\Administrator) {
    // echo "Super Admin: " . ($user->getIsSuperAdmin() ? 'Oui' : 'Non') . "<br>";
 //}

 //echo "<hr><h3>Modifications:</h3>";


 //$user->setUsername("salim_edit");
 //$user->setEmail("salimm@gmail.com"); 
 //$user->setPhotoProfil("salimm.jpg");
//$user->setPassword("salim123");
//$role = $user->getRole();
//$currentUploads = $user->getUploadCountMensuel();

//if ($role === 'Basic') {
    //if ($currentUploads < 10) {
        //$user->setUploadCountMensuel($currentUploads + 1);
        //echo " Upload incrémenté (Basic: $currentUploads → " . $user->getUploadCountMensuel() . ")<br>";
    //} else {
        //echo " Limite de 10 uploads atteinte pour BasicUser<br>";
    //}
//} elseif ($role === 'Pro') {
   // $user->setUploadCountMensuel($currentUploads + 5); 
    //echo " Upload incrémenté (Pro: $currentUploads → " . $user->getUploadCountMensuel() . ")<br>";
//} else {
    //$user->setUploadCountMensuel($currentUploads + 1);
   // echo " Upload incrémenté ($role: $currentUploads → " . $user->getUploadCountMensuel() . ")<br>";
//}


//if ($user instanceof \App\Entities\ProUser) {
    //$user->setAbonnementStart("2025-01-01");
    //$user->setAbonnementEnd("2026-01-01");
   // echo " Dates d'abonnement m'pøises à jour<br>";
//}

//if ($user instanceof \App\Entities\Moderator) {
    //$user->setNiveau("junior");
    //echo " Niveau modifié<br>";
//}

//if ($user instanceof \App\Entities\Administrator) {
    //$user->setIsSuperAdmin(true);
    //echo "Statut Super Admin mis à jour<br>";
//}
//$user->setLastLogin(date("Y-m-d H:i:s"));


//echo "<hr><h3>Mise à jour dans la base:</h3>";


//if ($repo->update($user)) {
   // echo "User modifié avec succès dans la base de données<br>";
    
  
   // $updatedUser = $repo->findById(3);
   // if ($updatedUser) {
        //echo "<h3>Après modification (vérification):</h3>";
        //echo "Username: " . $updatedUser->getUsername() . "<br>";
        //echo "Email: " . $updatedUser->getEmail() . "<br>";
        //echo "Bio: " . $updatedUser->getBio() . "<br>";
        //echo "Role: " . $updatedUser->getRole() . "<br>";
        //echo "Uploads: " . $updatedUser->getUploadCountMensuel() . "<br>";
        //echo "Dernière connexion: " . $updatedUser->getLastLogin() . "<br>";
        
        //if ($updatedUser instanceof \App\Entities\ProUser) {
            //echo "Abonnement Start: " . $updatedUser->getAbonnementStart() . "<br>";
            //echo "Abonnement End: " . $updatedUser->getAbonnementEnd() . "<br>";
        //}
        
        //if ($updatedUser instanceof \App\Entities\Moderator) {
           // echo "Niveau: " . $updatedUser->getNiveau() . "<br>";
        //}
        
        //if ($updatedUser instanceof \App\Entities\Administrator) {
            //echo "Super Admin: " . ($updatedUser->getIsSuperAdmin() ? 'Oui' : 'Non') . "<br>";
        //}
   // }
//} else {
    //echo " Erreur lors de la modification dans la base de données<br>";

//}

////////////////////////////////////////////////////// supprimer ////////////////////////////////////////
$id = 12;
$user = $repo->findById($id);

if (!$user) {
    echo " Utilisateur introuvable";
} else {
    if ($repo->delete($id)) {
        echo " Utilisateur {$user->getUsername()} supprimé";
    } else {
        echo " Erreur suppression";
    }
}
















?>