<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/Produit.php';

class ControleurProduit implements Controleur
{
    /**
     * @var Produit
     */
    private $produit;
    private $produit_code;



    //______________________________________________________________________________________
    /**
     * ControleurProduit constructor.
     */
    public function __construct()
    {
        $this->produit = new Produit();
        $this->produit_code = 0;
        
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
    public function getHTML(){
    
        if(isset($_POST["delete"]))
        {
            $this->produit_code=$this->produit->deleteProduit($_POST["id"]);
            if($this->produit_code==Produit::DEL_OK)
            {
                $_SESSION['delete']="Produit supprimé !";
            }
            
            
        }
        

            
        
            $vue = new Vue("Produit");
            

            $vue->generer(array('Produit' => $this->produit->getAllProduit(),'produit_code' => $this->produit_code));
        
        
        

    }

}



