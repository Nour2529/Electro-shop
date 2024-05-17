<?php

require_once('Modele.php');


class SousCategorie extends Modele
{
        //Constantes
        const ADD_ANNULER=-1;
        const SOUSCATEGORIE_ALREADY_EXIST = 1;
        const ERROR_FORM = 2;
        const ADD_OK = 3;
        const DOES_NOT_EXIST = 4;
        const DEL_OK = 5;
        const MODIFY_OK = 6;

  


    public function getsousCategories()
    {
        $sql = "SELECT * FROM souscategorie ,categorie WHERE souscategorie.categorieID = categorie.categorieID";
        $souscategories = $this->executerRequete($sql, array());
        if ($souscategories->rowCount() >= 1)
            return $souscategories->fetchAll();  // Accès à la première ligne de résultat
    }
    public function getSousCategorieByID($id)
    {
        $sql = "SELECT * FROM souscategorie WHERE souscategorie.sousCategorieID=?  ";
        $souscategories = $this->executerRequete($sql, array($id));
        if ($souscategories->rowCount() >= 1)
            return $souscategories->fetchAll();  // Accès à la première ligne de résultat
    }
    public function coutSousCategorie()
    {
        $sql="SELECT count(sousCategorieID) FROM souscategorie ";
        $souscategeroie = $this->executerRequete($sql);
        if ($souscategeroie->rowCount() == 1)
            return $souscategeroie->fetch();
    }

    public function getCategoriesbySousCategorie($id)
    {
        $sql = "SELECT nomCategorie FROM categorie,souscategorie WHERE souscategorie.categorieID = categorie.categorieID AND souscategorie.sousCategorieID= ?";
        $categories = $this->executerRequete($sql, array($id));
        if ($categories->rowCount() >= 1)
            return $categories->fetchAll();  // Accès à la première ligne de résultat
    }
   

    public function souscategorieExists($name)
    {
        $sql = 'SELECT * FROM souscategorie WHERE nomSousCategorie = ?';
        $categorie = $this->executerRequete($sql, array($name));
        if ($categorie->rowCount() >= 1)
            return true;
        else
            return false;
    }
    public function SousCategorieExistsByID($id)
    {
        $sql = 'SELECT * FROM souscategorie WHERE sousCategorieID = ?';
        $categorie = $this->executerRequete($sql, array($id));
        if ($categorie->rowCount() >= 1)
            return true;
        else
            return false;
    }
     /**
     * Fonction qui ajoute une SurCategorie dans la bdd
     *
     * @param $nom
    
     */
    public function insertSousCategorie($nom,$id)
    {
        
        $sql = 'INSERT INTO `souscategorie` (`nomSousCategorie`,`descriptionSousCategorie`,`categorieID`) VALUES (?,?,?)';
        $this->executerRequete($sql, array($nom,'',$id));
        
    }
    public function modifySousCategorie($nom,$id)
    {
        $sql = "UPDATE souscategorie SET nomSousCategorie = ? WHERE sousCategorieID = ?";
        $this->executerRequete($sql, array($nom, $id));
    }
    
    /**
     * Fonction qui supprime un produit dans la bdd
     *
     * @param $nom : le nom du produit à effacer
     * @return int : le résultat de la fonction
     */
    public function deleteSousCategorie($id)
    {
        if ($this->SousCategorieExistsByID($id)) {
            $sql="SET foreign_key_checks = 0";
            $this->executerRequete($sql, array());
            $sql="DELETE p1, p2 FROM produit p1 JOIN souscategorie p2 ON p2.sousCategorieID = p1.sousCategorieID WHERE p2.sousCategorieID = ?";
            if($this->executerRequete($sql, array($id)));
            $sql="SET foreign_key_checks = 1";
            
            $this->executerRequete($sql, array());
            return SousCategorie::DEL_OK;
        } else
            return SousCategorie::DOES_NOT_EXIST;
    }
  
}



?> 