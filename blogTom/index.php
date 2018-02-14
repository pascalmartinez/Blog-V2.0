<!DOCTYPE html>
    <html>
        <head>
            <title>Accueil</title>
            <?php include 'includes/header.html' ?>
            <?php include 'includes/base_js.html' ?>
            <?php include 'database/connectDB.php' ?>
            <?php include 'database/selectDB.php' ?>
            <?php include 'html/affichage.php' ?>
        </head>
        <body>
            <?php $connect = connectBDD(); ?>
            <div class="bandeauInteraction container-fluid">
                <div class="row">
                    <div class="col-1">
                        <button type="button" class="btn btn-light mt-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i></button>
                        <?php include 'html/formModal.php'; ?>
                    </div>
                    <div class="col-3">
                        <div class="input-group d-md-flex mb-3 mt-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputCategorie">Catégorie</label>
                            </div>
                            <select class="custom-select col-3" id="inputCategorie">
                                <?php selectCategorie($connect); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" method="post">
                <div class="row">
                    <?php
                        $stmt = articleCardList($connect);
                        afficherCard($stmt);
                    ?>
                </div>
            </div>
        </body>
    </html>
