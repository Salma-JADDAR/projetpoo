<?php
declare(strict_types=1);

require_once "Autoloader.php";
Autoloader::register();

use App\Entities\Photo;
use App\Repositories\PhotoRepository;
use App\Repositories\LikeRepository;
use App\Repositories\CommentRepository;
use App\Repositories\TagRepository;

// //////////////////////////////////////////////
//  Test Photo
// -//////////////////////////////////////////////
echo "<h2>Test Photo CRUD</h2>";

$repo = new PhotoRepository();


//$newPhoto = new Photo("Test Photo","Description test","photo_test.png",1024, "image/png","800x600", 1, "brouillon",0,null, new DateTime(), null );
 
// ///////////////////////////////////////////////ajouter // ///////////////////////////////////////////////
//if ($repo->add($newPhoto)) {
   // echo "Photo ajoutée avec succès !";
//} else {
    //echo "Erreur lors de l'ajout de la photo.";
//}



// ////////////////////////////////////////////////Read// ///////////////////////////////////////////////
$photo = $repo->findById(1);
if ($photo) {
    echo "Lecture Photo: " . $photo->getTitle() . " - " . $photo->getDescription() . "<br>";
}

// ////////////////////////////////////////////////supprimer// ///////////////////////////////////////////////
//$repo->delete(13);
//echo "Photo supprimée<br>";




// //////////////////////////////////////////////
//  Test like
// -//////////////////////////////////////////////
$photo = $repo->findById(3);
echo "<h2>Test Like</h2>";
if (!$photo) {
    die("Photo introuvable");
}
$likeRepo = new LikeRepository();
$userId = 1; 

try {
    $liked = $photo->addLike($userId);
    echo $liked ? "Like ajouté<br>" : "Like déjà existant<br>";
} catch (LogicException $e) {
    echo $e->getMessage();
}

$isLiked = $photo->isLikedBy($userId);
echo $isLiked ? "L'utilisateur a liké cette photo<br>" : "Pas de like<br>";

$likeRemoved = $photo->removeLike($userId);
echo $likeRemoved ? "Like retiré<br>" : "Impossible de retirer<br>";

$likeCount = $photo->getLikeCount();
echo "Nombre de likes: $likeCount<br>";