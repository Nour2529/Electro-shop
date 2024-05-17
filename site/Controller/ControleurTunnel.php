<?php

/**
 * User: Francis Polaert & Kévin Noet
 * Date: 04/11/2016
 */
//________________________________________________________________________________________
// Require once
require_once('Controleur.php');
require_once('Vue/Vue.php');

class ControleurTunnel implements Controleur
{private $produit;
    private $userLogin;
    //______________________________________________________________________________________
    /**
     * ControleurTunnel constructor.
     */
    public function __construct()
    {
        $this->produit = new Produit();
        $this->userLogin = new UserLogin();
    }


    //______________________________________________________________________________________
    /**
     * Affiche la page tunnel
     */
    public function getHTML()
    {
        $vue = new Vue("Tunnel");
        $vue->generer(array());
    }
    public function addquntiter(){
        if (empty($_SESSION['userID'])) {
            if(isset($_GET['page'])){
                if($_GET['quantite']=="plus"){
                    
                $_SESSION['panier'][$_GET["id"]]=$_GET['q']+1;
                $_SESSION['countpanier']=$_SESSION['countpanier']+1;
                }
                else{
                    
                $_SESSION['panier'][$_GET["id"]]=$_GET['q']-1;
                $_SESSION['countpanier']=$_SESSION['countpanier']-1;
                if($_SESSION['panier'][$_GET["id"]]==0) {
                    unset($_SESSION['panier'][$_GET["id"]]);
                }
                
                }
                header('Location: index.php?action=productCategorie&id='.$_GET["id"]);
                die();
            }
            else{

            $_SESSION['panier'][$_GET["id"]]=$_GET["quantite"];
            $_SESSION['countpanier']=$_SESSION['countpanier']-$_GET['q']+$_GET['quantite'];
            header('Location: index.php?action=tunnel');
            die();
        }
        }
        else{
            $panier=$this->produit->getPanierForUser($_SESSION['userID']);
            $lignepanier=$this->produit->getLignePanier($panier["panierID"],$_GET["id"]);
            if(isset($_GET['page'])){
                if($_GET['quantite']=="plus"){
                    
                    $this->produit->increaseQuantityPanier($lignepanier["lignePanierID"],1);
                    $_SESSION['countpanier']=$_SESSION['countpanier']+1;
                    }
                    else{
                        
                    $this->produit->dicreaseQuantityPanier($lignepanier["lignePanierID"],1);
                    $_SESSION['countpanier']=$_SESSION['countpanier']-1;
                    if($lignepanier['quantité']==1) {
                        $this->produit->supprimerligne($lignepanier["lignePanierID"]);
                    }
                    
                    }
                    header('Location: index.php?action=productCategorie&id='.$_GET["id"]);
                    die();
            }
            else{
            
            
            $this->produit->updateQuantityPanier($lignepanier["lignePanierID"],$_GET['quantite']);
            $_SESSION['countpanier']=$_SESSION['countpanier']-$_GET['q']+$_GET['quantite'];
            header('Location: index.php?action=tunnel');
            die();
        }}
        
    }
    
    public function supprimer(){
        if (empty($_SESSION['userID'])) {
            unset($_SESSION['panier'][$_GET["id"]]);
            $_SESSION['countpanier']-=$_GET['q'];
    }
    else{
        $panier=$this->produit->getPanierForUser($_SESSION['userID']);
        $lignepanier=$this->produit->getLignePanier($panier["panierID"],$_GET["id"]);
        $this->produit->supprimerligne($lignepanier["lignePanierID"]);
        $_SESSION['countpanier']-=$_GET['q'];
    }
    header('Location: index.php?action=tunnel');
            die();
    }
}