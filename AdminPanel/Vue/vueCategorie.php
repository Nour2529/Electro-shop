<?php 
    if(isset($_SESSION['delete_categorie'])){
    if ($_SESSION['delete_categorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-danger" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['delete_categorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['delete_categorie']='';
        }
    }

    if(isset($_SESSION['edit_categorie'])){
        if ($_SESSION['edit_categorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-success" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['edit_categorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['edit_categorie']='';
        }
    }
    
    if(isset($_SESSION['add_categorie'])){
        if ($_SESSION['add_categorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-success" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['add_categorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['add_categorie']='';
        }
    }
?>
<div class="card mt-5">
    <div class="card-body">
        <h4 class="header-title">Categorie</h4>
        <a href="index.php?action=operationcategorie&type=add"><button type="button" class="btn btn-primary" >Add Categorie</button></a>
        <div class="single-table">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom Categorie</th>
                            <th scope="col">Nom SurCategorie</th>
                            <th scope="col">action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($Categories)) {
                        echo "<strong>Aucun produit dans cette sous catégorie</strong>";
                        } else {
                        foreach ($Categories as $Categorie) { ?>
                            <tr>
                                <th scope="row" ><?php echo $Categorie['categorieID']; ?></th>
                                <td><?php echo $Categorie['nomCategorie']; ?></td>
                                <td><?php echo $Categorie['nomSurcategorie']; ?></td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="?action=operationcategorie&type=edit&idcategorie=<?php echo $Categorie['categorieID']; ?>" class="text-secondary"><button class="btn btn-warning btn-sm edit_button" type="button"><i class="fa fa-edit"></i></button></a></li>
                                        <li>
                                        <form method="POST" action="?action=categorie">
                                            <input type="hidden" name="id" value="<?php echo $Categorie['categorieID']; ?>" />
                                            <button type="submit" class="btn btn-danger btn-sm delete_button" name="delete" ><i class="ti-trash"></i></button>
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