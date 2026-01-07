<?php
declare(strict_types=1);

require_once "Autoloader.php";
Autoloader::register();

 use App\Entities\Photo;
 use App\Repositories\PhotoRepository;
 use App\Repositories\LikeRepository;
 use App\Repositories\CommentRepository;
 use App\Repositories\TagRepository;

//



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
// -/////////////////// ajouter ///////////////////////////
try {
    $liked = $photo->addLike($userId);
    echo $liked ? "Like ajouté<br>" : "Like déjà existant<br>";
} catch (LogicException $e) {
    echo $e->getMessage();
}
// -/////////////////// modifier ///////////////////////////
$isLiked = $photo->isLikedBy($userId);
echo $isLiked ? "L'utilisateur a liké cette photo<br>" : "Pas de like<br>";
// -///////////////////supprimer ///////////////////////////
//$likeRemoved = $photo->removeLike($userId);
//echo $likeRemoved ? "Like retiré<br>" : "Impossible de retirer<br>";
// -///////////////////recuperer le nombre total des like  ///////////////////////////
$likeCount = $photo->getLikeCount();
echo "Nombre de likes: $likeCount<br>";



// //////////////////////////////////////////////
//  Test Commentaire
// //////////////////////////////////////////////
echo "<h2>Test Commentaire</h2>";

$photo = $repo->findById(3);
if (!$photo) {
    die("Photo introuvable pour les commentaires");
}

$userId = 1;

// ///////////////// ajouter commentaire /////////////////
// $commentId = $photo->addComment('Had photo zwina...', 1, $photo->getId());

// echo "Commentaire ajouté avec ID: $commentId<br>";

// /////////////////// lire commentaires /////////////////
// $comments = $photo->getComments();
// echo "Liste des commentaires:<br>";
// foreach ($comments as $comment) {
//     echo "- " . $comment['contenu'] . "<br>";
// }

// // -------- nombre commentaires ----------
// echo "Nombre de commentaires: " . $photo->getCommentCount() . "<br>";

// // -------- supprimer commentaire ----------

// $deleted = $photo->removeComment($commentId);
// echo $deleted ? "Commentaire supprimé<br>" : "Erreur suppression commentaire<br>";




// //////////////////////////////////////////////
//  Test Tag
// //////////////////////////////////////////////
echo "<h2>Test Tag</h2>";



$photo = $repo->findById(3);
if (!$photo) {
   die("Photo introuvable pour les tags");
}

// -------- ajouter tags ----------
$photo->addTag("nature");
$photo->addTag("sunset");
$photo->addTag("maroc");
echo "Tags ajoutés<br>";

// -------- lire tags ----------
$tags = $photo->getTags();
echo "Tags de la photo:<br>";
foreach ($tags as $tag) {
    echo "- " . $tag['nom'] . "<br>";
}

// -------- verifier tag ----------
if ($photo->hasTag("sunset")) {
    echo "La photo contient le tag 'sunset'<br>";
}

// -------- supprimer tag ----------

//$photo->removeTag("maroc");
//echo "Tag 'maroc' supprimé<br>";


// -------- supprimer tous les tags ----------

//$photo->clearTags();
//echo "Tous les tags supprimés<br>";

