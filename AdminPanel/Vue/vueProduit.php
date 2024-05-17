<?php
        if(isset($_SESSION['edit'])){

            if($_SESSION['edit']!='')
            {
                echo'<br>';
                echo '<div class="alert alert-success" role="alert">';
                echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> ';  
                echo '<h3>'.$_SESSION['edit'].'</h3>';  
                                
                echo '</div>';
                $_SESSION['edit']='';
            } 
        }
        
        if(isset($_SESSION['add'])){
        if($_SESSION['add']!='')
            {
                echo'<br>';
                echo '<div class="alert alert-success" role="alert">';
                echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> ';  
                echo '<h3>'.$_SESSION['add'].'</h3>';  
                                
                echo '</div>';
                $_SESSION['add']='';
                
            } 
        }

        if(isset($_SESSION['delete'])){
            if ($_SESSION['delete']!='') {
                echo'<br>';
                echo '<div class="alert alert-danger" role="alert">';
                echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> ';  
                echo '<h3>'.$_SESSION['delete'].'</h3>';  
                                
                echo '</div>';
                $_SESSION['delete']='';
                
                
            } 
        }

        ?>
<div class="card mt-5">
    <div class="card-body">
        <h4 class="header-title">Produits</h4>
        <a href="index.php?action=addproduit"><button type="button" class="btn btn-primary" >Add Produit</button></a>
        <div class="single-table">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom produit</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Solde</th>
                            <th scope="col">Description</th>
                            <th scope="col">Chemin image</th>
                            <th scope="col">Quantite</th>
                            <th scope="col">Nom de Souscategorie</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($Produit)) {
                        echo "<strong>Aucun produit dans cette sous catégorie</strong>";
                        } else {
                        foreach ($Produit as $Produit) { ?>
                            <tr>
                                <th scope="row" ><?php echo $Produit['produitID']; ?></th>
                                <td><?php echo $Produit['nomProduit']; ?></td>
                                <td><?php echo $Produit['prix']; ?></td>
                                <td><?php echo $Produit['Solde']; ?></td>
                                <td><?php echo $Produit['description']; ?></td>
                                <td><img src=<?php echo './'.$Produit['cheminimage']; ?> class="img-fluid" width="50"> </td>
                                <td><?php echo $Produit['Stock']; ?></td>
                                <td><?php echo $Produit['nomSousCategorie']; ?></td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="?action=editproduit&idproduit=<?php echo $Produit['produitID']; ?>" class="text-secondary"><button class="btn btn-warning btn-sm edit_button" type="button"><i class="fa fa-edit"></i></button></a></li>
                                        <li>
                                        <form method="POST" action="?action=produit">
                                            <input type="hidden" name="id" value="<?php echo $Produit['nomProduit']; ?>" />
                                            <button type="submit" class="btn btn-danger btn-sm delete_button" name="delete" data-id="<?php echo $Produit['nomProduit']; ?>"><i class="ti-trash"></i></button>
                                            </form>
                                        </li>

                                        
                                        
                                            
                                                                                
                                    </ul>
                                </td>
                            </tr>
                        <?php }} ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div>
   
