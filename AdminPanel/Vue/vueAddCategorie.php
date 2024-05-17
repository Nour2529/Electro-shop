<br>        
        <?php
        
        
        if ($categorie_code == Categorie::ADD_OK) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=categorie');</script>";
            
            
        } elseif ($categorie_code == Categorie::CATEGORIE_ALREADY_EXIST) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Categorie existe déjà !</h3>';                         
            echo '</div>';
        }
        
        
       elseif ($categorie_code == Categorie::ERROR_FORM) {
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
                        <h4>Ajouter Categorie</h4><br>
                        <p class="text-danger"> * Champ obligatoire </p><br>
                        <form class="edit_form"  method="POST" enctype="multipart/form-data">
                            
                       
                                
                                <div class="form-group col-md-12">
                                    <label class="col-form-label">SurCategorie associée</label><span class="text-danger">*</span>
                                    <select  name="surcategorieID" id="surcategorie" class="form-control "  >
                                        <option value="0" selected="selected" >Choisir la nouvelle SurCategorie</option>
                                            <?php foreach ($SurCategories as $SurCategorie) { ?>
                                            
                                                
                                            <option value=<?php echo $SurCategorie['surcategorieID'] ?> ><?php echo $SurCategorie['nomSurcategorie'] ?></option>
                                            
                                            <?php } ?>
                                    </select>
                                    <span class="error text-danger"><?php echo $erreur['SurCat']; ?></span>
                                    
                                </div>
                            
                            
                                
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="categorie">Nouvelle Categorie <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="categorie" id="categorie" value="<?php echo $Categorie ?>">
                                    <span class="error text-danger"><?php echo $erreur['NvCat']; ?></span>
                                    
                                    
                                </div>
                            
                            
                            
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary add-categorie" name="add" >Add Categorie</button>
                            <a href="index.php?action=categorie"><button type="button" class="btn btn-danger " name="annuler">Annuler</button></a>
                            </div>
                    </form>
                  </div>
              </div>
          </div>
          
      </div>
  </div>
</div>
