<?php

require_once('Modele.php');


class Order extends Modele
{
        


    /** Renvoie les informations sur un utillisateurs
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getOrders()
    {
        $sql = 'select distinct panier.panierID,user.mail ,panier.etatPanier from panier,user where panier.userID=user.userID order by panier.panierID ';
        $order = $this->executerRequete($sql);
        if ($order->rowCount() >= 1) {
            return $order->fetchAll();  // Accès à la première ligne de résultat
        } else
            throw new Exception("Aucun produit ne correspond à l'identifiant");
    }
    public function getOrdersByID($id)
    {
        $sql = 'select distinct panier.panierID,user.mail ,panier.etatPanier from panier,user 
        where panier.userID=user.userID and panier.panierID= ?  order by panier.panierID ';
        $order = $this->executerRequete($sql,array($id));
        if ($order->rowCount() >= 1) {
            return $order->fetchAll();  
        } else
            throw new Exception("Aucun Order ne correspond à l'identifiant");
    }

    public function getAllOrders()
    {
        $sql = 'SELECT  panier.panierID,user.mail,produit.nomProduit,produit.prix,produit.Solde,lignepanier.quantité,((produit.prix)-(produit.prix)*(produit.Solde)/100)*lignepanier.quantité AS prix_total_produit FROM lignepanier ,produit,panier ,user  where lignepanier.produitID=produit.produitID and lignepanier.panierID=panier.panierID and panier.userID=user.userID  order by  panier.panierID ';
        $order = $this->executerRequete($sql);
        if ($order->rowCount() >= 1) {
            return $order->fetchAll();  // Accès à la première ligne de résultat
        } else
            throw new Exception("Aucun produit ne correspond à l'identifiant");
    }
    public function coutOrder()
    {
        $sql="SELECT count(panierID) FROM panier ";
        $order = $this->executerRequete($sql);
        if ($order->rowCount() == 1)
            return $order->fetch();
    }

    public function getSousOrdersByOrderID($id)
    {
        $sql = 'SELECT  panier.panierID,user.mail,produit.nomProduit,produit.prix,produit.Solde,lignepanier.quantité,((produit.prix)-(produit.prix)*(produit.Solde)/100)*lignepanier.quantité AS prix_total_produit
         FROM lignepanier ,produit,panier ,user 
          where lignepanier.produitID=produit.produitID and lignepanier.panierID=panier.panierID 
          and panier.userID=user.userID and panier.panierID= ? order by  panier.panierID ';
        $order = $this->executerRequete($sql,array($id));
        if ($order->rowCount() >= 1) {
            return $order->fetchAll();  // Accès à la première ligne de résultat
        } else
            throw new Exception("Aucun produit ne correspond à l'identifiant");
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