<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/Categorie.php';
require_once 'Model/SousCategorie.php';



class ControleurOperationSousCategorie implements Controleur
{
    /**
     * @var categorie
     */
    private $souscategorie;
    private $souscategorie_code;
    private $countErreur=0;


    private $souscategorieErreur=[
        'Cat'=>'',
        'NvSousCat'=>'',

    ];

    //______________________________________________________________________________________
    /**
     * ControleurSurCategorie constructor.
     */
    public function __construct()
    {
        $this->souscategorie = new SousCategorie();
        $this->categorie = new Categorie();
        $this->souscategorie_code = 0;
        
    }
    //Test form inputs function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
  

    public function addSousCategorie()
    {
        if($_POST['categorieID']==0)
        {
            $this->souscategorieErreur['Cat']="La Categorie est obligatoire ";
            $this->countErreur++;
        }
        
        if($_POST['souscategorie']=='')
        {
            $this->souscategorieErreur['NvSousCat']="La SousCategorie est obligatoire ";
            $this->countErreur++;

        }else{
            if($this->souscategorie->SousCategorieExists($_POST['souscategorie']))
            {
                $this->souscategorieErreur['NvSousCat']="La SousCategorie existe ";
                $this->souscategorie_code=Categorie::SOUSCATEGORIE_ALREADY_EXIST;
                $this->countErreur++;
            }
        }
        if($this->countErreur==0)
        {
            
            $this->souscategorie->insertSousCategorie($_POST['souscategorie'],$_POST['categorieID']);
            $_SESSION['add_souscategorie']="SousCategorie ajouté !";
            return  SousCategorie::ADD_OK;
        }
        else{
            return SousCategorie::ERROR_FORM;
        }

    }
    public function editSousCategorie()
    {
        if($_POST['souscategorie']!=''){
          
            $this->souscategorie->modifySousCategorie($_POST['souscategorie'],$_GET['idsouscategorie']);
            $this->souscategorie_code=SousCategorie::MODIFY_OK;
            $_SESSION['edit_souscategorie']="SousCategorie modifié !";
        }
        else{
            $this->souscategorie_code=SousCategorie::ERROR_FORM;
            $this->souscategorieErreur['NvSousCat']="La SousCategorie est obligatoire ";
        }
    }

    
    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML(){
    
        if($_GET['type']=='add'){
            $data='';
            if(isset($_POST['add']))
            {
                $_POST['souscategorie']=$this->test_input($_POST['souscategorie']);
                $data=$_POST['souscategorie'];
                $this->souscategorie_code=$this->addSousCategorie();
                
            }
            $vue = new Vue("AddSousCategorie");
                
    
            $vue->generer(array('SousCategorie' => $data,'Categories' => $this->categorie->getCategories(),'souscategorie_code' => $this->souscategorie_code ,'erreur'=>$this->souscategorieErreur));
        }



        if($_GET['type']=='edit'){
            if($this->souscategorie->SousCategorieExistsByID($_GET['idsouscategorie']))
            {
                $categorie=$this->souscategorie->getCategoriesbySousCategorie($_GET['idsouscategorie']);

                $data=$this->souscategorie->getSousCategorieByID($_GET['idsouscategorie']);
                $data=$data[0]['nomSousCategorie'];
                
                if(isset($_POST['edit']))
                {
                    $_POST['souscategorie']=$this->test_input($_POST['souscategorie']);
                    $data=$_POST['souscategorie'];
                    $this->editSousCategorie();
                    
                }
                    
                $vue = new Vue("EditSousCategorie");
                $vue->generer(array('Categorie'=>$categorie,'SousCategorie'=>$data,'souscategorie_code'=> $this->souscategorie_code ,'erreur'=>$this->souscategorieErreur));
            }
            

        }
        
        
    }

}