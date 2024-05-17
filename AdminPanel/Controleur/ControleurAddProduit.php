<?php
/**
 * User: Guillaume vandierdonck & Qi You
 * Date: 11/2016
 */

//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/Produit.php';

class ControleurAddProduit implements Controleur
{
    /**
     * @var Produit
     */
    private $produit;
    /**
     * @var int $produit_code
     */
    private $produit_code;

    private $data;

      //Atrribute
      private $addErreur=[
        'nomProduit'=>'',
        'nvSurCat'=>'',
        'nvCat'=>'',
        'nvSousCat'=>'',
        'des'=>'',
        'qte'=>'',
        'prix'=>'',
        'solde'=>'',
        'nvImage'=>''
    ];
    private $countErreur=0;
    //______________________________________________________________________________________
    /**
     * ControleurProduitList constructor.
     */
    public function __construct()
    {
        $this->produit_code = 0;
        $this->produit = new Produit();

        
    }

    //Test form inputs function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    //______________________________________________________________________________________
    /**
     * Fonction qui ajoute un produit
     */
    public function verifieInsertion()
    {
        
        if ($_POST['nomProduit'] != null) {
            $_POST['nomProduit']=$this->test_input($_POST['nomProduit']);

        }else
        {
            $this->addErreur['nomProduit']="Nom de produit est obligatoire";
            $this->countErreur++;
        }
        if (empty($_POST['prixProduit'])) {
            
        
                $this->addErreur['prix']='Prix est obligatoire'; 
                $this->countErreur++; 
            
        }  
        if (empty($_POST['solde'])) {
            
                $this->addErreur['solde']='La remise est obligatoire'; 
                $this->countErreur++;  
             
        }
        if (empty($_POST['qteProduit'])) {
            
            $this->addErreur['qte']='La quantite est obligatoire';   
            $this->countErreur++;
        }  
        if (!empty($_POST['description'])){
            $_POST['description']=$this->test_input($_POST['description']);
        }else{
            $this->addErreur['des']='La description est obligatoire'; 
            $this->countErreur++;
        }
        if ($_FILES["cheminimage"]['name']!='') {
            $image=$_FILES["cheminimage"];
            
            if($this->uploadPicture(isset($_POST['add']),$image)==0){
                $this->countErreur++ ;}  
        }else{
            $this->countErreur++;
            $this->addErreur['nvImage']="L'image est obligatoire";
        }
        if($_POST['surcategorieID']!=0)
        {
            if($_POST['categorieID']!=0)
            {
                if($_POST['souscategorieID']!=0)
                {
                    echo "categorie selectionner";
                }
                else{
                    $this->addErreur['nvSurCat']='Nouvelle Surcategorie  est obligatoire';  
                    $this->addErreur['nvSousCat']='Nouvelle Souscategorie  est obligatoire';
                    $this->addErreur['nvCat']='Nouvelle categorie  est obligatoire';  
                    $this->countErreur++;
                }
                
            }
            else{
                $this->addErreur['nvSurCat']='Nouvelle Surcategorie  est obligatoire';  
                $this->addErreur['nvSousCat']='Nouvelle Souscategorie  est obligatoire';
                $this->addErreur['nvCat']='Nouvelle categorie  est obligatoire';
                $this->countErreur++;
            }
        }else{
            $this->addErreur['nvSurCat']='Nouvelle Surcategorie  est obligatoire';  
            $this->addErreur['nvSousCat']='Nouvelle Souscategorie  est obligatoire';
            $this->addErreur['nvCat']='Nouvelle categorie  est obligatoire';
            $this->countErreur++;
        }
        if($this->countErreur==0)
        {
            $_SESSION['add']="Produit ajouté !";
            return Produit::ADD_OK;
        }
        else{
            return Produit::ERROR_FORM;
        }
    }
    


      /** Enregistre une image sur le serveur et change le chemin de l'image de l'utilisateur
     *
     * @param file $fichier L'image à télécharger
     * 
     */
    private function uploadPicture($post,$image)
    {
        $msg='';
        $target_dir = "images/Produit/";
        $target_file = $target_dir . $image["name"];
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $msg= ' $FILES : ' . $image["name"] . '||';

        // Check if image file is a actual image or fake image
        if ($post==true) {
            $check = getimagesize($image["tmp_name"]);
            if ($check !== false) {
                $msg= "Fichier n'est pas une image- " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $msg= "Fichier n'est pas une image.";
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($image["size"] > 500000) {
            $msg= "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $msg= "Selectionnez une image de type JPG, JPEG, PNG ou GIF  ";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {
        
            
            
            $file_titre = $target_dir .$image["name"] ;
            if (move_uploaded_file($image["tmp_name"], $file_titre)) {
                // on met a jour la bdd
                $msg= " file titre : " . $file_titre;
                
                $msg= "L'image " . basename($image["name"]) . " est telecharge";
            } else {
                $msg= "Il y 'a une erreur dans le telechargement du fichier.";
            }
        }
        $this->addErreur['nvImage']=$msg;
        return $uploadOk ;
        
    }
    public function addProduit()
    {
        if ($this->produit->produitExists($_POST['nomProduit']))
        {
            $this->produit_code =Produit::PRODUCT_ALREADY_EXIST;
        }
        else{
            $this->produit_code=$this->verifieInsertion();
            {
                if($this->produit_code==Produit::ADD_OK)
                {
                    $this->produit->insertProduit($_POST['nomProduit'],$_POST['prixProduit'],$_POST['solde'],$_POST['description'],'images/Produit/'.$_FILES['cheminimage']['name'],$_POST['souscategorieID'],$_POST['qteProduit']);
                }
            }
            
        }
    }

  
    public function getHTML(){

        $this->data=[
            'nomProduit'=>'',
            'prix'=>'',
            'Solde'=>'',
            'description'=>'',
            'Stock'=>'',
            
            
        ];
        $vue = new Vue("AddProduit");
        if(isset($_POST['add'])){
            $this->data['nomProduit']=$_POST['nomProduit'];
            $this->data['prix']=$_POST['prixProduit'];
            $this->data['Solde']=$_POST['solde'];
            $this->data['description']=$_POST['description'];

            $this->data['Stock']=$_POST['qteProduit'];
            $this->addProduit();
        }
        if(isset($_POST['annuler'])){
            $this->produit_code = -1;
        }
        $vue->generer(array('SurCategories' => $this->produit->getsurCategories(),'Categories' => $this->produit->getCategories(),'produit_code' => $this->produit_code ,'Produit'=>$this->data,'erreur'=>$this->addErreur));
        
    }
}



