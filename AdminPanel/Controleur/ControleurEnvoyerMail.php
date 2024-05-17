<?php


//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Model/Order.php';
require_once 'Model/SendMail.php';




class ControleurEnvoyerMail implements Controleur
{
    /**
     * @var Order
     */
    private $order;

    private $msg;
    



    //______________________________________________________________________________________
    /**
     * ControleurOrder constructor.
     */
    public function __construct()
    {
        $this->order = new Order();
        $this->mail = new SendMail();
        
        
    }
    public function getEmail()
    {
        $Orders=$this->order->getOrdersByID($_GET['id']);
        foreach($Orders as $Order)
        {
            return $Order['mail'];
        }
    }
    



    
    //______________________________________________________________________________________
    /**
     * Affiche la page d'accueil
     */
    public function getHTML(){
        if(isset($_GET['id'])){
    
        $Orders=$this->order->getOrdersByID($_GET['id']);
        $SousOrders = $this->order->getSousOrdersByOrderID($_GET['id']);
        $total=0;
            

            $vue = new Vue("EnvoyerMail");
            $this->msg='<?php $total=0 ;?>
            <h1>Facture achat valide !</h1>
            <div class="single-table">
                       <div class="table-responsive">
                           <table class="table table-hover text-center table-bordered" >
                               <thead class="text-uppercase">
                                   <tr>
                                       
                                       <th scope="col">Email</th>
                                       <th scope="col">Nom du produit</th>
                                       <th scope="col">prix</th>
                                       <th scope="col">Qte</th>
                                       <th scope="col">Solde</th>
                                       <th scope="col">Prix Total Produit</th>
                                       <th scope="col">Prix Total </th>
                                   </tr>
                               </thead>
                               <tbody>';

            
            foreach ($Orders as $Order) {  
                $this->msg=$this->msg.   "<tr> 
                                           
                <td> "  . $Order['mail'] ."</td> <td> <table>"  ; 
                foreach ($SousOrders as $SousOrder)   {
                    if($SousOrder['panierID']==$Order['panierID']){
                        $this->msg=$this->msg."<tr><td>".$SousOrder['nomProduit']."<td></tr>" ;}}
                        
                        $this->msg=$this->msg."</table>
                        </td><td> <table>" ;
                foreach ($SousOrders as $SousOrder)   {
                    if($SousOrder['panierID']==$Order['panierID']){
                        $this->msg=$this->msg."<tr><td>".$SousOrder['prix']."<td></tr>"; }}
                        
                        $this->msg=$this->msg."</table>
                        </td><td> <table>" ;    
                foreach ($SousOrders as $SousOrder)   {
                    if($SousOrder['panierID']==$Order['panierID']){
                        $this->msg=$this->msg."<tr><td>".$SousOrder['quantité']."<td></tr>" ;}}
                        
                        $this->msg=$this->msg."</table>
                        </td><td> <table>" ;    
                foreach ($SousOrders as $SousOrder)   {
                    if($SousOrder['panierID']==$Order['panierID']){
                        $this->msg=$this->msg."<tr><td>".$SousOrder['Solde']."<td></tr>"; }}
                        
                        $this->msg=$this->msg."</table>
                        </td><td> <table>" ;
                foreach ($SousOrders as $SousOrder)   {
                    if($SousOrder['panierID']==$Order['panierID']){
                        $this->msg=$this->msg."<tr><td>".$SousOrder['prix_total_produit']."<td></tr>" ;
                        $total=$total+$SousOrder['prix_total_produit'];}}
                        $this->msg=$this->msg."</table>
                        </td><td>".$total;
                        
                        $total=0;
                        $this->msg=$this->msg."</td></tr>";
                        
                    }
                    $this->msg=$this->msg."</tbody>
                    </table>
                </div>
            </div>";
                      
            if(isset($_POST['envoyer']))     
            {
                $this->mail->send_mail($this->getEmail(),$this->msg);
                if(!isset( $_SESSION['envoyer'.$_GET['id']])){
                $_SESSION['envoyer'.$_GET['id']]="Mail envoyé avec succeé !";
                }
                $_SESSION['envoyer']="Mail envoyé avec succeé !";
                

            }                           
                                   
                                      

            $vue->generer(array('Orders' => $this->order->getOrdersByID($_GET['id']),'SousOrders' => $this->order->getSousOrdersByOrderID($_GET['id']),'msg'=>$this->msg));
        
        }
        

    }

}



