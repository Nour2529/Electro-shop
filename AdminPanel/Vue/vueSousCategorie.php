<?php 

    if(isset($_SESSION['delete_souscategorie'])){
        if ($_SESSION['delete_souscategorie']!='') {
                echo'<br>';
                echo '<div class="alert alert-danger" role="alert">';
                echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> ';  
                echo '<h3>'.$_SESSION['delete_souscategorie'].'</h3>';  
                                
                echo '</div>';
                $_SESSION['delete_souscategorie']='';
            }
    }

    if(isset($_SESSION['edit_souscategorie'])){
        if ($_SESSION['edit_souscategorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-success" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['edit_souscategorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['edit_souscategorie']='';
        }
    }
    
    if(isset($_SESSION['add_souscategorie'])){
        if ($_SESSION['add_souscategorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-success" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['add_souscategorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['add_souscategorie']='';
        }
    }
?>
<div class="card mt-5">
    <div class="card-body">
        <h4 class="header-title">SousCategorie</h4>
        <a href="index.php?action=operationsouscategorie&type=add"><button type="button" class="btn btn-primary" >Add SousCategorie</button></a>
        <div class="single-table">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom SousCategorie</th>
                            <th scope="col">Nom Categorie</th>
                            <th scope="col">action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($SousCategories)) {
                        echo "<strong>Aucun SousCategorie</strong>";
                        } else {
                        foreach ($SousCategories as $SousCategorie) { ?>
                            <tr>
                                <th scope="row" ><?php echo $SousCategorie['sousCategorieID']; ?></th>
                                <td><?php echo $SousCategorie['nomSousCategorie']; ?></td>
                                <td><?php echo $SousCategorie['nomCategorie']; ?></td>
                                
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="?action=operationsouscategorie&type=edit&idsouscategorie=<?php echo $SousCategorie['sousCategorieID']; ?>" class="text-secondary"><button class="btn btn-warning btn-sm edit_button" type="button"><i class="fa fa-edit"></i></button></a></li>
                                        <li>
                                        <form method="POST" action="?action=souscategorie">
                                            <input type="hidden" name="id" value="<?php echo $SousCategorie['sousCategorieID']; ?>" />
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