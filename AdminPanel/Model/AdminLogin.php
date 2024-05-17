<?php

require_once('Modele.php');

/**
 * Created by PhpStorm.
 * User: Nicolas Sobczak & Vincent Reynaert
 * Date: 02/11/2016
 */
class AdminLogin extends Modele
{
    //Constantes
    const FORM_INPUTS_ERROR = 1;
    const INVALID_MAIL_FORMAT = 2;
    const DOESNOT_EXIST = 3;
    const BAD_PASSWORD = 4;
    const LOGIN_OK = 5;
    const DATABASE_ERROR = 6;
    const NOT_ALLOWED=7;

    const SALT_REGISTER = "sel_php";


    //______________________________________________________________________________________
    /**
     * Fonction qui verifie que le user s'est bien enregistré avant d'essayer de le logguer
     *
     * @param $mail
     * @param $password
     * @return array|int
     */
    public function connectAdmin($email, $password)
    {
        
        if($this->adminExist($email)){
            $password_hash = sha1(AdminLogin::SALT_REGISTER . $password);

            
            return $this->valid_password($email, $password_hash);
           
        }else{
            return AdminLogin::DOESNOT_EXIST;
        }

      
    }


    /** Renvoie les informations sur un utillisateurs
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getAdmin($mailAdmin)
    {
        $sql = 'SELECT userID,nom,prenom,chemin, niveau_accreditation, mail, mot_de_passe ' .
            'from user where mail=?';
        $user = $this->executerRequete($sql, array($mailAdmin));
        if ($user->rowCount() == 1)
            return $user->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun utilisateur ne correspond au mail '$mailAdmin'");
    }

    public function countAdmin()
    {
        $sql="SELECT count(userID) FROM user WHERE niveau_accreditation=1";
        $admin = $this->executerRequete($sql);
        if ($admin->rowCount() == 1)
            return $admin->fetch();
    }

    /**
     * Fonction qui regarde si l'utilisateur existe ou pas
     *
     * @param $mailAdmin
     * @return bool
     */
    public function adminExist($mailAdmin)
    {
        $sql = "SELECT * FROM user WHERE mail = ?";
        $user = $this->executerRequete($sql, array($mailAdmin));
        $row=$user->fetch(PDO::FETCH_ASSOC);
        //if data matches
        if($row!=array())
        
            return true;
        else{
            return false;
        }
            
    }


    /**
     * Fonction qui regarde si un mot de passe est valide ou non
     *
     * @param $mail
     * @param $password_hash
     * @return bool
     */
    public function valid_password($mail, $password_hash)
    {
        try {
            $user_param = $this->getAdmin($mail);
            if ($user_param['mot_de_passe'] == $password_hash)
            {
                if($user_param['niveau_accreditation'] !=1)
                {
                    return AdminLogin::NOT_ALLOWED;
                }
                
                $_SESSION['id'] = $user_param['userID'];
                $_SESSION['nom'] = $user_param['nom'];
                $_SESSION['prenom'] = $user_param['prenom'];
                $_SESSION['image'] = $user_param['chemin'];
                $_SESSION['role'] = $user_param['niveau_accreditation'];
                $_SESSION['mail'] = $user_param['mail'];
                $_SESSION['password'] = $user_param['mot_de_passe'];
                
                return AdminLogin::LOGIN_OK;
            } else
                return AdminLogin::BAD_PASSWORD;
        } catch (Exception $e) {
            return AdminLogin::DOESNOT_EXIST;
        }
    }

}