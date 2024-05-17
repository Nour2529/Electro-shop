
<html >
	<head>
		<?php require("vue/entete.php");?>
    </head>
<body>
    
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php include("vue/sidebarMenu.php");?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            
            <!-- page title area start -->
            <?php include("vue/pageArea.php");?>
            <!-- page title area end -->
            <!-- CONTENU -->
            <div class="main-content-inner" id="contenu">
                <?= $contenu ?>
            </div>
            <!-- /CONTENU -->
        </div>
        <!-- main content area end -->
        <!-- FOOTER -->
        
                <?php include("vue/footer.php");?>
            
    </div>
    <!-- page container area end -->
    
    <!-- /FOOTER -->
</div>
<?php include("vue/script.php");?>
</body>
</html>