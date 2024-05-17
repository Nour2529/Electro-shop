<div class="card mt-5">
    <div class="card-body">
        <h4 class="header-title">User</h4>
        
        <div class="single-table">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom </th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Role</th>
                            <th scope="col">Changer Role</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($Users)) {
                        echo "<strong>Aucun utilisateurs </strong>";
                        } else {
                        foreach ($Users as $User) { ?>
                            <tr>
                                <th scope="row" ><?php echo $User['userID']; ?></th>
                                <td><?php echo $User['nom']; ?></td>
                                <td><?php echo $User['prenom']; ?></td>
                                <td><img src=<?php echo './'.$User['chemin']; ?> class="img-fluid" width="50"> </td>
                                <td><?php echo $User['mail']; ?></td>
                                <td><?php if($User['niveau_accreditation']==1){
                                    echo "admin"; }
                                    else{
                                        echo "user" ;}?>
                                </td>
                                <td>
                                <form action="index.php?action=user" method="post">
                                    <input type="hidden" name="id" value="<?php echo $User['userID']; ?>">
                                    <button type="submit" class="btn btn-outline-primary" name="admin">Admin</button>
                                    <button type="submit" class="btn btn-outline-secondary" name="user">User</button>
                                </form>
                                </td>
                                
                            </tr>
                        <?php }} ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div>
   
