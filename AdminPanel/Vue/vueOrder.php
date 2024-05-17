<?php 
    if(isset($_SESSION['envoyer'])){
    if ($_SESSION['envoyer']!='') {
            echo'<br>';
            echo '<div class="alert alert-success" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['envoyer'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['envoyer']='';
        }
    }
?>
<?php $total=0?>
<div class="card mt-5">
    <div class="card-body">
        <h4 class="header-title">Orders</h4>

        <div class="single-table">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">OrderID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nom du produit</th>
                            <th scope="col">prix</th>
                            <th scope="col">Qte</th>
                            <th scope="col">Solde</th>
                            <th scope="col">Prix Total Produit</th>
                            <th scope="col">Prix Total </th>
                            <th scope="col">Etat</th>
                            <th scope="col">Envoyer un mail</th>



                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php if (empty($Orders)) {
                        echo "<strong>Aucun produit dans cette sous catégorie</strong>";
                        } else {
                        foreach ($Orders as $Order) { ?>
                            <tr>
                                <th scope="row" ><?php echo $Order['panierID']; ?></th>
                                <td><?php echo $Order['mail']; ?></td>
                                <td> <table>
                                <?php foreach ($SousOrders as $SousOrder) { 
                                    if ($SousOrder['panierID']==$Order['panierID']){?>
                                         <tr><td><?php echo $SousOrder['nomProduit']; ?><td></tr>
                                         <?php }} ?> 
                                </table>
                                </td>
                                <td> <table>
                                <?php foreach ($SousOrders as $SousOrder) { 
                                    if ($SousOrder['panierID']==$Order['panierID']){?>
                                         <tr><td><?php echo $SousOrder['prix']; ?><td><br><br><br><br><br></tr>
                                         <?php }} ?> 
                                </table>
                                </td>
                                <td> <table>
                                <?php foreach ($SousOrders as $SousOrder) { 
                                    if ($SousOrder['panierID']==$Order['panierID']){?>
                                         <tr><td><?php echo $SousOrder['quantité']; ?><td><br><br><br><br><br></tr>
                                         <?php }} ?> 
                                </table>
                                </td>
                                <td> <table>
                                <?php foreach ($SousOrders as $SousOrder) { 
                                    if ($SousOrder['panierID']==$Order['panierID']){?>
                                         <tr><td><?php echo $SousOrder['Solde']; ?><td><br><br><br><br><br></tr>
                                         <?php }} ?> 
                                </table>
                                </td>
                                <td> <table>
                                <?php foreach ($SousOrders as $SousOrder) { 
                                    if ($SousOrder['panierID']==$Order['panierID']){?>
                                         <tr><td><?php echo $SousOrder['prix_total_produit']; ?><td><br><br><br><br><br></tr>
                                         <?php $total=$total+$SousOrder['prix_total_produit']; }} ?> 
                                </table>
                                </td>
                                <td><?php echo $total;
                                $total=0;?></td>
                                <td><?php if($Order['etatPanier']==1)
                                {
                                    echo "payé";
                                }else
                                {
                                    echo "non payé";
                                }?></td>
                                <td>
                                <form method="post" action="?action=envoyermail&id=<?php echo $Order['panierID']; ?>" >    
                                <?php if(isset($_SESSION['envoyer'.$Order['panierID']]))
                                {?>
                                    <button type="submit" class="btn btn-secondery" disabled >Envoyer</button></td>
                                <?php }
                                else{?>
                                    <button type="submit" class="btn btn-primary" >Envoyer</button></td>
                                <?php }?>
                                
                               
                            </tr>
                            
                        <?php }} ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div>
