<?php 
    if(isset($_SESSION['delete_surcategorie'])){
    if ($_SESSION['delete_surcategorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-danger" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['delete_surcategorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['delete_surcategorie']='';
        }
    }

    if(isset($_SESSION['edit_surcategorie'])){
        if ($_SESSION['edit_surcategorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-success" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['edit_surcategorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['edit_surcategorie']='';
        }
    }
    
    if(isset($_SESSION['add_surcategorie'])){
        if ($_SESSION['add_surcategorie']!='') {
            echo'<br>';
            echo '<div class="alert alert-success" role="alert">';
            echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> ';  
            echo '<h3>'.$_SESSION['add_surcategorie'].'</h3>';  
                            
            echo '</div>';
            $_SESSION['add_surcategorie']='';
        }
    }
?>
<div class="card mt-5">
    <div class="card-body">
        <h4 class="header-title">SurCategorie</h4>
        <a href="index.php?action=addsurcategorie&param=add"><button type="button" class="btn btn-primary" >Add SurCategorie</button></a><br>
        <div class="single-table">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom SurCategorie</th>
                            <th scope="col">action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($SurCategorie)) {
                        echo "<strong>Aucun produit dans cette sous catégorie</strong>";
                        } else {
                        foreach ($SurCategorie as $SurCategorie) { ?>
                            <tr>
                                <th scope="row" ><?php echo $SurCategorie['surcategorieID']; ?></th>
                                <td><?php echo $SurCategorie['nomSurcategorie']; ?></td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="?action=addsurcategorie&param=edit&idsurcategorie=<?php echo $SurCategorie['surcategorieID']; ?>" class="text-secondary"><button class="btn btn-warning btn-sm edit_button" type="button"><i class="fa fa-edit"></i></button></a></li>
                                        <li>
                                        <form method="POST" action="?action=surcategorie">
                                            <input type="hidden" name="id" value="<?php echo $SurCategorie['surcategorieID']; ?>" />
                                            <button type="submit" class="btn btn-danger btn-sm delete_button" name="delete" data-id="<?php echo $SurCategorie['nomSurcategorie']; ?>"><i class="ti-trash"></i></button>
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