
<input type="hidden" id="test" value="<?= $test ?>"/>

<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php?action=accueil">Home</a></li>
							<?php if($test=='surcategorie'){?>
							<li><a href="index.php?action=produitList">All Categories</a></li>
							<li><a href="index.php?action=productCategorie&idsurCategorie=<?= $ProduitList[0]['surcategorieID']?>"><?= $ProduitList[0]['nomSurcategorie']?></a></li>
							<input type="hidden" id="id" value="<?= $ProduitList[0]['surcategorieID']?>"/>
							<?php }  elseif ($test=='categorie'){?>
								<li><a href="index.php?action=produitList">All Categories</a></li>
								<li><a href="index.php?action=productCategorie&idsurCategorie=<?= $ProduitList[0]['surcategorieID']?>"><?= $ProduitList[0]['nomSurcategorie']?></a></li>
								<li><a href="index.php?action=productCategorie&idCategorie=<?= $ProduitList[0]['categorieID']?>"><?= $ProduitList[0]['nomCategorie']?></a></li>
								<input type="hidden" id="id" value="<?= $ProduitList[0]['categorieID']?>"/>
							<?php } elseif ($test=='souscategorie'){?>
								<li><a href="index.php?action=produitList">All Categories</a></li>
								<li><a href="index.php?action=productCategorie&idsurCategorie=<?= $ProduitList[0]['surcategorieID']?>"><?= $ProduitList[0]['nomSurcategorie']?></a></li>
								<li><a href="index.php?action=productCategorie&idCategorie=<?= $ProduitList[0]['categorieID']?>"><?= $ProduitList[0]['nomCategorie']?></a></li>
								<li><a href="index.php?action=productCategorie&idsousCategorie=<?= $ProduitList[0]['sousCategorieID']?>"><?= $ProduitList[0]['nomSousCategorie']?></a></li>
								<input type="hidden" id="id" value="<?= $ProduitList[0]['sousCategorieID']?>"/>
							<?php } elseif ($test=='all'){?>
								<li><a href="index.php?action=produitList">All Categories</a></li>
								<input type="hidden" id="id" value="0"/>
							<?php } ?>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
						<?php if($test=='surcategorie'){?>
							<h3 class="aside-title">All Categories</h3>
							<h4 ><?= $ProduitList[0]['nomSurcategorie']?></h4>
							<ul class="list-group list-group-flush">
							<?php 
							$i=0;
							foreach($surcategories as $x){
								$i++;?>
								<a href="index.php?action=productCategorie&idCategorie=<?php echo $x[0] ?>">
								<li class="list-group-item">
									<span></span>
									<?php echo $x[1] ;?>
									<small>(<?php echo $x[2] ;?>)</small>
							</li>
							</a>
							<?php }
							?>
								
							</ul>
						<?php }  elseif ($test=='categorie'){?>
							<h3 class="aside-title">All Categories</h3>
							<h4 ><?= $ProduitList[0]['nomSurcategorie']?></h4>
							<h5 ><?= $ProduitList[0]['nomCategorie']?></h5>
							<ul class="list-group list-group-flush">
							<?php 
							$i=0;
							foreach($surcategories as $x){
								$i++;?>
								<a href="index.php?action=productCategorie&idsousCategorie=<?php echo $x[0] ?>">
								<li class="list-group-item">
									<span></span>
									<?php echo $x[1] ;?>
									<small>(<?php echo $x[2] ;?>)</small>
							</li>
							</a>
							<?php }
							?>
								
							</ul>
						<?php } elseif ($test=='souscategorie'){?>
							<h3 class="aside-title">All Categories</h3>
							<h4 ><?= $ProduitList[0]['nomSurcategorie']?></h4>
							<h5 ><?= $ProduitList[0]['nomCategorie']?></h5>
							<h6 ><?= $ProduitList[0]['nomSousCategorie']?></h6>

						<?php } elseif ($test=='all'){?>
							<h3 class="aside-title">All Categories</h3>
							<ul class="list-group list-group-flush">
							<?php 
							$i=0;
							foreach($surcategories as $x){
								$i++;?>
								<a href="index.php?action=productCategorie&idsurCategorie=<?php echo $x[0] ?>">
								<li class="list-group-item">
									<span></span>
									<?php echo $x[1] ;?>
									<small>(<?php echo $x[2] ;?>)</small>
							</li>
							</a>
							<?php }
							?>
								
							</ul>
							<?php } ?>
							
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="niput-number price-min price">
									<input id="price-min" type="number" value="0"/>
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max price">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
					</div>

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select" id="input-select-sort">
										<option value="0">monis chaire</option>
										<option value="1">plus chaire</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select" id="input-select-show">
										<option value="0">9</option>
										<option value="1">18</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						
						<!-- /store top filter -->
						<!-- store products -->
						<div id="row">
                        <div class="row" >

                            <?php

if (empty($ProduitList)) {
    echo "<strong>Aucun produit dans cette sous catégorie</strong>";
} else {
    foreach ($ProduitList as $Produit) { ?>
        <div class="col-md-4 col-xs-6">
			<div class="product" >
					<div class="product-img">
                    <a href="?action=productCategorie&id=<?php echo $Produit['produitID']; ?>"><img class="display"
                                                                                                src="<?= $Produit['cheminimage']; ?>"
                                                                                                alt="image produit"/></a>
							<div class="product-label">
							<?php if($Produit['Solde']!=0){?>
												<span class="sale">-<?= $Produit['Solde']; ?>%</span>
												<?php }?>
							<?php $date=date("Y-m-d",strtotime('-1 months'));
									
							if($date<$Produit['Date']){?>
								<span class="new">NEW</span>
							<?php }?>
							
							</div>
					</div>
                    <div class="product-body">
										<p class="product-category"><?= $Produit['nomCategorie']; ?></p>
										<h3 class="product-name"><a href="?action=productCategorie&id=<?php echo $Produit['produitID']; ?>"><?= substr($Produit['nomProduit'], 0, 18); ?></a></h3>
										<?php if($Produit['Solde']==0){?>
											<h4 class="product-price"><?= $Produit['prix']; ?> dt</h4>
											
											<?php }
											else{?>
											<h4 class="product-price"><?php echo sprintf("%01.3f",($Produit['prix']-($Produit['prix']*$Produit['Solde']/100))); ?>dt <del class="product-old-price"><?= $Produit['prix']; ?> dt</del></h4>
											<?php }?>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										
									</div>
									<div class="add-to-cart">
                                    <a href="?action=productCategorie&do=addPanier&id=<?php echo $Produit['produitID']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button></a>
									</div>
								</div>
							</div>
        
        
        
                                    
    <?php }
}
?>
</div>
<div class="store-filter clearfix row">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination" id="store-pagination">
                            <li class="<?= ($currentPage == 1) ? "disabled" : "" ?>"><</li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" <?= ($currentPage == $page) ? 'id="active"' : '' ?> >
                          <?= $page ?>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="<?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            >
                        </li>
                    </ul>
						</div>
</div>

</div>
</div>
</div>
