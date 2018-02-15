
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formulairemodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formulairemodal">Ajout d'un article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group">
                        <form class="container formulaire" action="html/traitForm.php" enctype="multipart/form-data" method="post">
                            <div class="form-group form-title">
                                <label for="exampleFormControlInput1 form-title">Votre nom</label>
                                <input name="nom" type="text" class="form-control form-field" placeholder="Indiquer votre nom ici">
                                <label for="exampleFormControlInput1">Votre adresse email</label>
                                <input name="email" type="email" class="form-control form-field" id="exampleFormControlInput1" placeholder="votreptitnom@example.com">
                            </div>
                            <div class="custom-file form-title">
                                <input  value="Upload Image"  name="fichier" type="file" class="custom-file-input form-title" id="customFile">
                                <label class="custom-file-label form-field" for="customFile">Inclure une image</label>
                            </div>
                            <div class="title form-title">
                                <label for="exampleFormControlInput1 form-title">Votre titre de message</label>
                                <input name="titremessage" type="text" class="form-control form-field" placeholder="Indiquer votre titre ici">
                            </div>
                            <div class="form-group form-title">
                                <label for="selectCategorie form-title">Selection de groupe</label>
                                <select class="form-control form-field" id="selectCategorie" name="categorie">
                                <?php
                                    $stmt = selectCategorie($connect);
                                    afficherSelectCategorie($stmt);
                                ?>
                                </select>
                            </div>
                            <div class="form-group form-title">
                                <label for="exampleFormControlTextarea1 form-title">Votre message</label>
                                <textarea name="message" class="form-control form-field" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>
                    </div>
                            <div class="submit-container modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input class="submit-button" type="submit" value="Submit" action="post" />
                            </div>
                        </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
