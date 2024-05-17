<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/SurCategorie.php';
require_once 'Model/Categorie.php';



class ControleurOperationCategorie implements Controleur
{
    /**
     * @var categorie
     */
    private $categorie;
    private $categorie_code;
    private $countErreur=0;


    private $categorieErreur=[
        'SurCat'=>'',
        'NvCat'=>'',

    ];

    //______________________________________________________________________________________
    /**
     * ControleurSurCategorie constructor.
     */
    public function __construct()
    {
        $this->categorie = new Categorie();
        $this->surcategorie = new SurCategorie();
        $this->categorie_code = 0;
        
    }
    //Test form inputs function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
  

    public function addCategorie()
    {
        if($_POST['surcategorieID']==0)
        {
            $this->categorieErreur['SurCat']="La SurCategorie est obligatoire ";
            $this->countErreur++;
        }
        
        if($_POST['categorie']=='')
        {
            $this->categorieErreur['NvCat']="La Categorie est obligatoire ";
            $this->countErreur++;

        }else{
            if($this->categorie->CategorieExists($_POST['categorie']))
            {
                $this->categorieErreur['NvCat']="La Categorie existe ";
                $this->categorie_code=Categorie::CATEGORIE_ALREADY_EXIST;
                $this->countErreur++;
            }
        }
        if($this->countErreur==0)
        {
            
            $this->categorie->insertCategorie($_POST['categorie'],$_POST['surcategorieID']);
            $_SESSION['add_categorie']="Categorie ajouté !";
            return Categorie::ADD_OK;
        }
        else{
            return Categorie::ERROR_FORM;
        }

    }
    public function editCategorie()
    {
        if($_POST['categorie']!=''){
          
            $this->categorie->modifyCategorie($_POST['categorie'],$_GET['idcategorie']);
            $this->categorie_code=Categorie::MODIFY_OK;
            $_SESSION['edit_categorie']="Categorie modifié !";
        }
        else{
            $this->categorie_code=Categorie::ERROR_FORM;
            $this->categorieErreur['NvCat']="La Categorie est obligatoire ";
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
                $_POST['categorie']=$this->test_input($_POST['categorie']);
                $data=$_POST['categorie'];
                $this->categorie_code=$this->addCategorie();
                
            }
            $vue = new Vue("AddCategorie");
                
    
            $vue->generer(array('Categorie' => $data,'SurCategories' => $this->surcategorie->getsurCategories(),'categorie_code' => $this->categorie_code ,'erreur'=>$this->categorieErreur));
        }



        if($_GET['type']=='edit'){
            if($this->categorie->CategorieExistsByID($_GET['idcategorie']))
            {
                $surCategorie=$this->categorie->getsurcategorieBycategorieID($_GET['idcategorie']);

                $data=$this->categorie->getCategorieByID($_GET['idcategorie']);
                $data=$data[0]['nomCategorie'];
                
                if(isset($_POST['edit']))
                {
                    $_POST['categorie']=$this->test_input($_POST['categorie']);
                    $data=$_POST['categorie'];
                    $this->editCategorie();
                    
                }
                    
                $vue = new Vue("EditCategorie");
                $vue->generer(array('SurCategorie'=>$surCategorie,'Categorie'=>$data,'categorie_code'=> $this->categorie_code ,'erreur'=>$this->categorieErreur));
            }
            

        }
        
        
    }

}