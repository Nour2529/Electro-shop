<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/Categorie.php';

class ControleurCategorie implements Controleur
{
    /**
     * @var Categorie
     */
    private $categorie;
    private $categorie_code;



    //______________________________________________________________________________________
    /**
     * ControleurSurCategorie constructor.
     */
    public function __construct()
    {
        $this->categorie = new Categorie();
        $this->categorie_code = 0;
        
    }

    

    
    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML(){
    
        
        

        if(isset($_POST["delete"]))
        {
            $this->categorie_code=$this->categorie->deleteCategorie($_POST["id"]);
            if($this->categorie_code==Categorie::DEL_OK)
            {
                $_SESSION['delete_categorie']="Categorie supprimé !";
            }
            
            
        }
        
            $vue = new Vue("Categorie");
            

            $vue->generer(array('Categories' => $this->categorie->getCategories(),'categorie_code' => $this->categorie_code));
        
    }

}