<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/SurCategorie.php';

class ControleurSurCategorie implements Controleur
{
    /**
     * @var Surcategorie
     */
    private $surcategorie;
    private $surcategorie_code;



    //______________________________________________________________________________________
    /**
     * ControleurSurCategorie constructor.
     */
    public function __construct()
    {
        $this->surcategorie = new SurCategorie();
        $this->surcategorie_code = 0;
        
    }

    

    
    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML(){
    
        
        

        if(isset($_POST["delete"]))
        {
            $this->surcategorie_code=$this->surcategorie->deleteSurCategorie($_POST["id"]);
            if($this->surcategorie_code==SurCategorie::DEL_OK)
            {
                $_SESSION['delete_surcategorie']="SurCategorie supprimé !";
            }
            
            
        }
        
            $vue = new Vue("SurCategorie");
            

            $vue->generer(array('SurCategorie' => $this->surcategorie->getsurCategories(),'surcategorie_code' => $this->surcategorie_code));
        
    }

}