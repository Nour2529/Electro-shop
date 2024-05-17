<?php

require_once('Modele.php');

/**
 * Created by PhpStorm.
 * User: Nicolas Sobczak & Vincent Reynaert
 * Date: 02/11/2016
 */
class User extends Modele
{
    //______________________________________________________________________________________
    /** Renvoie les informations sur un utillisateur
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getAllUser()
    {
        $sql = 'select userID, nom, prenom, chemin, niveau_accreditation, mail, mot_de_passe from user ';
        $user = $this->executerRequete($sql, array());
        if ($user->rowCount() > 1)
            return $user->fetchAll();  
        
    }
//______________________________________________________________________________________
    /** Renvoie les informations sur un utillisateur
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getUser($userID)
    {
        $sql = 'select userID, nom, prenom, chemin, niveau_accreditation, mail, mot_de_passe from user where userID=?';
        $user = $this->executerRequete($sql, array($userID));
        if ($user->rowCount() == 1)
            return $user->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun utilisateur ne correspond à l'identifiant '$userID'");
    }
    public function coutUser()
    {
        $sql="SELECT count(userID) FROM user ";
        $user = $this->executerRequete($sql);
        if ($user->rowCount() == 1)
            return $user->fetch();
    }
    public function UpdateRoleToAdmin($id)
    {
        $sql = "UPDATE user SET niveau_accreditation = ? WHERE userID = ?";
        $this->executerRequete($sql, array(1, $id));
    }
    public function UpdateRoleToUser($id)
    {
        $sql = "UPDATE user SET niveau_accreditation = ? WHERE userID = ?";
        $this->executerRequete($sql, array(2, $id));
    }
}