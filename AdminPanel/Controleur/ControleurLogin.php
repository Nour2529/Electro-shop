<?php



// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/AdminLogin.php';

class ControleurLogin implements Controleur
{
    //Attributs
    /**
     * @var int
     */
    private $login_code;
    /**
     * @var AdminLogin
     */
    private $adminLogin;
    
    private $data;
    private $adminErreur;
    private $countErreur;

    //______________________________________________________________________________________
    /**
     * ControleurLogin constructor.
     */
    public function __construct()
    {
        $this->admin_code = 0;
        $this->adminLogin = new AdminLogin();
        $this->adminErreur=[
            'email'=>'',
            'password'=>''
        ];
    }

    /**
     * Getter de login_code
     *
     * @return int login_code
     */
    public function getLogin_code()
    {
        return $this->login_code;
    }

    /**
     * Getter de adminLogin
     *
     * @return AdminLogin
     */
    public function getAdminLogin()
    {
        return $this->adminLogin;
    }

    /**
     * Setter de login_code
     *
     * @param $newLogin_code
     */
    public function setLogin_code($newLogin_code)
    {
        $this->login_code = $newLogin_code;
    }

    /**
     * Setter de userLogin
     *
     * @param $newUserLogin
     */
    public function setAdminLogin($newAdminLogin)
    {
        $this->adminLogin = $newAdminLogin;
    }


    //______________________________________________________________________________________
    /**
     * Fonction qui deconnecte l'utilisateur et le redirige vers la page d'accueil
     */
    public function logOut()
    {   
        if (isset($_SESSION['id'])) {
            session_destroy();
            header('Location: index.php?action=login');
            die();
        }
    }


    /**
     * Fonction qui logue un utilisateur
     */
    public function logguerAdmin()
    {
        $this->adminErreur=[
            'email'=>'',
            'password'=>''
        ];
        
        $this->countErreur=0;
        // Aucun champ n'est rempli => Le client vient de cliquer sur "Login ou Profil et il n'est pas connecté"
        // donc on affiche le formulaire
        $vue = new Vue("Login");
        if (isset($_POST['login'])) {
            if (empty($_POST['email'])) {
                $this->adminErreur['email']="Email est obligatoire";
                $this->countErreur++;

            }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->adminErreur['email']="Email invalide ";
                $this->countErreur++;
            }
            if(empty($_POST['password']))
            {
                $this->adminErreur['password']="Mot de passe est obligatoire";
                $this->countErreur++;
            }
            if($this->countErreur==0)
            {
                
                if($this->adminLogin->adminExist($_POST['email']))
                {
                    $this->login_code = $this->adminLogin->connectAdmin($_POST['email'], $_POST['password']);
                    if ($this->login_code == AdminLogin::LOGIN_OK) {
                        

                        header('Location: index.php?action=accueil');
                        die();
                    }
                    if($this->login_code=AdminLogin::BAD_PASSWORD)
                    {
                        $this->adminErreur['password']="Mot de passe incorrect";
                    }
                    if($this->login_code=AdminLogin::NOT_ALLOWED)
                    {
                        $this->adminErreur['email']="Accès non autorisé par cette adresse email ";
                        $this->login_code = AdminLogin::FORM_INPUTS_ERROR;
                    }
                    
                }else{
                    $this->adminErreur['email']="Email n'existe pas dans la base de donnée ";
                }
               
                
            }
            
            
            if(isset($_POST['email']))
            {
                $this->data=$_POST['email'];
            }
            
        }
        $vue->generer(array('login_code' => $this->login_code,'email'=>$this->data,'erreur'=>$this->adminErreur));
    }


    /**
     * Affiche la vue
     */
    public function getHTML()
    {
        $this->data="";
        // si l'utilisateur est connecte
        if (isset($_SESSION['id'])) {
            header('Location: index.php?action=accueil');
            die();
        } // sinon redirection vers la page de login
        else {
            $this->logguerAdmin();
        }

    }


}