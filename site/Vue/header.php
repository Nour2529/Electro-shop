<!-- TOP HEADER -->
<div id="top-header">

			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-2">
							<div class="header-logo">
								<a href="index.php?action=accueil" class="logo">
									<img src="img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-4 clearfix">
							<div class="header-ctn">
                                <!--se connecter-->
                                <div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-user-o"></i>
                                <?php if (!isset($_SESSION['userID'])) { ?>
										<span>Se connecter</span>
									</a>
									<div class="cart-dropdown">
										<div >
                                        
												<a href="index.php?action=inscription"><button class="primary-btn">cree un compte</button></a>
												<a href="index.php?action=login"><button class="primary-btn">connceter</button></a>
											</div>
                                

                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <span>Bonjour</span>
									</a>
									<div class="cart-dropdown">
										<div >
                                        
												<a href="index.php?action=deconnexion"><button class="primary-btn">Deconnexion</button></a>
												
										</div>
                                

                                        </div>
                                    </div>
                                <?php } ?>
                        
                                <!--/se connecter-->
								<!-- Wishlist -->
								
								<!-- /Wishlist -->

                                <!-- Cart -->
                                <div>
									<a href="index.php?action=tunnel">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<?php
										if (isset($_SESSION['countpanier'])&&$_SESSION['countpanier']>0) {?>
											<div class="qty"><?= $_SESSION['countpanier']; ?></div>
											<?php } 
											 else {?>
												
												<?php } ?>
										
									</a>
								</div>
								
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
<!-- container -->
<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php?action=accueil">Home</a></li>
						<li><a href="">Hot Deals</a></li>
						<li><a href="index.php?action=produitList">All Categories</a></li>
						<li><a href="index.php?action=productCategorie&idsurCategorie=1">Ordinateurs & PC prtable</a></li>
						<li><a href="index.php?action=productCategorie&idsurCategorie=2">Telephonie & Tablette</a></li>
						<li><a href="index.php?action=productCategorie&idsurCategorie=3">Image et Son</a></li>
						<li><a href="index.php?action=productCategorie&idsurCategorie=4">accesoires & Peripheriques</a></li>
						<li><a href="index.php?action=productCategorie&idsurCategorie=5">Gaming</a></li>
						
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->