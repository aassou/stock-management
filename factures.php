<?php
//classes loading begin
    function classLoad ($myClass) {
        if(file_exists('model/'.$myClass.'.php')){
            include('model/'.$myClass.'.php');
        }
        elseif(file_exists('controller/'.$myClass.'.php')){
            include('controller/'.$myClass.'.php');
        }
    }
    spl_autoload_register("classLoad"); 
    include('config.php');  
    include('lib/pagination.php');
    //classes loading end
    session_start();
    if( isset($_SESSION['userMerlaTrav']) ){
        //Class Managers
        $factureManager = new FactureManager($pdo);
        $factureDetailsManager = new FactureDetailsManager($pdo);
        $produitManager = new ProduitManager($pdo);
        $clientManager = new ClientManager($pdo);
        //obj and vars
        $factures = $factureManager->getFactures();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Stock Management - Management Application</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/metro.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/style_responsive.css" rel="stylesheet" />
    <link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <?php include("include/top-menu.php"); ?>   
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid sidebar-closed">
        <!-- BEGIN SIDEBAR -->
        <?php include("include/sidebar.php"); ?>
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN PAGE CONTAINER-->            
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->           
                        <h3 class="page-title">
                            Gestion des factures 
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="dashboard.php">Accueil</a> 
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <i class="icon-file"></i>
                                <a href="factures.php">Gestion des factures</a>
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN ALERT MESSAGES -->
                         <?php 
                         if( isset($_SESSION['facture-action-message']) 
                         and isset($_SESSION['facture-type-message']) ){ 
                             $message = $_SESSION['facture-action-message'];
                             $typeMessage = $_SESSION['facture-type-message'];
                         ?>
                            <div class="alert alert-<?= $typeMessage ?>">
                                <button class="close" data-dismiss="alert"></button>
                                <?= $message ?>     
                            </div>
                         <?php } 
                            unset($_SESSION['facture-action-message']);
                            unset($_SESSION['facture-type-message']);
                         ?>
                         <!-- END  ALERT MESSAGES -->
                        <div class="portlet">
                            <!-- BEGIN PORTLET BODY -->
                            <div class="portlet-body">
                            <!-- BEGIN Ajouter Article Link -->
                            <a target="_blank" href="controller/LivraisonDetailPrintController.php" class="get-down btn blue pull-right">
                                <i class="icon-print"></i>&nbsp;Bon de livraison
                            </a>
                            <a class="btn green" href="#addArticle" data-toggle="modal" data-id="">
                                Ajouter un article <i class="icon-plus "></i>
                            </a>
                            <!-- END Ajouter Article Link -->
                            <br><br>
                            <!-- BEGIN LivraisonDetail TABLE -->
                            <?php
                            if( 1 ){
                            ?>
                            <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th style="width: 20%">Client</th>
                                <th style="width: 10%">Date</th>
                                <th style="width: 20%">Total</th>
                                <th style="width: 20%">Payé</th>
                                <th style="width: 20%">Reste</th>
                                <?php
                                if ( 
                                    $_SESSION['userMerlaTrav']->profil() == "admin" ||
                                    $_SESSION['userMerlaTrav']->profil() == "manager"
                                    ) {
                                ?>
                                <th style="width: 10%">Actions</th>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php
                            foreach($factures as $facture){
                                $client = $clientManager->getClientById($facture->idClient());
                                $total = $factureDetailsManager->getTotalFactureByIdFacture($facture->id());
                            ?>
                            <tr>
                                <td>
                                    <?= $client->nom() ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($facture->date())) ?>
                                </td>
                                <td>
                                    <?= number_format($total, '2', ',', ' ') ?>&nbsp;DH
                                </td>
                                <td>
                                    <?= number_format(0, '2', ',', ' ') ?>&nbsp;DH
                                </td>
                                <td>
                                    <?= number_format(0, '2', ',', ' ') ?>&nbsp;DH
                                </td>
                                <?php
                                if ( 
                                    $_SESSION['userMerlaTrav']->profil() == "admin" ||
                                    $_SESSION['userMerlaTrav']->profil() == "manager" 
                                    ) {
                                ?>
                                <td class="hidden-phone">
                                    <a class="btn mini green" href="#updateLivraisonDetail<?= $facture->id()?>" data-toggle="modal" data-id="<?=$facture->id()?>">
                                        <i class="icon-refresh "></i>
                                    </a>
                                    <a class="btn mini red" href="#deleteLivraisonDetail<?= $facture->id()?>" data-toggle="modal" data-id="<?=$facture->id()?>">
                                        <i class="icon-remove "></i>
                                    </a>
                                </td>
                                <?php
                                }
                                ?>
                            </tr>
                            <!-- BEGIN  updateLivraisonDetail BOX -->
                            <div id="updateLivraisonDetail<?= $facture->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Modifier les détails de livraison </h3>
                                </div>
                                <div class="modal-body">
                                    <form id="update-detail-livraison-form" class="form-horizontal" action="controller/LivraisonDetailsActionController.php" method="post">
                                        <p>Êtes-vous sûr de vouloir modifier cet article ?</p>
                                        <div class="control-group">
                                            <label class="control-label" for="designation">Désignation</label>
                                            <div class="controls">
                                                <input name="designation" class="m-wrap" type="text" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="quantite">Quantité</label>
                                            <div class="controls">
                                                <input required="required" id="quantite" name="quantite" class="m-wrap" type="text" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="prixUnitaire">Prix Unitaire</label>
                                            <div class="controls">
                                                <input required="required" id="prixUnitaire" name="prixUnitaire" class="m-wrap" type="text" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <input type="hidden" name="action" value="update" />
                                            <input type="hidden" name="idLivraisonDetail" value="<?= $facture->id() ?>" />
                                            <div class="controls">  
                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END  update LivraisonDetail   BOX -->
                            <!-- BEGIN  delete LivraisonDetail BOX -->
                            <div id="deleteLivraisonDetail<?= $facture->id()?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Supprimer Article</h3>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal loginFrm" action="controller/LivraisonDetailsActionController.php" method="post">
                                        <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                                        <div class="control-group">
                                            <input type="hidden" name="action" value="delete" />
                                            <input type="hidden" name="idLivraisonDetail" value="<?= $facture->id() ?>" />
                                            <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                            <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END delete LivraisonDetail BOX -->
                            <?php
                            }//end foreach
                            ?>
                            </table>
                            <!--table class="table table-striped table-bordered table-advance table-hover">
                                <tbody>
                                    <tr>
                                        <th style="width: 70%"><strong>Grand Total</strong></th>
                                        <th style="width: 30%"><strong><a><?php //number_format(0, 2, ',', ' ') ?>&nbsp;DH</a></strong></th>
                                    </tr>
                                </tbody>
                            </table-->
                            <?php
                            }//end if
                            ?>
                            <!-- END LivraisonDetail TABLE -->
                            </div>
                            <!-- END  PORTLET BODY  -->
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT -->
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
    <script src="assets/js/jquery-1.8.3.min.js"></script>   
    <script src="assets/breakpoints/breakpoints.js"></script>   
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>        
    <script src="assets/js/jquery.blockui.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
    <!-- ie8 fixes -->
    <!--[if lt IE 9]>
    <script src="assets/js/excanvas.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->    
    <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="assets/jquery-validation/jquery.validate.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript" src="script.js"></script>        
    <script>
        jQuery(document).ready(function() {         
            // initiate layout and plugins
            //App.setPage("table_editable");
            App.init();
        });
        $("#add-detail-livraison-form").validate({
            rules:{
                quantite:{
                    number: true,
                    required:true
                },
                prixUnitaire:{
                    number: true,
                    required:true
                }
            },
            errorClass: "error-class",
            validClass: "alid-class"
        });
        $("#update-detail-livraison-form").validate({
            rules:{
                quantite:{
                    number: true,
                    required:true
                },
                prixUnitaire:{
                    number: true,
                    required:true
                }
            },
            errorClass: "error-class",
            validClass: "valid-class"
        });
    </script>
</body>
<!-- END BODY -->
</html>
<?php
}
/*else if(isset($_SESSION['userMerlaTrav']) and $_SESSION->profil()!="admin"){
    header('Location:dashboard.php');
}*/
else{
    header('Location:index.php');    
}
?>