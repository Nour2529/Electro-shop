<?php
session_start();

//________________________________________________________________________________________
// Require once
require_once('Vue/Vue.php');
require_once('Controleur/Controleur.php');
require_once('Controleur/ControleurLogin.php');
require_once('Controleur/ControleurAccueil.php');
require_once('Controleur/ControleurProduit.php');
require_once('Controleur/ControleurAddProduit.php');
require_once('Controleur/ControleurList.php');
require_once('Controleur/ControleurEditProduit.php');
require_once('Controleur/ControleurSurCategorie.php');
require_once('Controleur/ControleurAddSurCategorie.php');
require_once('Controleur/ControleurCategorie.php');
require_once('Controleur/ControleurOperationCategorie.php');
require_once('Controleur/ControleurSousCategorie.php');
require_once('Controleur/ControleurOperationSousCategorie.php');
require_once('Controleur/ControleurUser.php');
require_once('Controleur/ControleurOrder.php');
require_once('Controleur/ControleurEnvoyerMail.php');
require_once('Controleur/ControleurUserProfile.php');






//________________________________________________________________________________________
// Class
class Routeur
{
    // Attributs
    private $ctrlLogin;
    private $ctrlAccueil;
    private $ctrlProduit;
    private $ctrlAddProduit;
    private $ctrlList;
    private $ctrlEditProduit;
    private $ctrlSurCategorie;
    private $ctrlAddSurCategorie;
    private $ctrlCategorie;
    private $ctrlOperationCategorie;
    private $ctrlSousCategorie;
    private $ctrlOperationSousCategorie;
    private $ctrlUser;
    private $ctrlOrder;
    private $ctrlEnvoyerMail;
    private $ctrlUserProfile;








    //______________________________________________________________________________________
    /**
     * Routeur constructor.
     */
    public function __construct()
    {
        $this->ctrlLogin = new ControleurLogin();
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlProduit = new ControleurProduit();
        $this->ctrlAddProduit = new ControleurAddProduit();
        $this->ctrlList = new ControleurList();
        $this->ctrlEditProduit = new ControleurEditProduit();
        $this->ctrlSurCategorie = new ControleurSurCategorie();
        $this->ctrlAddSurCategorie = new ControleurAddSurCategorie();
        $this->ctrlCategorie = new ControleurCategorie();
        $this->ctrlOperationCategorie = new ControleurOperationCategorie();
        $this->ctrlSousCategorie = new ControleurSousCategorie();
        $this->ctrlOperationSousCategorie = new ControleurOperationSousCategorie();
        $this->ctrlUser = new ControleurUser();
        $this->ctrlOrder = new ControleurOrder();
        $this->ctrlEnvoyerMail = new ControleurEnvoyerMail();
        $this->ctrlUserProfile = new ControleurUserProfile();






    }


    /**
     * Fonction qui traite une requête entrante en fonction de l'action
     */
    public function routerRequete()
    {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'login') {
                    $this->ctrlLogin->getHTML();
                
                }
                elseif ($_GET['action'] == 'logguer') {
                    $this->ctrlLogin->logguerAdmin();
                }
                elseif ($_GET['action'] == 'accueil') {
                    $this->ctrlAccueil->getHTML();
                
                }
                else if ($_GET['action'] == 'produit') {
                    $this->ctrlProduit->getHTML();
                
                }
                else if ($_GET['action'] == 'addproduit') {
                    $this->ctrlAddProduit->getHTML();
                
                }
                else if ($_GET['action'] == 'list') {
                    $this->ctrlList->getHTML();
                
                }
                else if ($_GET['action'] == 'editproduit') {
                    $this->ctrlEditProduit->getHTML();
                
                }
                else if ($_GET['action'] == 'surcategorie') {
                    $this->ctrlSurCategorie->getHTML();
                
                }
                else if ($_GET['action'] == 'addsurcategorie') {
                    $this->ctrlAddSurCategorie->getHTML();
                
                }
                else if ($_GET['action'] == 'categorie') {
                    $this->ctrlCategorie->getHTML();
                
                }
                else if ($_GET['action'] == 'operationcategorie') {
                    $this->ctrlOperationCategorie->getHTML();
                
                }
                else if ($_GET['action'] == 'souscategorie') {
                    $this->ctrlSousCategorie->getHTML();
                
                }
                else if ($_GET['action'] == 'operationsouscategorie') {
                    $this->ctrlOperationSousCategorie->getHTML();
                
                }
                else if ($_GET['action'] == 'user') {
                    $this->ctrlUser->getHTML();
                
                }
                else if ($_GET['action'] == 'order') {
                    $this->ctrlOrder->getHTML();
                
                }
                else if ($_GET['action'] == 'envoyermail') {
                    $this->ctrlEnvoyerMail->getHTML();
                
                }
                elseif ($_GET['action'] == 'userProfile') {
                    $this->ctrlUserProfile->handlerUserProfile();
                }
                elseif ($_GET['action'] == 'deconnexion') {
                    $this->ctrlLogin->logOut();
                }
                else {
                    throw new Exception("Action non valide");
                }
            } else {  // aucune action définie : affichage de l'accueil
                $this->ctrlLogin->getHTML();
            }
        } catch (Exception $e) {
            $this->ctrlEnvoyerMail->getHTML();

        }
    }


    /**
     * Fonction qui affiche une erreur
     *
     * @param $msgErreur
     */
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}