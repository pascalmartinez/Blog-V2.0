<!DOCTYPE html>
    <html>
        <head>
            <?php include '../includes/header.html' ?>
            <?php include '../database/connectDB.php'?>
            <?php include '../database/selectDB.php'?>
            <?php include 'affichage.php'?>
            <title>
                <?php
                    $connect = connectBDD();
                    $id = $_GET['id'];
                    $stmt = article($connect, $id);

                    afficherTitre($stmt);
                 ?>
            </title>
        </head>
        <body style="background-image: url(../sources/images/back2.jpeg)">
            <div class="container">
                <?php
                    $connect = connectBDD();
                    $id = $_GET['id'];

                    $stmt = article($connect, $id);
                    afficherCard($stmt);
                ?>
            </div>
            <div class="container">
                <a href="../index.php"><button type="button" name="button" class="btn btn-primary">Retour</button></a>
            </div>
            <?php include '../includes/base_js.html' ?>
            <script type="text/javascript" src="../js/jqueryArticle.js"></script>
        </body>
    </html>
