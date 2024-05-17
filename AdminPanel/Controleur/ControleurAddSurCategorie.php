<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/SurCategorie.php';


class ControleurAddSurCategorie implements Controleur
{
    /**
     * @var surcategorie
     */
    private $surcategorie;
    private $surcategorie_code;


    private $surcategorieErreur=[
        'SurCat'=>'',
        'NvSurCat'=>'',

    ];

    //______________________________________________________________________________________
    /**
     * ControleurSurCategorie constructor.
     */
    public function __construct()
    {
        $this->surcategorie = new SurCategorie();
        $this->surcategorie_code = 0;
        
    }
    //Test form inputs function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
  

    public function addSurCategorie()
    {
        if($_POST['surcategorie']!='')
        {
            if($this->surcategorie->surCategorieExists($_POST['surcategorie']))
            {
                $this->surcategorieErreur['SurCat']="La SurCategorie existe ";
                $this->surcategorie_code=SurCategorie::ERROR_FORM;
            }else{
                $this->surcategorie->insertSurCategorie($_POST['surcategorie']);
                $this->surcategorie_code=SurCategorie::ADD_OK;
                $_SESSION['add_surcategorie']="SurCategorie ajouté !";
            }
        }
        else{
            $this->surcategorie_code=SurCategorie::ERROR_FORM;
            $this->surcategorieErreur['SurCat']="La SurCategorie est obligatoire ";
        }
    }
    public function editSurCategorie()
    {
        if($_POST['nvsurcategorie']!=''){
            $_POST['nvsurcategorie']=$this->test_input($_POST['nvsurcategorie']);
            $this->surcategorie-> modifySurCategorie($_POST['nvsurcategorie'],$_GET['idsurcategorie']);
            $this->surcategorie_code=SurCategorie::MODIFY_OK;
            $_SESSION['edit_surcategorie']="SurCategorie modifié !";
        }
        else{
            $this->surcategorie_code=SurCategorie::ERROR_FORM;
            $this->surcategorieErreur['NvSurCat']="La SurCategorie est obligatoire ";
        }
    }

    
    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML(){
    
        if($_GET['param']=='add'){
            if(isset($_POST['add'])){
                $this->addSurCategorie();
            }
               
            
            $vue = new Vue("AddSurCategorie");
                
    
            $vue->generer(array('SurCategories' => $this->surcategorie->getsurCategories(),'surcategorie_code' => $this->surcategorie_code ,'erreur'=>$this->surcategorieErreur));
        }
        if($_GET['param']=='edit'){
            if($this->surcategorie->surCategorieExistsByID($_GET['idsurcategorie']))
            {
                $data=$this->surcategorie->getsurCategorie($_GET['idsurcategorie']);
                if(isset($_POST['edit'])){
                    $data[0]['nomSurcategorie']=$_POST['nvsurcategorie'];
                    $this->editSurCategorie();
                }
                
                $vue = new Vue("EditSurCategorie");
                $vue->generer(array('SurCategorie'=>$data ,'surcategorie_code' => $this->surcategorie_code ,'erreur'=>$this->surcategorieErreur));
            }
            

        }
        
        
    }

}