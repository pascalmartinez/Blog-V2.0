<?php
    include 'connectDB.php';

    function formulaire($connect){

    //récupération des valeurs des champs:
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $titremessage = $_POST["titremessage"];
        $message = $_POST["message"];

        if(isset($_POST['customFile'])){
            $fichier = $_POST["customFile"];
        }
        else{
            $fichier = "";
        }

        if (isset($_POST["nom"])) {
            echo 'Cette variable existe, donc je peux l\'afficher.';
        }

        try{
            $sql = "INSERT INTO auteur (nom_auteur, mail)
                VALUES ('$nom', '$email')";
                // use exec() because no results are returned
            $connect->query($sql);            
            echo "Nouvel auteur enregistré";
            
            $sql = "SELECT id_auteur FROM auteur WHERE mail='$email'"; 
            $resultat = $connect->query($sql);  
            $row=$resultat->fetch();
 
            $sql = "INSERT INTO article (id_auteur, titre, texte, url_img)
            VALUES ('".$row['id_auteur']."', $titremessage','$message','$fichier')";
            // use exec() because no results are returned
            $connect->exec($sql);            
            echo "Nouveau post enregistré";            
            }
        catch(PDOException $e){
            echo "Request failed : " . $e->getMessage();
            }
    }

        $connect=connectBDD();
        formulaire($connect);



    //exécution de la requête SQL:
    //   $requete = mysqli_query($connect, $sql) or die( mysqli_error($connect) ) ;
    //
    // //affichage des résultats, pour savoir si l'insertion a marchée:
    //   if($requete)
    //   {
    //     echo("L'insertion a été correctement effectuée") ;
    //   }
    //   else
    //   {
    //     echo("L'insertion à échouée") ;
    //   }


    //Rajout de la fonctionnalité permettant de choisir le groupe d'appartenance
    // $req="SELECT Groupe.nom, Groupe.id FROM Groupe";
    //
    // $res=mysqli_query($link, $req) or die("erreur dans la requête $req".mysqli_error($link));
    // while ($tab=mysqli_fetch_object($res))
    //     $nomGrp[]=$tab->nom;
    //     $idGrp[]=$tab->id;
    //
    // echo "<center><select name='idgroupe' class=form-field multiple size=3>";
    //
    // for ($i=0;$i<count($nomGrp);$i++)
    // 	echo "<option value='$idGrp[$i]'>$nomGrp[$i]</option>";
    //
    // echo "</select></center>";


    


?>
