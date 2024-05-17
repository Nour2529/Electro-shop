<?php
/**
 * User: Guillaume vandierdonck & Qi You
 * Date: 11/2016
 */

//________________________________________________________________________________________
// Require once
require_once 'Controller/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/Produit.php';

class ControleurProduitList implements Controleur
{
    /**
     * @var Produit
     */
    private $produit;


    //______________________________________________________________________________________
    /**
     * ControleurProduitList constructor.
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
     * Setter du produit
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
                if(isset($_GET['page']) && !empty($_GET['page'])){
                    $currentPage = (int) strip_tags($_GET['page']);
                }else{
                    $currentPage = 1;
                }
                $nbArticles=$this->produit->countall($_GET["min"],$_GET["max"]);
                if($_GET["show"]==0){
                    $parPage = 9;
                }elseif($_GET["show"]==1){
                    $parPage = 18;
                }
                $pages = ceil($nbArticles / $parPage);
                $premier = ($currentPage * $parPage) - $parPage;
            $ProduitList=$this->produit->getcategoriebyfiltre($_GET["min"],$_GET["max"],$_GET["sort"],$parPage,$premier);
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

            
        }else
        {
        $vue = new Vue("ProduitList");
        $vue->generer(array('ProduitList' => $this->produit->getcategoriebyfiltre(0,10000,0,9,0),
        'nbArticles'=>$this->produit->countall(0,10000),'pages'=>ceil($this->produit->countall(0,10000) / 9),"currentPage" => 1,
        'surcategories'=>$this->produit->counttoutsurcategorie(),'test' => 'all'));
    }
}


}
