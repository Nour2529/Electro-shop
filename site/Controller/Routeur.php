<?php
session_start();

require_once('Vue/Vue.php');
require_once('Controller/Controleur.php');
require_once('Controller/ControleurAccueil.php');
require_once('Controller/ControleurLogin.php');
require_once('Controller/ControleurUserProfile.php');
require_once('Controller/ControleurInscription.php');
require_once('Controller/ControleurProductCategorie.php');
require_once('Controller/ControleurTunnel.php');
require_once('Controller/ControleurProduitList.php');

Class Routeur
{
    private $ctrlAccueil;
    private $ctrlUserProfile;
    private $ctrlProductCategorie;
    private $ctrlTunnel;
    private $ctrlProduitList;


    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlLogin = new ControleurLogin();
        $this->ctrlUserProfile = new ControleurUserProfile();
        $this->ctrlInscription = new ControleurInscription();
        $this->ctrlProductCategorie = new ControleurProductCategorie();
        $this->ctrlTunnel = new ControleurTunnel();
        $this->ctrlProduitList = new ControleurProduitList();
    }


    public function routerRequete()
    {
        try{
            if(isset($_GET['action'])){
                if ($_GET['action'] == 'accueil') {
                    $this->ctrlAccueil->getHTML(); 
                }
                elseif ($_GET['action'] == 'login') {
                    $this->ctrlLogin->getHTML();
                }
                elseif ($_GET['action'] == 'logguer') {
                    $this->ctrlLogin->logguerUser();
                }
                elseif ($_GET['action'] == 'userProfile') {
                    $this->ctrlUserProfile->handlerUserProfile();
                }
                elseif ($_GET['action'] == 'inscription') {
                    $this->ctrlInscription->registerUser();
                }
                elseif ($_GET['action'] == 'deconnexion') {
                    $this->ctrlLogin->logOut();
                }
                elseif ($_GET['action'] == 'productCategorie') {
                    $this->ctrlProductCategorie->getHTML();
                }
                elseif ($_GET['action'] == 'tunnel') {
                    $this->ctrlTunnel->getHTML();
                }
                elseif ($_GET['action'] == 'produitList') {
                    $this->ctrlProduitList->getHTML();
                }
                elseif ($_GET['action'] == 'addquntiter') {
                    $this->ctrlTunnel->addquntiter();
                }
                elseif ($_GET['action'] == 'supprimer') {
                    $this->ctrlTunnel->supprimer();
                }
                else{
                throw new Exception("Action non valide");
            }

        }else {  // aucune action définie : affichage de l'accueil
            $this->ctrlAccueil->getHTML();
        }
        } catch (Exception $e) {
        $this->erreur($e->getMessage());
        }
    }
    

    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

}

?>