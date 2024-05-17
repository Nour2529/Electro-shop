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
require_once 'Model/Modele.php';

class ControleurEditProduit  extends Modele implements Controleur
{
    /**
     * @var Produit
     */
    private $produit;
    /**
     * @var int $produit_code
     */
    private $produit_code;
    private $adminCommande;
    private $data;
    private $edit_produit;
    //Atrribute
    private $editErreur=[
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
    //Test form inputs function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //______________________________________________________________________________________
    /**
     * ControleurProduitList constructor.
     */
    public function __construct()
    {
        $this->produit_code = 0;
        
        $this->produit=new Produit();
        
        

        
    }
    public function getEditErreur()
    {
        return $this->editErreur;
    }
            /**
     * Fonction qui modifie les informations d'un produit
     *
     * @param $nom
     * @param $prix
     * @param $description
     * @param $image
     * @param null $newNom
     * @return int : le résultat de la fonction
     */
    public function modifyProduit($id,$nom, $prix,$solde, $description, $image,$sur_categorie,$categorie, $sous_categorie,$stock,$post)
    {

        

            if ($nom != null) {
                $nom=$this->test_input($nom);
                $sql = "UPDATE produit SET nomProduit = ? WHERE produitID = ?";
                $this->executerRequete($sql, array($nom,$id));
            }else
            {
                $this->editErreur['nomProduit']="Nom de produit est obligatoire";
                $this->countErreur++;
            }
            if (!empty($prix)) {
                if (is_numeric($prix)) {
                    $sql = "UPDATE produit SET prix = ? WHERE produitID = ?";
                    $this->executerRequete($sql, array($prix, $id));
                }
            } else{
                $this->editErreur['prix']='Prix est obligatoire'; 
                $this->countErreur++;  
            }  
            if (!empty($solde)) {
                if (is_numeric($solde)) {
                    $sql = "UPDATE produit SET Solde = ? WHERE produitID = ?";
                    $this->executerRequete($sql, array($solde, $id));
                } 
                else{
                    $this->editErreur['solde']='La remise doit etre numerique'; 
                    $this->countErreur++;  
                }       
            }
            if (!empty($stock)) {
                if (is_numeric($stock)) {
                    $sql = "UPDATE produit SET Stock = ? WHERE produitID = ?";
                    $this->executerRequete($sql, array($stock, $id));
                }
            } else{
                $this->editErreur['qte']='La quantite est obligatoire';   
                $this->countErreur++;
            }  
            if (!empty($description)) {
                $description=$this->test_input($description);
                $sql = "UPDATE produit SET description = ? WHERE produitID = ?";
                $this->executerRequete($sql, array($description, $id));
            }else{
                $this->editErreur['des']='La description est obligatoire'; 
                $this->countErreur++;
            }
            if ($image['name']!='') {
                
                if($this->uploadPicture($post,$image)!=0)
                {
                    $sql = "UPDATE produit SET cheminimage = ? WHERE produitID = ?";
                    $this->executerRequete($sql, array('images/Produit/'.basename($image["name"]), $id));
                }else
                {
                    $this->countErreur++;
                }
                
                
                
            }
            if($sur_categorie!=0)
            {
                if($categorie!=0)
                {
                    if($sous_categorie!=0)
                    {
                        $sql = "UPDATE produit SET sousCategorieID = ? WHERE produitID = ?";
                        $this->executerRequete($sql, array($sous_categorie, $id));
                    }
                    else{
                        $this->editErreur['nvSurCat']='Nouvelle Surcategorie  est obligatoire';  
                        $this->editErreur['nvSousCat']='Nouvelle Souscategorie  est obligatoire';
                        $this->editErreur['nvCat']='Nouvelle categorie  est obligatoire';  
                        $this->countErreur++;
                    }
                    
                }
                else{
                    $this->editErreur['nvSurCat']='Nouvelle Surcategorie  est obligatoire';  
                    $this->editErreur['nvSousCat']='Nouvelle Souscategorie  est obligatoire';
                    $this->editErreur['nvCat']='Nouvelle categorie  est obligatoire';
                    $this->countErreur++;
                }
            }
            if($this->countErreur==0)
            {
                $_SESSION['edit']="Produit modifié";
                return Produit::MODIFY_OK;
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
        $this->editErreur['nvImage']=$msg;
        return $uploadOk ;
    }   



   

    //______________________________________________________________________________________
    /**
     * Fonction qui ajoute un produit
     */
    public function editProduit()
    {
       
            
        $this->produit_code=$this->modifyProduit($_GET['idproduit'],$_POST['nomProduit'],$_POST['prixProduit'],$_POST['solde'],$_POST['description'],$_FILES["img"],$_POST['surcategorieID'],$_POST['categorieID'],$_POST['souscategorieID'],$_POST['qteProduit'],isset($_POST['edit']));
            
        
    }




    public function getHTML(){
        
        $this->edit_produit=$this->produit->getProduit($_GET['idproduit']);
        $this->data=[
            'produitID'=>$this->edit_produit['produitID'],
            'nomProduit'=>$this->edit_produit['nomProduit'],
            'prix'=>$this->edit_produit['prix'],
            'Solde'=>$this->edit_produit['Solde'],
            'description'=>$this->edit_produit['description'],
            'cheminimage'=>$this->edit_produit['cheminimage'],
            'Stock'=>$this->edit_produit['Stock'],
            'nomCategorie'=>$this->edit_produit['nomCategorie'],
            'nomSurcategorie'=>$this->edit_produit['nomSurcategorie'],
            'nomSousCategorie'=>$this->edit_produit['nomSousCategorie'],

            
        ];

        if(isset($_POST['annuler'])){
            $this->produit_code = -1;
        }
    
        if(isset($_POST['edit'])){
            
            $this->data['nomProduit']=$_POST['nomProduit'];
            $this->data['prix']=$_POST['prixProduit'];
            $this->data['Solde']=$_POST['solde'];
            $this->data['description']=$_POST['description'];

            $this->data['Stock']=$_POST['qteProduit'];
            
            $this->editProduit();
            
        }
        $vue = new Vue("EditProduit");
        $vue->generer(array('SurCategories' => $this->produit->getsurCategories(),'Categories' => $this->produit->getCategories(),'produit_code' => $this->produit_code,'Produit'=>$this->data,'erreur'=>$this->getEditErreur()));
        
    }
}



