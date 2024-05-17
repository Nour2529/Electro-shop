<?php
/*
* User: Francis Polaert & Kévin Noet
* Date: 04/11/2016
*/

if (empty($_SESSION['userID'])) {
    $bdd = new PDO('mysql:host=localhost; dbname=db_e_shopping; charset=utf8', 'root', '');
    $paiemment = $bdd->query("SELECT * FROM moyendepaiement");
    $sql=$bdd->prepare('SELECT Stock FROM produit WHERE produitID=?');
    $sqlp=$bdd->prepare('SELECT * FROM produit WHERE produitID=?');
    if(!isset($_SESSION['panier'])||empty($_SESSION['panier'])){
        echo '<div class="section"><div class="container"><div class="row"><h3 class="alert alert-info">Votre panier est vide</h3></div></div></div>';
    }
    else{?>
        <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
<table id="cart" class="table table-hover table-condensed">
<thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:7%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
</thead>
    <?php
    $total=0;
    foreach($_SESSION['panier'] as $p => $q){
        $sqlp->execute(array($p));
                    $produit=$sqlp->fetch();
        ?>
        <tbody>
        <tr>
            <td data-th="Product">
            <div class="row">
            <div class="col-sm-4 "><img src="<?php echo $produit["cheminimage"] ?>" style="height: 70px;width:75px;"/>
                                <h4 class="nomargin product-name header-cart-item-name"><a href="#"><?php echo $produit["nomProduit"] ?></a></h4>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                    <p><?php echo $produit["nomProduit"] ?>
                                    </div>

                                    <div>
									<a href="index.php?action=supprimer&id=<?=$produit['produitID']?>&q=<?=$q?>" style="color: red" >
										
                                    <i class="fa fa-trash"></i><span>supprimer</span>
										
									</a>
								    </div>
                                </div>
                                
                                
                            </div>
                   
                </td>
                <td>
                <?php if($produit['Solde']==NULL){?>
											<p class="product-price"><?php $prix=$produit['prix'];echo $prix; ?> dt</p>
											
											<?php }
											else{?>
											<p class="product-price"><?php $prix=$produit['prix']-($produit['prix']*$produit['Solde']/100);echo sprintf("%01.3f",$prix); ?>dt <del class="product-old-price"><?= $produit['prix']; ?> dt</del></p>
											<?php }?>
                </td>
                <td>
                
                    <label>
                    <?php $sql->execute(array($produit['produitID']));
                        $stock=$sql->fetch();
                            ?> 
                                    <select class="input-select" id="input-select-quantite" onchange="location = this.value;">
                                    <?php for($i=1;$i<=$stock["Stock"];$i++) {?>
										<option <?php if ($q==$i){echo 'selected="selected"';} ?> value="index.php?action=addquntiter&id=<?=$produit['produitID']?>&quantite=<?=$i?>&q=<?=$q?>"><?=$i?></option>
										<?php }?>
									</select>
					</label>
                    
                                            
                </td>
                <td>
                <?php echo sprintf("%01.3f",$prix * $q) ?> dt <?php $total=$total+$prix * $q?>
                </td>
                
                
            </tr>
            <?php
            
        }
        ?>
        </tbody>
        <tfoot>
					
					<tr>
						<td><a href="index.php?action=produitList" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td><h4>Totale <?php echo sprintf("%01.3f",$total)?>dt</h4></td>
						<div id="issessionset"></div>
                        <td>
							
					
							</td>
								</tr>
							</tfoot>
        </table>
        
        <a href="index.php?action=login"><button type="submit" class="btn btn-primary">FINALISER VOTRE COMMANDE</button></a>
    
    </div >
			<!-- container -->
    </div >
				<!-- row -->
    </div >
    

                <?php    }

} else {
    $bdd = new PDO('mysql:host=localhost; dbname=db_e_shopping; charset=utf8', 'root', '');
    $paiemment = $bdd->query("SELECT * FROM moyendepaiement");
    $lignepanier = $bdd->query("SELECT *
                            FROM lignepanier, panier, produit
                            WHERE panier.userID = " . $_SESSION['userID'] . "
                            AND panier.panierID = lignepanier.panierID
                            AND lignepanier.produitID = produit.produitID
							AND panier.etatPanier = 0");
    $sql=$bdd->prepare('SELECT Stock FROM produit WHERE produitID=?');
    
    if (empty($lignepanier_line = $lignepanier->fetch())) {
        echo '<div class="section"><div class="container"><div class="row"><h3 class="alert alert-info">Votre panier est vide</h3></div></div></div>';
    } else {
        ?>
            <div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
    <table id="cart" class="table table-hover table-condensed">
    <thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:7%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
	</thead>
        <?php
        $total=0;
        while ($lignepanier_line) {
            ?>
            <tbody>
            <tr>
                <td data-th="Product">
                <div class="row">
								
                                <div class="col-sm-4 "><img src="<?php echo $lignepanier_line["cheminimage"] ?>" style="height: 70px;width:75px;"/>
                                <h4 class="nomargin product-name header-cart-item-name"><a href="#"><?php echo $lignepanier_line["nomProduit"] ?></a></h4>
                                </div>
                                <div class="col-sm-6">
                                    <div >
                                    <p><?php echo $lignepanier_line["nomProduit"] ?></div>
                                
									<a href="index.php?action=supprimer&id=<?=$lignepanier_line['produitID']?>&q=<?=$lignepanier_line['quantité']?>" style="color: red" >
										
                                    <i class="fa fa-trash"></i><span>supprimer</span>
										
									</a>
								    </div>
                                
                            </div>
                   
                </td>
                
                <td>
                <?php if($lignepanier_line['Solde']==NULL){?>
											<p class="product-price"><?php $prix=$lignepanier_line['prix'];echo $prix; ?> dt</p>
											
											<?php }
											else{?>
											<p class="product-price"><?php $prix=$lignepanier_line['prix']-($lignepanier_line['prix']*$lignepanier_line['Solde']/100);echo sprintf("%01.3f",$prix); ?>dt <del class="product-old-price"><?= $lignepanier_line['prix']; ?> dt</del></p>
											<?php }?>
                </td>
                <td>
                
                    <label>
                    <?php $sql->execute(array($lignepanier_line['produitID']));
                        $stock=$sql->fetch();
                            ?> 
                                    <select class="input-select" id="input-select-quantite" onchange="location = this.value;">
                                    <?php for($i=1;$i<=$stock["Stock"];$i++) {?>
										<option <?php if ($lignepanier_line['quantité']==$i){echo 'selected="selected"';} ?> value="index.php?action=addquntiter&id=<?=$lignepanier_line['produitID']?>&quantite=<?=$i?>&q=<?=$lignepanier_line['quantité']?>"><?=$i?></option>
										<?php }?>
									</select>
					</label>
                    
                </div>                            
                </td>
                <td>
                <?php echo sprintf("%01.3f",$prix * $lignepanier_line["quantité"]) ?> dt <?php $total=$total+$prix * $lignepanier_line["quantité"]?>
                </td>
                
                
            </tr>
            <?php
            $lignepanier_line = $lignepanier->fetch();
        }
        ?>
        </tbody>
        <tfoot>
					
					<tr>
						<td><a href="index.php?action=produitList" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td><h4>Totale <?php echo sprintf("%01.3f",$total)?>dt</h4></td>
						<div id="issessionset"></div>
                        <td>
							
					
							</td>
								</tr>
							</tfoot>
        </table>
    </div >
			<!-- container -->
    </div >
				<!-- row -->
    </div >
    <div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
        <form method="POST" action="?action=tunnel">
        <div class="form-group">
            <table>

                <tr>
                    <td>Numéro de rue</td>
                    <td><input class="form-control" type="text" name="number"/></td>
                </tr>
                <tr>
                    <td>Adresse</td>
                    <td><input class="form-control" type="text" name="adress"/></td>
                </tr>
                <tr>
                    <td>Ville</td>
                    <td><input class="form-control" type="text" name="city"/></td>
                </tr>
                <tr>
                    <td>Code postal</td>
                    <td><input class="form-control" type="text" name="code"/></td>
                </tr>
            </table>
        
            <br/>

            <label>
                Moyen de paiemment:
                <span class="custom-dropdown custom-dropdown--white">
			<select name="paiemment" class="custom-dropdown__select custom-dropdown__select--white form-control">
				<?php
                while ($paiemment_line = $paiemment->fetch()) {
                    ?>
                    <option><?php echo $paiemment_line["nomMoyenDePaiement"] ?></option>
                    <?php
                }
                ?>
			</select>
		</span>
            </label>
            <?php
            if (isset($_POST['paiemment'])) {
                $moyenPaiemment = $_POST['paiemment'];
            }
            ?>
            <br/>
            <br/>
            <input  class="btn btn-success" value="Valider" href="index.php?action=tunnel" type="submit">
            </div>
        </form>
        

        <?php
        if (empty($_POST['number'])) {
            echo "<h4><p class=\"text-danger\">Vous n'avez pas entré un numéro de rue</p></h4>";
        } elseif (empty($_POST['adress'])) {
            echo "<h4><p class=\"text-danger\">Vous n'avez pas entré une adresse</p></h4>";
        } elseif (empty($_POST['city'])) {
            echo "<h4><p class=\"text-danger\">Vous n'avez pas entré votre ville</p></h4>";
        } elseif (empty($_POST['code'])) {
            echo "<h4><p class=\"text-danger\">Vous n'avez pas entré un code postal</p></h4>";
        } else {
            $bdd->exec('INSERT INTO adresse(adresseID,codePostal,ville,numeroVoie,nomRue) VALUES ( , ' . $_POST['code'] . ' , ' . $_POST['city'] . ' , ' . $_POST['number'] . ' , ' . $_POST['adress'] . ')');
            $bdd->exec('UPDATE panier SET etatPanier =1 WHERE userID=' . $_SESSION['userID'] . '');
            $MoyenPaiement = $bdd->query('SELECT * 
									FROM moyendepaiement 
									WHERE nomMoyenDePaiement="' . $moyenPaiemment . '";');
            $MoyenPaiement = $MoyenPaiement->fetch();
            echo $MoyenPaiement['moyenDePaiementID'];
            $bdd->exec('UPDATE panier SET moyenDePaiementID =' . $MoyenPaiement['moyenDePaiementID'] . ' WHERE userID=' . $_SESSION['userID'] . '');
            echo "<h4><p class=\"text-success\">Votre panier à bien été accepté</p></h4>";
        }
    }
}
?>
</div>
</div>
</div>

