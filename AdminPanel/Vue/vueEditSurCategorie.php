<br>        
        <?php
        
        if ($surcategorie_code == SurCategorie::MODIFY_OK) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=surcategorie');</script>";
            
            
        } 
        
        
       elseif ($surcategorie_code == SurCategorie::ERROR_FORM) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Veuillez vérifier votre saisi !</h3>';                      
            echo '</div>';
        }?>
<div class="row">
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <!-- Ajouter un produit -->
            <div class="col-12 mt-5">
              <div class="card">
                   <div class="card-body">
                        <h4>Modifier SurCategorie </h4> <br>
                        <form  method="POST" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label class="col-form-label" for="surcategorie">Nouvelle SurCategorie <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="nvsurcategorie"  value="<?php echo $SurCategorie[0]['nomSurcategorie'] ; ?>">
                                <span class="error text-danger"><?php echo $erreur['NvSurCat']; ?></span>
                                
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary add-surcategorie" name="edit" >Edit SurCategorie</button>
                            <a href="index.php?action=surcategorie"><button type="button" class="btn btn-danger " name="annuler">Annuler</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            <div>
        </div>
    </div>
</div>