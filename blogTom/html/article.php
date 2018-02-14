<!DOCTYPE html>
    <html>
        <head>
            <title>Page Title</title>
            <?php include '../includes/header.html' ?>
            <?php include '../database/connectDB.php'?>
            <?php include '../database/selectDB.php'?>
        </head>
        <body>
            <div class="container">
                <?php
                    $connect = connectBDD();
                    $id = $_GET['id'];

                    article($connect, $id);
                ?>

            <!--<div class="card bg-light mb-3">
                <div class="card-header">catégorie
                    <h5 class="card-title">nom article</h5>
                </div>
                <img class="card-img-top" src="../sources/images/index.svg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <h6 class="card-subtitle text-center">Auteur</h6>
                </div>
            </div>-->
                </div>
            <?php include '../includes/base_js.html' ?>
        </body>
    </html>
