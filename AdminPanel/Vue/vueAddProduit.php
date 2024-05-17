<br>        
        <?php
        
        if ($produit_code == Produit::ADD_OK) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=produit');</script>";
            
            
        } elseif ($produit_code == Produit::PRODUCT_ALREADY_EXIST) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Ce produit existe déjà !</h3>';                         
            echo '</div>';
        }
        
        
       elseif ($produit_code == Produit::ERROR_FORM) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Veuillez vérifier votre saisi !</h3>';                      
            echo '</div>';
        }elseif ($produit_code == Produit::ADD_ANNULER) {
            echo "<script type='text/javascript'>document.location.replace('index.php?action=produit');</script>";
        }?>

<div class="row">
  <div class="col-lg-12 col-ml-12">
      <div class="row">
          <!-- Ajouter un produit -->
          <div class="col-12 mt-5">
              <div class="card">
                  <div class="card-body">
                        <h4>Ajouter un produit </h4> <br>
                        <form class="admin_form"  method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nomProduit" class="col-form-label">Nom du produit <span class="text-danger">*</span></label>
                                <input class="form-control" type="text"  id="nomProduit" name="nomProduit" value="<?php echo $Produit['nomProduit']; ?>">
                                <span class="text-danger"><?php echo $erreur['nomProduit']; ?></span>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">SurCategorie <span class="text-danger">*</span></label>
                                <select  name="surcategorieID" id="surcategorie" class="form-control linked-select" data-target="#categorie" data-source="index.php?action=list&type=categorie&filter=$id">
                                    <option value="0" selected="selected">Choisir la Surcategorie du produit</option>
                                        <?php foreach ($SurCategories as $SurCategorie) { ?>
                                        <option value=<?php echo $SurCategorie['surcategorieID'] ?> ><?php echo $SurCategorie['nomSurcategorie'] ?></option>
                                        <?php } ?>
                                </select>
                                <span class="error text-danger"><?php echo $erreur['nvSurCat']; ?></span>
                                
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Categorie <span class="text-danger">*</span></label>
                                <select  name='categorieID' id='categorie' class="form-control linked-select" data-target="#souscategorie" data-target="#categorie" data-source="index.php?action=list&type=souscategorie&filter=$id">
                                    <option selected="selected">Choisir la Categorie du produit</option>
                                        
                                </select>
                                <span class="error text-danger"><?php echo $erreur['nvCat']; ?></span>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">SousCategorie <span class="text-danger">*</span></label>
                                <select class="form-control" name="souscategorieID" id="souscategorie">
                                    <option selected="selected">Choisir la SousCategorie du produit</option>
                                    
                                </select>
                                <span class="error text-danger"><?php echo $erreur['nvSousCat']; ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="description" class="col-form-label">Description du produit <span class="txst-danger">*</span></label>
                                <textarea class="form-control"  id="description" name="description"><?php echo $Produit['description']?></textarea>
                                <span class="error text-danger"><?php echo $erreur['des']; ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="qteProduit" class="col-form-label">Quantite du produit <span class="text-danger">*</span></label>
                                <input class="form-control"  type="number"  id="qteProduit" name="qteProduit" value="<?php echo $Produit['Stock']?>" >
                                <span class="error text-danger"><?php echo $erreur['qte']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="prixProduit" class="col-form-label">Prix du produit <span class="text-danger">*</span></label>
                                <input class="form-control"  type="number" step="0.001" id="prixProduit" name="prixProduit" value="<?php echo $Produit['prix']?>">
                                <span class="error text-danger"><?php echo $erreur['prix']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="solde" class="col-form-label">Pourcentage de remise <span class="text-danger">*</span></label>
                                <input class="form-control"  type="number"  id="solde" name="solde" value="<?php echo $Produit['Solde']?>">
                                <span class="error text-danger"><?php echo $erreur['solde']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="cheminimage" class="col-form-label">Image du produit <span class="text-danger">*</span></label>
                                <input class="form-control" type="file"  id="cheminimage" name="cheminimage"></input>
                                <span class="error text-danger"><?php echo $erreur['nvImage']; ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary add-product" name="add" >Add Product</button>
                            <a href="index.php?action=produit"><button type="button" class="btn btn-danger " name="annuler">Annuler</button></a>
                            </div>
                    </form>
                  </div>
              </div>
          </div>
          <!-- /Ajouter un produit -->
      </div>
  </div>
</div>
<script src="./assets/js/main.js"></script>
