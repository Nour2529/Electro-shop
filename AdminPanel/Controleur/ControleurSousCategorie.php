<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/SousCategorie.php';

class ControleurSousCategorie implements Controleur
{
    /**
     * @var SousCategorie
     */
    private $souscategorie;
    private $souscategorie_code;



    //______________________________________________________________________________________
    /**
     * ControleurSurCategorie constructor.
     */
    public function __construct()
    {
        $this->souscategorie = new SousCategorie();
        $this->souscategorie_code = 0;
        
    }

    

    
    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML(){
    
        
        

        if(isset($_POST["delete"]))
        {
            $this->souscategorie_code=$this->souscategorie->deleteSousCategorie($_POST["id"]);
            if($this->souscategorie_code==SousCategorie::DEL_OK)
            {
                $_SESSION['delete_souscategorie']="SousCategorie supprimé !";
            }
            
            
        }
        
            $vue = new Vue("SousCategorie");
            

            $vue->generer(array('SousCategories' => $this->souscategorie->getSousCategories(),'souscategorie_code' => $this->souscategorie_code));
        
    }

}