<?php
require_once('../app/classLoad.php');
session_start();

if (isset($_SESSION['userstock'])) {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <?php include('../include/header.php') ?>
</head>
<body class="fixed-top">
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <?php include("../include/top-menu.php"); ?>
    </div>
    <div class="page-container row-fluid sidebar-closed">
        <?php include("../include/sidebar.php"); ?>
        <div class="page-content">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="dashboard.php">Accueil</a> 
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <i class="icon-wrench"></i>
                                <a>Paramètrages</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--      BEGIN TILES      -->
                <div class="row-fluid">
                    <div class="span12">
                        <div class="tiles">
                            <a href="categories.php">
                            <div class="tile bg-dark-blue">
                                <div class="corner"></div>
                                <div class="tile-body">
                                    <i class="icon-sitemap"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Catégories
                                    </div>
                                </div>
                            </div>
                            </a>
                            <a href="produits.php">
                            <div class="tile bg-blue">
                                <div class="corner"></div>
                                <div class="tile-body">
                                    <i class="icon-barcode"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Produits
                                    </div>
                                </div>
                            </div>
                            </a>
<!--                            <a href="clients-list.php">-->
<!--                            <div class="tile bg-dark-red">-->
<!--                                <div class="corner"></div>-->
<!--                                <div class="tile-body">-->
<!--                                    <i class="icon-group"></i>-->
<!--                                </div>-->
<!--                                <div class="tile-object">-->
<!--                                    <div class="name">-->
<!--                                        Clients-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            </a>-->
<!--                            <a href="fournisseurs.php">-->
<!--                            <div class="tile bg-cyan">-->
<!--                                <div class="corner"></div>-->
<!--                                <div class="tile-body">-->
<!--                                    <i class="icon-truck"></i>-->
<!--                                </div>-->
<!--                                <div class="tile-object">-->
<!--                                    <div class="name">-->
<!--                                        Fournisseurs-->
<!--                                    </div>-->
<!--                                    div class="number"-->
<!--                                        --><?php ////$livraisonsNumber ?>
<!--                                    </div-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            </a>-->
                            <a href="users.php">
                            <div class="tile bg-green">
                                <div class="tile-body">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Utilisateurs
                                    </div>
                                    <div class="number">
                                        
                                    </div>
                                </div>
                            </div>
                            </a>
<!--                            <a href="history-group.php">-->
<!--                            <div class="tile bg-grey">-->
<!--                                <div class="tile-body">-->
<!--                                    <i class="icon-calendar"></i>-->
<!--                                </div>-->
<!--                                <div class="tile-object">-->
<!--                                    <div class="name">-->
<!--                                        Historique-->
<!--                                    </div>-->
<!--                                    <div class="number">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            </a>-->
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEADER-->
            </div>
            <!-- END PAGE CONTAINER-->  
        </div>
        <!-- END PAGE -->       
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        2015 &copy; ImmoERP. Management Application.
        <div class="span pull-right">
            <span class="go-top"><i class="icon-angle-up"></i></span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS -->
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/breakpoints/breakpoints.js"></script>
    <script src="../assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.blockui.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <script src="../assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
    <script type="text/javascript" src="../assets/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="../assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
    <script src="../assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="../assets/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="../assets/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.pulsate.min.js"></script>
    <!-- ie8 fixes -->
    <!--[if lt IE 9]>
    <script src="../assets/js/excanvas.js"></script>
    <script src="../assets/js/respond.js"></script>
    <![endif]-->
    <script src="../assets/js/app.js"></script>
    <script>
        jQuery(document).ready(function() {         
            // initiate layout and plugins
            App.setPage("sliders");  // set current page
            App.init();
        });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<?php
}
else{
    header('Location:index.php');    
}
?>