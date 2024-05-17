
<html class="no-js" lang="en">

<head>
    <?php require_once('entete.php')?>
</head>

<body>

    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="index.php?action=logguer" method="post">
                    <div class="login-form-head">
                        <h4>Bienvenue</h4>
                        
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="email">Email address</label><br>
                            <input type="mail" id="email" name="email" value="<?php echo $email ?>">
                            <i class="ti-email"></i>
                            <div class="text-danger"><?php echo $erreur['email'] ?></div>
                        </div>
                        <div class="form-gp">
                            <label for="password">Password</label><br>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"><?php echo $erreur['password'] ?></div>
                        </div>
                        <br>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="login">Log in <i class="ti-arrow-right"></i></button>
                            
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <?php require_once('script.php')?>
</body>

</html>