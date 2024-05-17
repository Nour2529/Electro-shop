<br>        
        <?php
        
        if ($categorie_code == Categorie::MODIFY_OK) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=categorie');</script>";
            
            
        } 
        
        
       elseif ($categorie_code == Categorie::ERROR_FORM) {
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
                        <h4>Modifier Categorie</h4><br>
                        <p class="text-danger"> * Champ obligatoire </p><br>
                        <form class="edit_form"  method="POST" enctype="multipart/form-data">
                            
                       
                                
                                <div class="form-group col-md-12">
                                <label class="col-form-label" for="surcategorie">SurCategorie associée <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="surcategorie" id="categorie" value="<?php echo $SurCategorie[0]['nomSurcategorie']  ?>" disabled>
                                    
                                    
                                </div>
                            
                            
                                
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="categorie">Categorie <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="categorie" id="categorie" value="<?php echo $Categorie  ?>">
                                    <span class="error text-danger"><?php echo $erreur['NvCat']; ?></span>
                                    
                                    
                                </div>
                            
                            
                            
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary edit-categorie" name="edit" >Edit Categorie</button>
                            <a href="index.php?action=categorie"><button type="button" class="btn btn-danger " name="annuler">Annuler</button></a>
                            </div>
                    </form>
                  </div>
              </div>
          </div>
          <!-- /Ajouter un produit -->
      </div>
  </div>
</div>