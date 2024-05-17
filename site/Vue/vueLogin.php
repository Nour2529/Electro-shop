<?php
$titre = "Formulaire d'authentification";
?>
<div id="loginForm">
    <?php if ($login_code == UserLogin::LOGIN_OK) { 
        echo'<br>';
        echo '<div class="alert alert-success" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Vous êtes connecté !</h3>';  
                        
        echo '</div>';

  } else {
    if ($login_code == UserLogin::FORM_INPUTS_ERROR) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo '<h3>Erreur lors de la saisie du formulaire (champ(s) manquant(s))!</h3>';  
                        
        echo '</div>';
        $login_code=0;

    } else if ($login_code == UserLogin::INVALID_MAIL_FORMAT) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo "<h3>Format de l'adresse mail incorrect!</h3>";  
                        
        echo '</div>';
        $login_code=0;

    } else if ($login_code == UserLogin::DOESNOT_EXIST) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo "<h3>L'utilisateur n'existe pas</h3>";  
                        
        echo '</div>';
        $login_code=0;

    } else if ($login_code == UserLogin::BAD_PASSWORD) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo "<h3>Mot de passe incorrect!</h3>";  
                        
        echo '</div>';
        $login_code=0;


    } else if ($login_code == UserLogin::DATABASE_ERROR) {
        echo'<br>';
        echo '<div class="alert alert-danger" role="alert">';
        echo'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> ';  
        echo "<h3>Base de données indisponible actuellement!</h3>";  
                        
        echo '</div>';
        $login_code=0;

    }
    ?>


<div class="section">    
<div class="container">
  <div class="row">
<legend class="h3">connecter</legend>
<form  action="index.php?action=logguer" method="post">
    <div class="form-group">
	<p>mail<input class="form-control" type="mail" name="mail" required></p>
	<p>Mot de passe(8 charactere minimuim)<input type="password" class="form-control" name="password"  required></p>

	
	</div>
      
      <button type="submit" class="btn btn-default">connecter</button>
    </form>
    </div>
    </div>
    
    </div>
    <?php } ?>