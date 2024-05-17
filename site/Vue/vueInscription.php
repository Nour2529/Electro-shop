<?php

?>

    <div id="registerForm">
<?php if ($register_code == Register::REGISTER_OK) { 
    echo'<br>';
        echo '<div class="alert alert-success" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Inscription reussie !</h3>';
         
                        
        echo '</div>';
 } else {
    if ($register_code == Register::FORM_INPUTS_ERROR) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Erreur lors de la saisie du formulaire (champ(s) manquant(s))!</h3>';  
                        
        echo '</div>';
        $register_code=0;
        
    } else if ($register_code == Register::INVALID_MAIL_FORMAT) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo "<h3>Format de l'adresse mail incorrect!</h3>";  
                        
        echo '</div>';
        $register_code=0;

    } else if ($register_code == Register::ALREADY_EXIST) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo "<h3>Adresse mail déjà utilisée!</h3>";  
                        
        echo '</div>';
        $register_code=0;

    } else if ($register_code == Register::DATABASE_ERROR) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo "<h3>Base de données indisponible actuellement!</h3>";  
                        
        echo '</div>';

    }
    ?>
<div class="section">    
<div class="container">
  <div class="row">
<legend class="h3">Créer un compte</legend>
        <form action="?action=inscription" method="POST">
        <div class="form-group">
        Nom : <input type="text"  class="form-control" name="nom" placeholder="Nom" />

        Prénom : <input type="text" class="form-control" name="prenom" placeholder="Prénom"/>
    
        Adresse e-mail : <input type="text"  class="form-control" name="mail" placeholder="example@mail.com"/>
       
        Mot de passe : <input type="password" class="form-control" name="password" placeholder="Mot de passe"/>
        
        
        <input class="btn btn-primary" type="submit" value="Envoyer"/>
    </form>
    </div>
    </div>
    </div>
    
    </div>



<?php } ?>