<?php
/**
 * User: Guillaume vandierdonck & Qi You
 * Date: 11/2016
 */

require_once('Modele.php');


class SurCategorie extends Modele
{
        //Constantes
        const ADD_ANNULER=-1;
        const SURCATEGORIE_ALREADY_EXIST = 1;
        const ERROR_FORM = 2;
        const ADD_OK = 3;
        const DOES_NOT_EXIST = 4;
        const DEL_OK = 5;
        const MODIFY_OK = 6;

  


    public function getsurCategories()
    {
        $sql = "SELECT * FROM surcategorie";
        $surcategories = $this->executerRequete($sql, array());
        if ($surcategories->rowCount() >= 1)
            return $surcategories->fetchAll();  
    // Accès à la première ligne de résultat
    }
    public function getsurCategorie($id)
    {
        $sql = 'SELECT surcategorieID,nomSurcategorie FROM surcategorie where surcategorieID = ?';
        $surcategories = $this->executerRequete($sql, array($id));
        if ($surcategories->rowCount() >= 1)
            return $surcategories->fetchAll();  
    // Accès à la première ligne de résultat
    }

    public function coutSurCategorie()
    {
        $sql="SELECT count(surcategorieID) FROM surcategorie ";
        $surcategeroie = $this->executerRequete($sql);
        if ($surcategeroie->rowCount() == 1)
            return $surcategeroie->fetch();
    }

    public function surCategorieExists($name)
    {
        $sql = 'SELECT * FROM surcategorie WHERE nomSurcategorie = ?';
        $surcategorie = $this->executerRequete($sql, array($name));
        if ($surcategorie->rowCount() >= 1)
            return true;
        else
            return false;
    }
    public function surCategorieExistsByID($id)
    {
        $sql = 'SELECT * FROM surcategorie WHERE surcategorieID = ?';
        $surcategorie = $this->executerRequete($sql, array($id));
        if ($surcategorie->rowCount() >= 1)
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
    public function insertSurCategorie($nom)
    {
        
        $sql = 'INSERT INTO `surcategorie` (`nomSurcategorie`) VALUES (?)';
        $this->executerRequete($sql, array($nom));
        
    }
    public function modifySurCategorie($nom,$id)
    {
        $sql = "UPDATE surcategorie SET nomSurcategorie = ? WHERE surcategorieID = ?";
        $this->executerRequete($sql, array($nom, $id));
    }
    public function deleteSousCategorie($id)
    {
        if ($this->SousCategorieExistsByID($id)) {
            $sql="SET foreign_key_checks = 0";
            $this->executerRequete($sql, array());
            $sql="DELETE p1, p2 FROM produit p1 JOIN souscategorie p2 ON p2.sousCategorieID = p1.sousCategorieID WHERE p2.sousCategorieID = ?";
            $this->executerRequete($sql, array($id));
            $sql="SET foreign_key_checks = 1";
            
            $this->executerRequete($sql, array());
            return SousCategorie::DEL_OK;
        } else
            return SousCategorie::DOES_NOT_EXIST;
    }
    
    /**
     * Fonction qui supprime un produit dans la bdd
     *
     * @param $nom : le nom du produit à effacer
     * @return int : le résultat de la fonction
     */
    public function deleteSurCategorie($id)
    {
        if ($this->surCategorieExistsByID($id)) {
            $this->deleteSousCategorie($id);
            $sql="SET foreign_key_checks = 0";
            $this->executerRequete($sql, array());
            $sql="DELETE p1, p2 FROM surcategorie p1 JOIN categorie p2 ON p2.surcategorieID = p1.surcategorieID WHERE p1.surcategorieID = ?";
            $this->executerRequete($sql, array($id));
            $sql="SET foreign_key_checks = 1";
            return SurCategorie::DEL_OK;
        } else
            return SurCategorie::DOES_NOT_EXIST;
    }
  
}



?> 