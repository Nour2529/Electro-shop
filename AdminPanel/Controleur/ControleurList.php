<?php
/**
 * User: Guillaume vandierdonck & Qi You
 * Date: 11/2016
 */

//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';

require_once 'Model/Produit.php';

class ControleurList implements Controleur
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
    public function getHTML(){
    
        $type = empty($_GET['type']) ? 'categorie' : $_GET['type'];
        if ($type === 'categorie') {
            $items=$this->produit->getCategoriesbysurcategorie($_GET['filter']);
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['nomCategorie'],
                    'value' => $item['categorieID']
                ];
            }, $items));
        } else if ($type === 'souscategorie') {
            $items=$this->produit->getsousCategoriesbycategorie($_GET['filter']);
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['nomSousCategorie'],
                    'value' => $item['sousCategorieID']
                ];
            }, $items));
        } else {
            throw new Exception('Unknown type ' . $type);
        }
        
    }
}