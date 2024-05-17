<?php
/**
 * User: Guillaume vandierdonck & Qi You
 * Date: 11/2016
 */

require_once('Modele.php');


class Categorie extends Modele
{
        //Constantes
        const ADD_ANNULER=-1;
        const CATEGORIE_ALREADY_EXIST = 1;
        const ERROR_FORM = 2;
        const ADD_OK = 3;
        const DOES_NOT_EXIST = 4;
        const DEL_OK = 5;
        const MODIFY_OK = 6;

  


 /**
     * Retourne toutes les catégories disponibles
     *
     * @return array Un tableau des catégories
     */
    public function getCategories()
    {
        $sql = "SELECT * FROM categorie ,surcategorie WHERE categorie.surcategorieID = surcategorie.surcategorieID ";
        $categories = $this->executerRequete($sql, array());
        if ($categories->rowCount() >= 1)
            return $categories->fetchAll();  // Accès à la première ligne de résultat
    }
    public function getCategorieByID($id)
    {
        $sql = "SELECT * FROM categorie ,surcategorie WHERE categorie.surcategorieID = surcategorie.surcategorieID AND categorie.categorieID=?  ";
        $categories = $this->executerRequete($sql, array($id));
        if ($categories->rowCount() >= 1)
            return $categories->fetchAll();  // Accès à la première ligne de résultat
    }

    public function getCategoriesbysurcategorie($sur)
    {
        $sql = "SELECT * FROM categorie,surcategorie WHERE categorie.surcategorieID = surcategorie.surcategorieID AND surcategorie.surcategorieID = ?";
        $categories = $this->executerRequete($sql, array($sur));
        if ($categories->rowCount() >= 1)
            return $categories->fetchAll();  // Accès à la première ligne de résultat
    }
    public function getsurcategorieBycategorieID($id)
    {
        $sql = "SELECT nomSurcategorie FROM categorie,surcategorie WHERE categorie.surcategorieID = surcategorie.surcategorieID AND categorie.categorieID = ?";
        $categories = $this->executerRequete($sql, array($id));
        if ($categories->rowCount() >= 1)
            return $categories->fetchAll();  // Accès à la première ligne de résultat
    }

    public function categorieExists($name)
    {
        $sql = 'SELECT * FROM categorie WHERE nomCategorie = ?';
        $categorie = $this->executerRequete($sql, array($name));
        if ($categorie->rowCount() >= 1)
            return true;
        else
            return false;
    }
    public function CategorieExistsByID($id)
    {
        $sql = 'SELECT * FROM categorie WHERE categorieID = ?';
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
    public function insertCategorie($nom,$id)
    {
        
        $sql = 'INSERT INTO `categorie` (`nomCategorie`,`descriptionCategorie`,`surcategorieID`) VALUES (?,?,?)';
        $this->executerRequete($sql, array($nom,'',$id));
        
    }
    public function modifyCategorie($nom,$id)
    {
        $sql = "UPDATE categorie SET nomCategorie = ? WHERE categorieID = ?";
        $this->executerRequete($sql, array($nom, $id));
    }

    public function coutCategorie()
    {
        $sql="SELECT count(categorieID) FROM categorie ";
        $categeroie = $this->executerRequete($sql);
        if ($categeroie->rowCount() == 1)
            return $categeroie->fetch();
    }
    
    /**
     * Fonction qui supprime un produit dans la bdd
     *
     * @param $nom : le nom du produit à effacer
     * @return int : le résultat de la fonction
     */
    public function deleteCategorie($id)
    {
        if ($this->CategorieExistsByID($id)) {
            $sql="SET foreign_key_checks = 0";
            $this->executerRequete($sql, array());
            $sql="DELETE p1, p2 FROM categorie p1 JOIN surcategorie p2 ON p2.surcategorieID = p1.surcategorieID WHERE p1.categorieID = ?";
            $this->executerRequete($sql, array($id));
            $sql="SET foreign_key_checks = 1";
            
            $this->executerRequete($sql, array());
            return Categorie::DEL_OK;
        } else
            return Categorie::DOES_NOT_EXIST;
    }
  
}



?> 