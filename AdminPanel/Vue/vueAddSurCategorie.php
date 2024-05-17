<br>        
        <?php
        
        
        if ($surcategorie_code == SurCategorie::ADD_OK) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=surcategorie');</script>";
            
            
        } elseif ($surcategorie_code == SurCategorie::SURCATEGORIE_ALREADY_EXIST) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>SurCategorie existe déjà !</h3>';                         
            echo '</div>';
        }
        
        
       elseif ($surcategorie_code == SurCategorie::ERROR_FORM) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Veuillez vérifier votre saisi !</h3>';                      
            echo '</div>';
        }elseif ($surcategorie_code == SurCategorie::ADD_ANNULER) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=surcategorie');</script>";
        }?>
<div class="row">
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <!-- Ajouter un produit -->
            <div class="col-12 mt-5">
              <div class="card">
                   <div class="card-body">
                        <h4>Ajouter SurCategorie </h4> <br>
                        <form  method="POST" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label class="col-form-label" for="surcategorie">SurCategorie <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="surcategorie" id="surcategorie">
                                <span class="error text-danger"><?php echo $erreur['SurCat']; ?></span>
                                
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary add-surcategorie" name="add" >Add SurCategorie</button>
                            <a href="index.php?action=surcategorie"><button type="button" class="btn btn-danger " name="annuler">Annuler</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            <div>
        </div>
    </div>
</div>