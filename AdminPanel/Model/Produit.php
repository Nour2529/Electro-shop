<?php

require_once('Modele.php');


class Produit extends Modele
{
        //Constantes
        const ADD_ANNULER=-1;
        const PRODUCT_ALREADY_EXIST = 1;
        const ERROR_FORM = 2;
        const ADD_OK = 3;
        const DOES_NOT_EXIST = 4;
        const DEL_OK = 5;
        const MODIFY_OK = 6;

    /** Renvoie les informations sur un utillisateurs
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getProduit($produitID)
    {
        $sql = 'select produitID, nomProduit, prix, Solde, description, cheminimage, Date ,Stock,nomCategorie, nomSurcategorie ,nomSousCategorie FROM produit, categorie , souscategorie,surcategorie WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID AND produitID=?';
        $produit = $this->executerRequete($sql, array($produitID));
        if ($produit->rowCount() == 1)
            return $produit->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun produit ne correspond à l'identifiant '$produitID'");
    }

    public function countProduit()
    {
        $sql="SELECT count(produitID) FROM produit ";
        $produit = $this->executerRequete($sql);
        if ($produit->rowCount() == 1)
            return $produit->fetch();
    }


    /** Renvoie les informations sur un utillisateurs
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getAllProduit()
    {
        $sql = 'select produitID, nomProduit, prix, Solde, description, cheminimage, Date ,Stock,nomCategorie, nomSurcategorie ,nomSousCategorie FROM produit, categorie , souscategorie,surcategorie WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID';
        $produit = $this->executerRequete($sql);
        if ($produit->rowCount() >= 1) {
            return $produit->fetchAll();  // Accès à la première ligne de résultat
        } else
            throw new Exception("Aucun produit ne correspond à l'identifiant");
    }


    /** Retourne tous les produits appartenants à la catégorie spécifiée
     *
     * @param $idCategorie
     * @return un tableau avec les produits
     * @throws Exception si aucun produit dans la sous catégorie choisie
     */


    /**
     * Retourne toutes les catégories disponibles
     *
     * @return array Un tableau des catégories
     */
    public function getCategories()
    {
        $sql = "SELECT * FROM categorie";
        $produits = $this->executerRequete($sql, array());
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }

    public function getCategoriesbysurcategorie($sur)
    {
        $sql = "SELECT * FROM categorie,surcategorie WHERE categorie.surcategorieID = surcategorie.surcategorieID AND surcategorie.surcategorieID = ?";
        $produits = $this->executerRequete($sql, array($sur));
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }

 
    public function getsurCategories()
    {
        $sql = "SELECT * FROM surcategorie";
        $produits = $this->executerRequete($sql, array());
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }


    public function getsousCategoriesbycategorie($sous)
    {
        $sql = "SELECT * FROM categorie,souscategorie WHERE categorie.categorieID = souscategorie.categorieID AND sousCategorie.categorieID = ?";
        $produits = $this->executerRequete($sql, array($sous));
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }
    /**
     * Fonction qui vérifie si un existe ou pas
     *
     * @param $name
     * @return bool
     */
    public function produitExists($name)
    {
        $sql = 'SELECT * FROM produit WHERE nomProduit = ?';
        $produit = $this->executerRequete($sql, array($name));
        if ($produit->rowCount() >= 1)
            return true;
        else
            return false;
    }
    
    //______________________________________________________________________________________
    /**
     * Fonction qui vérifie si un existe ou pas
     *
     * @param $name
     * @return bool
     */
    public function produitExistsBy($id)
    {
        $sql = 'SELECT * FROM produit WHERE produitID = ?';
        $produit = $this->executerRequete($sql, array($id));
        if ($produit->rowCount() >= 1)
            return true;
        else
            return false;
    }
     

      /**
     * Fonction qui ajoute un produit dans la bdd
     *
     * @param $nom
     * @param $prix
     * @param $description
     * @param $cheminimage
     * @return int
     */
    public function insertProduit($nom, $prix,$solde, $description, $cheminimage, $id_sous_categorie,$stock)
    {
        
        $sql = 'INSERT INTO `produit` (`nomProduit`, `prix`,`solde`, `description`, `cheminimage`, `sousCategorieID`,`Stock`) VALUES ( ?, ?, ?, ?,?,?,?)';
        $this->executerRequete($sql, array($nom, $prix,$solde, $description, $cheminimage, $id_sous_categorie,$stock));
        
    }
 
    /**
     * Fonction qui supprime un produit dans la bdd
     *
     * @param $nom : le nom du produit à effacer
     * @return int : le résultat de la fonction
     */
    public function deleteProduit($name)
    {
        if ($this->produitExists($name)) {

            
            $sql = "DELETE from produit WHERE nomProduit = ?";
            $this->executerRequete($sql, array($name));
            
            return Produit::DEL_OK;
        } else
            return Produit::DOES_NOT_EXIST;
    }
  
}



?> 