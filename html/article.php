<!DOCTYPE html>
    <html>
        <head>
            <title>Page Title</title>
            <?php include '../includes/header.html' ?>
            <?php include '../database/connectDB.php'?>
            <?php include '../database/selectDB.php'?>
            <?php include 'affichage.php'?>
        </head>
        <body>
            <div class="container">
                <?php
                    $connect = connectBDD();
                    $id = $_GET['id'];

                    $stmt = article($connect, $id);
                    afficherCard($stmt);



                ?>
                </div>
            <?php include '../includes/base_js.html' ?>
            <script type="text/javascript" src="../js/jqueryArticle.js"></script>
        </body>
    </html>
