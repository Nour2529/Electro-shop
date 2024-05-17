<br>        
        <?php
        
        
        if ($souscategorie_code == SousCategorie::ADD_OK) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=souscategorie');</script>";
            
            
        } elseif ($souscategorie_code == SousCategorie::SOUSCATEGORIE_ALREADY_EXIST) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>SousCategorie existe déjà !</h3>';                         
            echo '</div>';
        }
        
        
       elseif ($souscategorie_code == SousCategorie::ERROR_FORM) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Veuillez vérifier votre saisi !</h3>';                      
            echo '</div>';
       
        }?>
<div class="row">
  <div class="col-lg-12 col-ml-12">
      <div class="row">
          
          <div class="col-12 mt-5">
              <div class="card">
                  <div class="card-body">
                        <h4>Ajouter SousCategorie</h4><br>
                        <p class="text-danger"> * Champ obligatoire </p><br>
                        <form class="edit_form"  method="POST" enctype="multipart/form-data">
                            
                       
                                
                                <div class="form-group col-md-12">
                                    <label class="col-form-label">Categorie associée</label><span class="text-danger">*</span>
                                    <select  name="categorieID" id="categorie" class="form-control "  >
                                        <option value="0" selected="selected" >Choisir la nouvelle Categorie</option>
                                            <?php foreach ($Categories as $Categorie) { ?>
                                            
                                                
                                            <option value="<?php echo $Categorie['categorieID'] ?>" ><?php echo $Categorie['nomCategorie'] ?></option>
                                            
                                            <?php } ?>
                                    </select>
                                    <span class="error text-danger"><?php echo $erreur['Cat']; ?></span>
                                    
                                </div>
                            
                            
                                
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="souscategorie">Nouvelle SousCategorie <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="souscategorie" id="souscategorie" value="<?php echo $SousCategorie ?>">
                                    <span class="error text-danger"><?php echo $erreur['NvSousCat']; ?></span>
                                    
                                    
                                </div>
                            
                            
                            
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary add-souscategorie" name="add" >Add SousCategorie</button>
                            <a href="index.php?action=souscategorie"><button type="button" class="btn btn-danger " name="annuler">Annuler</button></a>
                            </div>
                    </form>
                  </div>
              </div>
          </div>
          
      </div>
  </div>
</div>
