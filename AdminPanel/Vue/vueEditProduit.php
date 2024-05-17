<br>        
        <?php
        
        if ($produit_code == Produit::MODIFY_OK) {
            
            
            echo "<script type='text/javascript'>document.location.replace('index.php?action=produit');</script>";
            
            
        }elseif ($produit_code == Produit::ERROR_FORM) {
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Veuillez vérifier votre saisi !</h3>';                      
            echo '</div>';
        }
        if($erreur['nvSousCat']!='' || $erreur['nvSousCat']!=''||$erreur['nvSurCat']!=''){
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h3>Selectionner les trois champs pour changer la surcategorie ou la categorie ou la souscategorie !</h3>';                      
            echo '</div>';
        }?>

<div class="row">
  <div class="col-lg-12 col-ml-12">
      <div class="row">
          <!-- Ajouter un produit -->
          <div class="col-12 mt-5">
              <div class="card">
                  <div class="card-body">
                        <h4>Editer un produit</h4><br>
                        <p class="text-danger"> * Champ obligatoire </p><br>
                        <form class="edit_form"  method="POST" enctype="multipart/form-data">
                            <div class="form-group ">
                                <label for="nomProduit" class="col-form-label">Nom du produit</label>
                                <input class="form-control" type="text"  id="nomProduit" name="nomProduit" value="<?php echo $Produit['nomProduit']; ?>">
                                <span class="text-danger"><?php echo $erreur['nomProduit']; ?></span>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ancienneSurCategorie" class="col-form-label">Ancienne Surcategorie</label>
                                    <input class="form-control"  type="text"  id="ancienneSurCategorie" name="ancienneSurCategorie" value="<?php echo $Produit['nomSurcategorie']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Nouvelle SurCategorie</label>
                                    <select  name="surcategorieID" id="surcategorie" class="form-control  linked-select" data-target="#categorie" data-source="index.php?action=list&type=categorie&filter=$id" >
                                        <option value="0" selected="selected" >Choisir la nouvelle SurCategorie du produit</option>
                                            <?php foreach ($SurCategories as $SurCategorie) { ?>
                                            
                                                
                                            <option value=<?php echo $SurCategorie['surcategorieID'] ?> ><?php echo $SurCategorie['nomSurcategorie'] ?></option>
                                            
                                            <?php } ?>
                                    </select>
                                    
                                    
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ancienneCategorie" class="col-form-label">Ancienne Categorie</label>
                                    <input class="form-control"  type="text"  id="ancienneCategorie" name="ancienneCategorie" value="<?php echo $Produit['nomCategorie']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Nouvelle Categorie</label>
                                    <select  name='categorieID' id='categorie' class="form-control linked-select" data-target="#souscategorie" data-target="#categorie" data-source="index.php?action=list&type=souscategorie&filter=$id">
                                        <option value="0" selected="selected">Choisir la nouvelle Categorie du produit</option> 
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ancienneSousCategorie" class="col-form-label">Ancienne SousCategorie</label>
                                    <input class="form-control"  type="text"  id="ancienneSousCategorie" name="ancienneSousCategorie" value="<?php echo $Produit['nomSousCategorie']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Nouvelle SousCategorie</label>
                                    <select class="form-control" name="souscategorieID" id="souscategorie">
                                        <option  value="0" selected="selected">Choisir la SousCategorie du produit</option>
                                        
                                    </select>
                                    
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="description" class="col-form-label">Description du produit</label>
                                <textarea class="form-control"  id="description" name="description" ><?php echo $Produit['description']?></textarea>
                                <span class="error text-danger"><?php echo $erreur['des']; ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="qteProduit" class="col-form-label">Quantite du produit</label>
                                <input class="form-control"  type="number"  id="qteProduit" name="qteProduit" value="<?php echo $Produit['Stock']?>">
                                <span class="error text-danger"><?php echo $erreur['qte']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="prixProduit" class="col-form-label">Prix du produit</label>
                                <input class="form-control"  type="number" step="0.001" id="prixProduit" name="prixProduit" value="<?php echo $Produit['prix']?>">
                                <span class="error text-danger"><?php echo $erreur['prix']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="solde" class="col-form-label">Pourcentage de remise</label>
                                <input class="form-control"  type="number"  id="solde" name="solde" value="<?php echo $Produit['Solde']?>" >
                                <span class="error text-danger"><?php echo $erreur['solde']; ?></span>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                <label  class="col-form-label">Ancienne Image du produit</label>
                                <p>&nbsp &nbsp ; <img src=<?php echo './'.$Produit['cheminimage']; ?> class="img-fluid" width="100"></p>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="img" class="col-form-label">Nouvelle Image du produit</label>
                                    <input class="form-control" type="file"  id="img" name="img"></input>
                                    <span class="error text-danger"><?php echo $erreur['nvImage']; ?></span>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary edit-product" name="edit" >Edit Product</button>
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