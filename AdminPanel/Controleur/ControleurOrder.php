<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/Order.php';

class ControleurOrder implements Controleur
{
    /**
     * @var Order
     */
    private $order;
    



    //______________________________________________________________________________________
    /**
     * ControleurOrder constructor.
     */
    public function __construct()
    {
        $this->order = new Order();
        
        
    }



    
    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML(){
    


            
        
            $vue = new Vue("Order");
            

            $vue->generer(array('Orders' => $this->order->getOrders(),'SousOrders' => $this->order->getAllOrders()));
        
        
        

    }

}



