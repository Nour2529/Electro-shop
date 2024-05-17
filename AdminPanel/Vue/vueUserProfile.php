<body>




</table>
<main class="page login-page">
        <section class="text-monospace clean-block clean-info dark" >
            <div class="container">
            <?php
if (!empty($code)) {
    if ($code == UserProfile::PASSWORD_UPDATE_SUCCESS) {
        echo'<br>';
        echo '<div class="alert alert-success" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Mot de passe modifié avec succès !</h3>';  
                        
        echo '</div>';
        $code=0;
        
    }
    if ($code == UserProfile::PASSWORD_UPDATE_BAD_OLD_PASSWORD) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Erreur: Vérifiez votre mot de passe actuel !</h3>';  
                        
        echo '</div>';
        $code=0;
 
    }
    if ($code == UserProfile::PASSWORD_UPDATE_FORM_INVALID) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Erreur: Le formulaire est incomplet !</h3>';  
                        
        echo '</div>';
        $code=0;

       
    }
    if ($code == UserProfile::PASSWORD_UPDATE_USER_ERROR) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Erreur lors du changement du mot de passe. Veuillez reesayer !</h3>';  
                        
        echo '</div>';
        $code=0;
        
    }
    if (isset($_SESSION['profilePicture'])) {
        if($_SESSION['profilePicture']!='')
        {
        echo'<br>';
        echo '<div class="alert alert-info" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>'.$_SESSION['profilePicture'].'</h3>';  
                        
        echo '</div>';
        $_SESSION['profilePicture']='';
        }
        
    }
}
?>
                <div class="block-heading">
                    <h2 class="text-secondary">Informations sur le profil</h2>
                    
                    
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                    <img class="rounded mx-auto d-block" width=50% src=<?= $listUserProfile['chemin'] ?> alt="user_picture" title="user_picture"/><br><br>
                    <form enctype="multipart/form-data" action="?action=userProfile" method="post">
                    <fieldset>
                        <legend>Change profile picture</legend>
                        <p>
                            <label for="fichier_a_uploader" title="Choose a picture">Change in 2 steps:</label>
                            <!--                        <input type="hidden" name="MAX_FILE_SIZE" value="-->
                            <?php //echo MAX_SIZE; ?><!--"/>-->
                            <input type="file" class="form-control" name="fichier" id="fichier_a_uploader"/>
                            <input type="submit" class="form-control" name="submit" value="Update picture"/>
                        </p>
                    </fieldset>
                    </form>

                    </div>
                    
                    <div class="col-md-6">
                        
                        <div class="getting-started-info">
                            <p style="font-size: 1.4em;">Nom : <strong><?= $listUserProfile['nom'] ?></strong></p>
                            <p style="font-size: 1.4em;">Prenom : <strong><?= $listUserProfile['prenom'] ?></strong>&nbsp;</p>
                            <p style="font-size: 1.4em;">Role : <strong><?php if($listUserProfile['niveau_accreditation']==1){
                                echo "administrateur";
                            } 
                            else{
                                echo "utilisateur";
                            }?></strong>&nbsp;</p>
                            <p style="font-size: 1.4em;">Email: <strong><?= $listUserProfile['mail'] ?></strong>&nbsp;</p><br><br><br>
                            <form enctype="multipart/form-data" action="?action=userProfile" method="post">
                                <fieldset>
                                    <legend>Change password</legend>
                                    <p>
                                        <label for="old_password" title="Current password">Ancien mot de passe :</label>
                                        <input type="password" class="form-control"  name="old_password" id="old_password"/>
                                        <label for="new_password" title="Choose a new password">Nouveau mot de passe:</label>
                                        <input type="password" class="form-control" name="new_password" id="new_password"/><br>
                                        
                                        <input type="submit" class="form-control"  name="submit_password" value="Update password"/>
                                    </p>
                                </fieldset>
                            </form>
                            
                        </div>
                        
                       

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>