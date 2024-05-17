<?php
/**
 * User: Guillaume vandierdonck & Qi You
 * Date: 11/2016
 */

require_once('Modele.php');


class Produit extends Modele
{
    /** Renvoie les informations sur un utillisateurs
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getProduit($produitID)
    {
        $sql = 'select * from produit , categorie, souscategorie ,surcategorie WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID and produitID=?';
        $produit = $this->executerRequete($sql, array($produitID));
        if ($produit->rowCount() == 1)
            return $produit->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun produit ne correspond à l'identifiant '$produitID'");
    }


    /** Renvoie les informations sur un utillisateurs
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getAllProduit()
    {
        $sql = 'select produitID, nomProduit, prix, Solde, description, cheminimage, Date ,nomCategorie FROM produit, categorie , souscategorie WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID';
        $produit = $this->executerRequete($sql);
        if ($produit->rowCount() >= 1) {
            return $produit->fetchAll();  // Accès à la première ligne de résultat
        } else
            throw new Exception("Aucun produit ne correspond à l'identifiant");
    }
    public function getAllNewProduit()
    {
        $sql = 'select produitID, nomProduit, prix, Solde, description, cheminimage, Date ,nomCategorie FROM produit, categorie , souscategorie WHERE (CURRENT_DATE-INTERVAL 1 MONTH)<Date AND produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID';
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
    public function getAllProduitsByCategorieId($idCategorie)
    {
        $sql = "SELECT * FROM produit, categorie, souscategorie ,surcategorie WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID AND categorie.categorieID = ?";
        $produits = $this->executerRequete($sql, array($idCategorie));
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }

    public function getAllProduitsBysurCategorieId($idsurCategorie)
    {
        if (isset($_GET['idsurCategorie']) ){
        $sql = "SELECT * FROM produit, categorie, souscategorie ,surcategorie WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID AND surcategorie.surcategorieID = ?";
        $produits = $this->executerRequete($sql, array($idsurCategorie));
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();}  // Accès à la première ligne de résultat
    }
    public function getAllProduitsBysousCategorieId($idCategorie)
    {
        $sql = "SELECT * FROM produit, categorie, souscategorie ,surcategorie WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID AND souscategorie.sousCategorieID = ?";
        $produits = $this->executerRequete($sql, array($idCategorie));
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }


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

    public function countcategories($cat){
        $sql = "SELECT nomCategorie,count(produitID) AS nb FROM surcategorie,categorie,souscategorie,produit WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID AND categorie.categorieID = ?";
        $categeroie = $this->executerRequete($sql, array($cat));
        if ($categeroie->rowCount() == 1)
            return $categeroie->fetch();  // Accès à la première ligne de résulta
        
    }

    public function counttoutcategorie($cat){
        $cat=$this->getCategoriesbysurcategorie($cat);
        $tab=array();
        $i=0;
        foreach ($cat as $surcat) {
            $a=$surcat['categorieID'];
            $b=$this->countcategories($a);
            $tab[$i]=array($surcat['categorieID'],$surcat['nomCategorie'],$b['nb']);
            $i++;
        }
        return $tab;
    }
    public function getsurCategories()
    {
        $sql = "SELECT * FROM surcategorie";
        $produits = $this->executerRequete($sql, array());
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }
    public function countsurcategories($cat){
        $sql = "SELECT nomSurcategorie,count(produitID) AS nb FROM surcategorie,categorie,souscategorie,produit WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID AND surcategorie.surcategorieID = ?";
        $categeroie = $this->executerRequete($sql, array($cat));
        if ($categeroie->rowCount() == 1)
            return $categeroie->fetch();  // Accès à la première ligne de résulta
        
    }
    public function counttoutsurcategorie(){
        $cat=$this->getsurCategories();
        $tab=array();
        $i=0;
        foreach ($cat as $surcat) {
            $a=$surcat['surcategorieID'];
            $b=$this->countsurcategories($a);
            $tab[$i]=array($surcat['surcategorieID'],$surcat['nomSurcategorie'],$b['nb']);
            $i++;
        }
        return $tab;
    }

    public function getsousCategoriesbycategorie($sous)
    {
        $sql = "SELECT * FROM categorie,souscategorie WHERE categorie.categorieID = souscategorie.categorieID AND sousCategorie.categorieID = ?";
        $produits = $this->executerRequete($sql, array($sous));
        if ($produits->rowCount() >= 1)
            return $produits->fetchAll();  // Accès à la première ligne de résultat
    }

    public function countsouscategories($cat){
        $sql = "SELECT nomSousCategorie,count(produitID) AS nb FROM surcategorie,categorie,souscategorie,produit WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND categorie.surcategorieID = surcategorie.surcategorieID AND souscategorie.souscategorieID = ?";
        $categeroie = $this->executerRequete($sql, array($cat));
        if ($categeroie->rowCount() == 1)
            return $categeroie->fetch();  // Accès à la première ligne de résulta
        
    }

    public function counttoutsouscategorie($cat){
        $cat=$this->getsousCategoriesbycategorie($cat);
        $tab=array();
        $i=0;
        foreach ($cat as $surcat) {
            $a=$surcat['sousCategorieID'];
            $b=$this->countsouscategories($a);
            $tab[$i]=array($surcat['sousCategorieID'],$surcat['nomSousCategorie'],$b['nb']);
            $i++;
        }
        return $tab;
    }

    /**
     * Fonction qui récupère le panier d'un utilisateur
     *
     * @param $userID   L'id de l'utilisateur
     * @return mixed|null  Le panier en cours ou null s'il y en a aucun
     */
    public function getPanierForUser($userID)
    {
        $sql = "SELECT * FROM panier WHERE panier.etatPanier = 0 AND panier.userID = ?";
        $panier = $this->executerRequete($sql, array($userID));
        if ($panier->rowCount() == 1)
            return $panier->fetch(); // un seul panier possible non terminé...
        else
            return null;
    }


    /**
     * Fonction qui récupère une ligne du panier
     *
     * @param $panierID
     * @param $produitID
     * @return mixed|null
     */
    public function getLignePanier($panierID, $produitID)
    {
        $sql = "SELECT * FROM lignepanier WHERE panierID = ? AND produitID = ?";
        $lignepanier = $this->executerRequete($sql, array($panierID, $produitID));
        if ($lignepanier->rowCount() >= 1)
            return $lignepanier->fetch();
        else
            return null;
    }
    public function getproduitPanier($panierID)
    {
        $sql = "SELECT produitID FROM lignepanier WHERE panierID = ? ";
        $lignepanier = $this->executerRequete($sql, array($panierID));
        if ($lignepanier->rowCount() >= 1)
            return $lignepanier->fetchAll();
        else
            return null;
    }
    public function getquantiterproduitPanier($panierID)
    {
        $sql = "SELECT  sum(quantité) FROM lignepanier WHERE panierID = ? ";
        $lignepanier = $this->executerRequete($sql, array($panierID));
        if ($lignepanier->rowCount() >= 1)
            return $lignepanier->fetch();
        else
            return null;
    }

    
    /**
     * Fonction qui crée une nouvelle ligne dans un panier pour lui ajouter un élèment
     *
     * @param $panierID
     * @param $produitID
     */
    public function createNewLignePanier($panierID, $produitID)
    {
        // Il faut la dernière ligne du panier
        $sql_lastline = "SELECT numeroLignePanier FROM `lignepanier` WHERE panierID = ? ORDER BY numeroLignePanier DESC LIMIT 1";
        $last_line = $this->executerRequete($sql_lastline, array($panierID));
        if ($last_line->rowCount() == 1) {
            $last_ligne = $last_line->fetch();
            $insert_line = "INSERT INTO `lignepanier` (`lignePanierID`, `panierID`, `numeroLignePanier`, `produitID`, `quantité`) VALUES (NULL, ?, ?, ?, ?)";
            $ligne = $this->executerRequete($insert_line, array($panierID, $last_ligne['numeroLignePanier'] + 1, $produitID, 1));
            if (isset($_SESSION['countpanier'])) {
                $_SESSION['countpanier'] = $_SESSION['countpanier'] + 1;
            } 
            else{
                $_SESSION['countpanier']=1;
            }// on rajoute l'item au panier
        } else {
            // étrange... aucune ligne au panier ? comment le panier a été créé ?
            $insert_line = "INSERT INTO `lignepanier` (`lignePanierID`, `panierID`, `numeroLignePanier`, `produitID`, `quantité`) VALUES (NULL, ?, ?, ?, ?)";
            $ligne = $this->executerRequete($insert_line, array($panierID, 1, $produitID, 1)); // on rajoute l'item au panier
        }
    }

    /**
     * Fonction qui augmente le nombre de produit d'une ligne d'un panier
     *
     * @param $lignePanierID
     */
    public function increaseQuantityPanier($lignePanierID,$q=1)
    {   
        
        $sql = "UPDATE `lignepanier` SET `quantité`= `quantité` + ? WHERE `lignePanierID` = ?";
        $this->executerRequete($sql, array($q,$lignePanierID));
    }
    public function dicreaseQuantityPanier($lignePanierID,$q)
    {   
        
        $sql = "UPDATE `lignepanier` SET `quantité`= `quantité` - ? WHERE `lignePanierID` = ?";
        $this->executerRequete($sql, array($q,$lignePanierID));
    }
    public function updateQuantityPanier($lignePanierID,$q){
        $sql = "UPDATE `lignepanier` SET `quantité`=? WHERE `lignePanierID` = ?";
        $this->executerRequete($sql, array($q,$lignePanierID));
    }

    public function supprimerligne($lignePanierID)
    {
        $sql="DELETE FROM lignepanier WHERE lignePanierID = ?";
        $this->executerRequete($sql, array($lignePanierID));
    }
    /**
     * Fonction qui crée un nouveau panier
     *
     * @param $userID
     */
    public function createNewPanier($userID)
    {
        // Les paramètres inutiles sont à NULL
        $sql = "INSERT INTO `panier` (`panierID`, `userID`, `etatPanier`, `adresseID`, `moyenDePaiementID`, `HeureAchat`) VALUES (NULL, ?, ?, NULL, NULL, NULL)";
        $this->executerRequete($sql, array($userID, 0));
    }


    public function getcategoriebyfiltre($min,$max,$sort,$parPage,$premier){
    
         $showw="LIMIT ".$premier.",".$parPage;
        
        if($sort==0){
            $sortt= "ORDER BY produit.prix ASC";
        }elseif($sort==1){
            $sortt="ORDER BY produit.prix DESC";
        }


        $sql = 'SELECT * FROM produit, categorie , souscategorie  WHERE produit.sousCategorieID = souscategorie.sousCategorieID AND souscategorie.categorieID = categorie.categorieID AND produit.prix BETWEEN ? and ? '.$sortt.' '.$showw.'';
        
            $produit = $this->executerRequete($sql,array($min, $max));
            if ($produit->rowCount() >= 1) {
            return $produit->fetchAll();}
}
public function getcategoriebyfiltresur($id,$min,$max,$sort,$parPage,$premier){
    $showw="LIMIT ".$premier.",".$parPage;
   
   if($sort==0){
       $sortt= "ORDER BY produit.prix ASC";
   }elseif($sort==1){
       $sortt="ORDER BY produit.prix DESC";
   }


   $sql = 'SELECT * FROM produit , surcategorie,categorie,souscategorie WHERE produit.sousCategorieID=souscategorie.sousCategorieID AND souscategorie.CategorieID=categorie.categorieID AND categorie.surcategorieID=surcategorie.surcategorieID AND surcategorie.surcategorieID=? AND produit.prix BETWEEN ? and ?'.$sortt.' '.$showw.'';
   
       $produit = $this->executerRequete($sql,array($id,$min, $max));
       if ($produit->rowCount() >= 1) {
       return $produit->fetchAll();}
}
public function getcategoriebyfiltre_c($id,$min,$max,$sort,$parPage,$premier){
    
    $showw="LIMIT ".$premier.",".$parPage;
   
   if($sort==0){
       $sortt= "ORDER BY produit.prix ASC";
   }elseif($sort==1){
       $sortt="ORDER BY produit.prix DESC";
   }


   $sql = 'SELECT * FROM produit , surcategorie,categorie,souscategorie WHERE produit.sousCategorieID=souscategorie.sousCategorieID AND souscategorie.CategorieID=categorie.categorieID AND categorie.surcategorieID=surcategorie.surcategorieID AND categorie.categorieID=? AND produit.prix BETWEEN ? and ? '.$sortt.' '.$showw.'';
   $produit = $this->executerRequete($sql,array($id,$min, $max));
       if ($produit->rowCount() >= 1) {
       return $produit->fetchAll();}
}
public function getcategoriebyfiltresous($id,$min,$max,$sort,$parPage,$premier){
    
    $showw="LIMIT ".$premier.",".$parPage;
   
   if($sort==0){
       $sortt= "ORDER BY produit.prix ASC";
   }elseif($sort==1){
       $sortt="ORDER BY produit.prix DESC";
   }


   $sql = 'SELECT * FROM produit , surcategorie,categorie,souscategorie WHERE produit.sousCategorieID=souscategorie.sousCategorieID AND souscategorie.CategorieID=categorie.categorieID AND categorie.surcategorieID=surcategorie.surcategorieID AND souscategorie.sousCategorieID=? AND produit.prix BETWEEN ? and ? '.$sortt.' '.$showw.'';
   
       $produit = $this->executerRequete($sql,array($id,$min, $max));
       if ($produit->rowCount() >= 1) {
       return $produit->fetchAll();}
}
    public function countall($min, $max){
        $sql='SELECT COUNT(`produitID`) AS nb_articles FROM `produit`WHERE prix BETWEEN ? and ?';
        $res=$this->executerRequete($sql,array($min, $max));
        $fetch=$res->fetch();
        $nbArticles = (int) $fetch['nb_articles'];
        return $nbArticles;
    }

    public function countsur($id,$min, $max){
        $sql='SELECT COUNT(`produitID`) AS nb_articles FROM produit , surcategorie,categorie,souscategorie WHERE prix BETWEEN ? and ? AND produit.sousCategorieID=souscategorie.sousCategorieID AND souscategorie.CategorieID=categorie.categorieID AND categorie.surcategorieID=surcategorie.surcategorieID AND surcategorie.surcategorieID= ?';
        $res=$this->executerRequete($sql,array($min, $max,$id));
        $fetch=$res->fetch();
        $nbArticles = (int) $fetch['nb_articles'];
        return $nbArticles;
    }

    public function count_c($id,$min, $max){
        $sql='SELECT COUNT(`produitID`) AS nb_articles FROM produit , surcategorie,categorie,souscategorie WHERE prix BETWEEN ? and ? AND produit.sousCategorieID=souscategorie.sousCategorieID AND souscategorie.CategorieID=categorie.categorieID AND categorie.surcategorieID=surcategorie.surcategorieID AND categorie.categorieID= ?';
        $res=$this->executerRequete($sql,array($min, $max,$id));
        $fetch=$res->fetch();
        $nbArticles = (int) $fetch['nb_articles'];
        return $nbArticles;
    }

    public function countsous($id,$min, $max){
        $sql='SELECT COUNT(`produitID`) AS nb_articles FROM produit , surcategorie,categorie,souscategorie WHERE prix BETWEEN ? and ? AND produit.sousCategorieID=souscategorie.sousCategorieID AND souscategorie.CategorieID=categorie.categorieID AND categorie.surcategorieID=surcategorie.surcategorieID AND souscategorie.sousCategorieID= ?';
        $res=$this->executerRequete($sql,array($min, $max,$id));
        $fetch=$res->fetch();
        $nbArticles = (int) $fetch['nb_articles'];
        return $nbArticles;
    }


}?> 