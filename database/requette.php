<?php
try {
    $bdd = new mysqli('localhost','root','admin','myBlog');
    if (!$bdd) {
        echo "erreur de connexion";
    }
} catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM article');

if ($donnees = $reponse->fetch_assoc()){

   echo "<p>".$donnees['id_article']."</p>";
   echo "<p>".$donnees['id_auteur']."</p>";
   echo "<p>".$donnees['id_categorie']."</p>";
   echo "<p>".$donnees['date']."</p>";
   echo "<p>".$donnees['titre']."</p>";
   echo "<p>".$donnees['texte']."</p>";
   echo "<p>".$donnees['url_link']."</p>";
}


// $servername = "localhost";
// $username = "root";
// $password = "admin";
// $dbname = "myBlog";
//
// try {
//     $connect = new PDO("mysql:host=$servername;$dbname; charset=utf8", $username, $password);
//     // set the PDO error mode to exception
//     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $connect;
//     }
// catch(PDOException $e)
//     {
//     echo "Connection failed: " . $e->getMessage();
//     }
//
// try {
//     $connect = new mysqli('localhost','root','admin','myBlog');
//     if (!$connect) {
//         echo "erreur de connexion";
//     }
// } catch (Exception $e) {
//    die('Erreur : ' . $e->getMessage());
// }

// $reponse = $connect->prepare('SELECT * FROM article');
//    if (!$reponse) {
//        echo "erreur de connexion 123";
//   }
//
// while ($donnees = $reponse->fetch()){
//    $string = $donnees['texte'];
//    echo substr($string, 0, 20);
// }

 ?>
