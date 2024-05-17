<br>        
        <?php
        
        if ($souscategorie_code == SousCategorie::MODIFY_OK) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=souscategorie');</script>";
            
            
        } 
        
        
       elseif ($souscategorie_code == SousCategorie::ERROR_FORM) {
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
                        <h4>Modifier SousCategorie</h4><br>
                        <p class="text-danger"> * Champ obligatoire </p><br>
                        <form class="edit_form"  method="POST" enctype="multipart/form-data">
                            
                       
                                
                                <div class="form-group col-md-12">
                                <label class="col-form-label" for="categorie">Categorie associée <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="categorie" id="categorie" value="<?php echo $Categorie[0]['nomCategorie']  ?>" disabled>
                                    
                                    
                                </div>
                            
                            
                                
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="souscategorie">SousCategorie <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="souscategorie" id="souscategorie" value="<?php echo $SousCategorie  ?>">
                                    <span class="error text-danger"><?php echo $erreur['NvSousCat']; ?></span>
                                    
                                    
                                </div>
                            
                            
                            
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary edit-souscategorie" name="edit" >Edit SousCategorie</button>
                            <a href="index.php?action=souscategorie"><button type="button" class="btn btn-danger " name="annuler">Annuler</button></a>
                            </div>
                    </form>
                  </div>
              </div>
          </div>
          <!-- /Ajouter un produit -->
      </div>
  </div>
</div>