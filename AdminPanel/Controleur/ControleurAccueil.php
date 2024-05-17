<?php


//________________________________________________________________________________________
// Require once
require_once('Controleur.php');
require_once('Vue/Vue.php');
require_once 'Model/Produit.php';
require_once 'Model/Categorie.php';
require_once 'Model/SurCategorie.php';
require_once 'Model/SousCategorie.php';
require_once 'Model/Order.php';
require_once 'Model/AdminLogin.php';
require_once 'Model/User.php';





class ControleurAccueil implements Controleur
{

    private $produit;
    private $categorie;
    private $souscategorie;
    private $surcategorie;
    private $order;
    private $admin;
    private $user;



    //______________________________________________________________________________________
    /**
     * ControleurAccueil constructor.
     */
    public function __construct()
    {

        $this->produit = new Produit();
        $this->categorie = new Categorie();
        $this->souscategorie = new SousCategorie();
        $this->surcategorie = new SurCategorie();
        $this->order = new Order();
        $this->admin = new AdminLogin();
        $this->user = new User();


    }


    //______________________________________________________________________________________
    /**
     *  Affiche la vue de la page
     */
    public function getHTML()
    {
        $vue = new Vue("Accueil");
        $vue->generer(array('countProduit'=> $this->produit->countProduit(),'countCategorie'=> $this->categorie->coutCategorie(),'countSousCategorie'=> $this->souscategorie->coutSousCategorie(),'countSurCategorie'=> $this->surcategorie->coutSurCategorie(),
        'countOrder'=> $this->order->coutOrder(),'countAdmin'=> $this->admin->countAdmin(),'countUser'=> $this->user->coutUser()));
    }
}