<?php


//________________________________________________________________________________________
// Require once
require_once('Controleur.php');
require_once('Vue/Vue.php');
require_once ('Model/User.php');


class ControleurUser implements Controleur
{
    private $user;
    //______________________________________________________________________________________
    /**
     * ControleurUser constructor.
     */
    public function __construct()
    {
        $this->user=new User();
    }


    //______________________________________________________________________________________
    /**
     *  Affiche la vue de la page
     */
    public function getHTML()
    {
        if(isset($_POST['admin']))
        {
            $this->user->UpdateRoleToAdmin($_POST['id']);
        }
        if(isset($_POST['user']))
        {
            $this->user->UpdateRoleToUser($_POST['id']);
        }
        $vue = new Vue("User");
        $vue->generer(array('Users'=>$this->user->getAllUser()));
    }
}