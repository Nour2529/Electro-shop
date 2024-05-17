<?php

/**
 * User: Magaly & Cuize
 * Date: 04/11/2016
 */
//________________________________________________________________________________________
// Require once
require_once 'Controller/Controleur.php';
require_once 'Vue/Vue.php';


class ControleurProductCategorie implements Controleur
{
    /**
     * @var Produit
     */
    private $produit;


    //______________________________________________________________________________________
    /**
     * ControleurProductCategorie constructor.
     */
    public function __construct()
    {
        $this->produit = new Produit();
    }

    /**
     * Getter du produit
     *
     * @return Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Getter du produit
     *
     * @param $newProduct
     */
    public function setProduit($newProduct)
    {
        $this->produit = $newProduct;
    }


    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML()
    {   
        if(isset($_GET["filtre"])){
            
            if($_GET["filtre"]=="price"){
                if(isset($_GET["page"]) && !empty($_GET["page"])){
                    
                        
                    
                    $currentPage = (int) strip_tags($_GET['page']);
                }else{
                    $currentPage = 1;
                }
                
                if (isset($_GET['surcategorie']) ) { // veut voir la liste des produits dans une catégorie
                    $nbArticles=$this->produit->countsur($_GET['surcategorie'],$_GET["min"],$_GET["max"]);
                }elseif(isset($_GET['categorie'])){
                    
                    $nbArticles=$this->produit->count_c($_GET['categorie'],$_GET["min"],$_GET["max"]);
                }elseif(isset($_GET['souscategorie'])){
                    $nbArticles=$this->produit->countsous($_GET['souscategorie'],$_GET["min"],$_GET["max"]);
                }

                if($_GET["show"]==0){
                    $parPage = 9;
                }elseif($_GET["show"]==1){
                    $parPage = 18;
                }
                $pages = ceil($nbArticles / $parPage);
                $premier = ($currentPage * $parPage) - $parPage;
                
                if (isset($_GET['surcategorie']) ) {
                     // veut voir la liste des produits dans une catégorie
                    $ProduitList=$this->produit->getcategoriebyfiltresur($_GET['surcategorie'],$_GET["min"],$_GET["max"],$_GET["sort"],$parPage,$premier);
                }elseif( isset($_GET['categorie'])){
                    $ProduitList=$this->produit->getcategoriebyfiltre_c($_GET['categorie'],$_GET["min"],$_GET["max"],$_GET["sort"],$parPage,$premier);
                }elseif( isset($_GET['souscategorie'])){
                $ProduitList=$this->produit->getcategoriebyfiltresous($_GET['souscategorie'],$_GET["min"],$_GET["max"],$_GET["sort"],$parPage,$premier);
                }

                
            if (empty($ProduitList)) {
                echo "<strong>Aucun produit dans cette sous catégorie</strong>";
            } else {
                
                ?>  <div class="row" >
                <?php
                foreach ($ProduitList as $Produit) { ?>
                    <div class="col-md-4 col-xs-6">
                        <div class="product" >
                                <div class="product-img">
                                <a href="?action=productCategorie&id=<?php echo $Produit['produitID']; ?>"><img class="display"
                                                                                                            src="<?= $Produit['cheminimage']; ?>"
                                                                                                            alt="image produit"/></a>
                                        <div class="product-label">
                                        <?php if($Produit['Solde']>0){?>
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
                                        
                    
                    
                                                
                <?php }?>
                </div>
                <div class="store-filter clearfix row">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination" id="store-pagination">
                            <li class="<?= ($currentPage == 1) ? "disabled" : "" ?>" onclick="filter_data(<?= $currentPage-1 ?>);"><</li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>" <?= ($currentPage == $page) ? 'id="active"' : '' ?> onclick="filter_data(<?= $page ?>);">
                          <?= $page ?>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="<?= ($currentPage == $pages) ? "disabled" : "" ?> "onclick="filter_data(<?= $currentPage+1 ?>);">
                            >
                        </li>
                    </ul>
						</div>
                
                
                <?php
                
            }
        
           

            }

        }else{
        if (isset($_GET['idsurCategorie']) ) { // veut voir la liste des produits dans une catégorie
            $vue = new Vue("ProduitList");
            $vue->generer(array("ProduitList" => $this->produit->getAllProduitsBysurCategorieId($_GET['idsurCategorie']),'surcategories'=>$this->produit->counttoutcategorie($_GET['idsurCategorie']),'test' => 'surcategorie'));
        }elseif( isset($_GET['idCategorie'])){
            $vue = new Vue("ProduitList");
            $vue->generer(array("ProduitList" => $this->produit->getAllProduitsByCategorieId($_GET['idCategorie']),'surcategories'=>$this->produit->counttoutsouscategorie($_GET['idCategorie']),'test' => 'categorie'));
        }elseif( isset($_GET['idsousCategorie'])){
            $vue = new Vue("ProduitList");
            $vue->generer(array("ProduitList" => $this->produit->getAllProduitsBysousCategorieId($_GET['idsousCategorie']),'surcategories'=>$this->produit->counttoutsurcategorie(),'test' => 'souscategorie'));
        }
         else if (isset($_GET['id']) && !isset($_GET["do"])) {   // veut voir un produit en particulier
            // On a un item !
            $vue = new Vue("Produit");
            if (!isset($_SESSION['userID'])) {
                $vue->generer(array(
                    "add_panier" => false,
                    "produit" => $this->getProduit()->getProduit($_GET['id']),
                    ));
            }
            else{ $vue->generer(array(
                "add_panier" => false,
                "produit" => $this->getProduit()->getProduit($_GET['id']),
                "panier"=> $this->getProduit()->getPanierForUser($_SESSION['userID']),
                "ligne"=>$this->getProduit()->getLignePanier($this->getProduit()->getPanierForUser($_SESSION['userID'])["panierID"], $_GET['id'])));}
           
        } else if (isset($_GET['do']) && isset($_GET['id'])) { // ajout d'un produit au panier
            if (!isset($_SESSION['userID'])) {
                if(!isset($_SESSION['panier'])){
                    $tab=[];
                    $tab[$_GET['id']]=1;
                    $_SESSION['panier']=$tab;
                    
                }
                else{
                    $k=false;
                    if(!empty($_SESSION['panier'])){
                    foreach($_SESSION['panier'] as $p => $q){
                        if ($_GET['id']==$p){
                            $_SESSION['panier'][$p]++;
                            $k=true;
                        }
                    }}
                    if($k==false){
                        
                        $_SESSION['panier'][$_GET['id']]=1;
                    }
                }
                
                if (isset($_SESSION['countpanier'])) {
                    $_SESSION['countpanier']++;
                }
                else{
                    $_SESSION['countpanier']=1;
                }
                $vue = new Vue("Produit");
                
                $vue->generer(array(
                    "produit" => $this->getProduit()->getProduit($_GET['id']),
                    "panier"=>$_SESSION['panier']
                ));
            }
            else{
            if ($_GET['do'] == "addPanier") {
                $vue = new Vue("Produit");
                $vue->generer(array(
                    "add_panier" => $this->addProduitToPanier($_GET['id']),
                    "produit" => $this->getProduit()->getProduit($_GET['id']),
                    "panier"=> $this->getProduit()->getPanierForUser($_SESSION['userID']),
                    "ligne"=>$this->getProduit()->getLignePanier($this->getProduit()->getPanierForUser($_SESSION['userID'])["panierID"], $_GET['id'])
                ));
            }}
        } else {
            // Erreur
        }
    }}


    /**
     * La fonction qui va s'occuper du panier et toutes les vérifications annexes
     *
     * @param $produitID Id du produit
     */
    public function addProduitToPanier($produitID)
    {
        // Connecté ?
        
        // Est-ce que l'utilisateur a un panier
        $panier = $this->produit->getPanierForUser($_SESSION['userID']);
        if ($panier == null) {
            // insert new panier (soit aucun panier, soit tous sont achetés
            $this->produit->createNewPanier($_SESSION['userID']);
            $panier = $this->produit->getPanierForUser($_SESSION['userID']);
        }
        $ligne_panier = $this->produit->getLignePanier($panier['panierID'], $produitID);
        if ($ligne_panier == null) // pas trouvé de ligne panier pour ce produit
            $ligne_panier = $this->produit->createNewLignePanier($panier['panierID'], $produitID);
        else
            $this->produit->increaseQuantityPanier($ligne_panier['lignePanierID']);

        return true;
    }

}