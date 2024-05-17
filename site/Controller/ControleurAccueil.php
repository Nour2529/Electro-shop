<?php

/**
 * Created by PhpStorm.
 * User: Nicolas Sobczak & Vincent Reynaert
 * Date: 21/10/2016
 */
//________________________________________________________________________________________
// Require once
require_once('Controleur.php');
require_once('Vue/Vue.php');

class ControleurAccueil implements Controleur
{
    /**
     * @var Produit
     */
    private $produit;


    //______________________________________________________________________________________
    /**
     * ControleurProduitList constructor.
     */
    public function __construct()
    {
        $this->produit = new Produit();
    }

    /**
     * Getter du produit
     *
     * @return Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Setter du produit
     *
     * @param $newProduct
     */
    public function setProduit($newProduct)
    {
        $this->produit = $newProduct;
    }


    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML()
    {
        $vue = new Vue("Accueil");
        $vue->generer(array('ProduitList' => $this->produit-> getAllNewProduit()));
    }

    //______________________________________________________________________________________
    /**
     * ControleurAccueil constructor.
     */
    
}