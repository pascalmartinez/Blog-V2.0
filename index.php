<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>
        <?php include 'includes/header.html';
            include 'includes/base_js.html';
            include 'database/connectDB1.php';
            include 'database/selectDB.php';
            include 'html/affichage.php';
            include 'database/pagination.php';
         ?>
    </head>
    <body style="background-image: url(sources/images/back2.jpeg)">
        <?php $connect = connectBDD(); ?>
        <div class="bandeauInteraction container-fluid">
            <div class="row">
                <div class="col-2 col-md-1">
                    <button type="button" class="btn btn-light mt-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i></button>
                </div>
                <div class="col-10 col-md-3">
                    <div class="input-group d-md-flex mb-3 mt-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputCategorie">Catégorie</label>

                        </div>
                        <select class="custom-select col-7 col-md-6" id="inputCategorie">
                            <?php
                                $stmt = selectCategorie($connect);
                                afficherSelectCategorie($stmt);
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php include 'html/formModal.php'; ?>
        </div>
        <div class="container section" method="post">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php $offset = pagination($connect); ?>
                </ul>
            </nav>
            <div class="row" id="main">
                <?php
                    $stmt = articleCardList($connect, $offset);
                    afficherCard($stmt);
                ?>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php $offset = pagination($connect); ?>
                </ul>
            </nav>
        </div>
        <script src="js/selectCategorie.js"></script>
    </body>
</html>
