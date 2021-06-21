<?php
require_once('../app/classLoad.php');
include('config.php');
session_start();

if (isset($_SESSION['userstock'])) {
    $categorieManager = new CategorieManager(PDOFactory::getMysqlConnection());
    $categories = $categorieManager->getCategories();
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
                        <h3 class="page-title">
                            Gestion des catégories
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-dashboard"></i>
                                <a href="dashboard.php">Accueil</a> 
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <i class="icon-wrench"></i>
                                <a href="configuration.php">Paramètrages</a>
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <i class="icon-sitemap"></i>
                                <a>Catégories</a>
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <?php 
                         if ( isset($_SESSION['categorie-action-message'])
                         and isset($_SESSION['categorie-type-message']) ) {
                             $message = $_SESSION['categorie-action-message'];
                             $typeMessage = $_SESSION['categorie-type-message']; 
                         ?>
                            <div class="alert alert-<?= $typeMessage ?>">
                                <button class="close" data-dismiss="alert"></button>
                                <?= $message ?>     
                            </div>
                         <?php } 
                            unset($_SESSION['categorie-action-message']);
                            unset($_SESSION['categorie-type-message']);
                         ?>
                         <!-- addCategorie box begin -->
                        <div id="addCategorie" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                            <form class="form-horizontal" action="../controller/CategorieActionController.php" method="post">
                                <div class="modal-header">
                                    <h3>Ajouter une nouvelle catégorie</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="control-group">
                                        <label class="control-label">Nom</label>
                                        <div class="controls">
                                            <input type="text" name="nomFR" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="control-group">
                                        <div class="controls">  
                                            <input type="hidden" name="action" value="add">
                                            <input type="hidden" name="source" value="categories">
                                            <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                            <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- addCategorie box end -->  
                        <div class="portlet box light-grey">
                            <div class="portlet-title">
                                <h4>Liste des catégories</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="clearfix">
                                    <div class="btn-group pull-left">
                                        <a class="btn blue" href="#addCategorie" data-toggle="modal">
                                            <i class="icon-plus-sign"></i>
                                             Nouvelle Catégorie
                                        </a>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th style="width:85%">Nom</th>
                                            <th style="width:15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($categories as $categorie){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?= $categorie->nomFR() ?></td>
                                            <td>
                                                <a href="#update<?= $categorie->id() ?>" data-toggle="modal" data-id="<?= $categorie->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                <a href="#delete<?= $categorie->id() ?>" data-toggle="modal" data-id="<?= $categorie->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                            </td>
                                        </tr>
                                        <!-- update box begin-->
                                        <div id="update<?= $categorie->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h3>Modifier Informations Catégorie </h3>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="../controller/CategorieActionController.php" method="post">
                                                    <p>Êtes-vous sûr de vouloir modifier les infos de la catégorie <strong><?= $categorie->nomFR() ?></strong> ?</p>
                                                    <div class="control-group">
                                                        <label class="control-label">Nom</label>
                                                        <div class="controls">
                                                            <input type="text" name="nomFR" value="<?= $categorie->nomFR() ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <input type="hidden" name="idCategorie" value="<?= $categorie->id() ?>" />
                                                        <input type="hidden" name="action" value="update" />
                                                        <input type="hidden" name="source" value="categories" />
                                                        <div class="controls">  
                                                            <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                            <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- update box end -->
                                        <!-- delete box begin-->
                                        <div id="delete<?= $categorie->id();?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h3>Supprimer Catégorie</h3>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal loginFrm" action="../controller/CategorieActionController.php" method="post">
                                                    <p>Êtes-vous sûr de vouloir supprimer la catégorie <strong><?= $categorie->nomFR() ?></strong> ?</p>
                                                    <p style="color:red"><strong>Attention : Cette action va supprimer la catégorie ainsi que ces produits !<strong></p>
                                                    <div class="control-group">
                                                        <label class="right-label"></label>
                                                        <input type="hidden" name="idCategorie" value="<?= $categorie->id() ?>" />
                                                        <input type="hidden" name="action" value="delete" />
                                                        <input type="hidden" name="source" value="categories" />
                                                        <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                        <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- delete box end -->     
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <?= date('Y') ?> &copy; Stock Management Application.
        <div class="span pull-right">
            <span class="go-top"><i class="icon-angle-up"></i></span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS -->
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/breakpoints/breakpoints.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.blockui.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <!-- ie8 fixes -->
    <!--[if lt IE 9]>
    <script src="../assets/js/excanvas.js"></script>
    <script src="../assets/js/respond.js"></script>
    <![endif]-->    
    <script type="text/javascript" src="../assets/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="../assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="../assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="../assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
    <script type="text/javascript" src="../assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        jQuery(document).ready(function() {         
            // initiate layout and plugins
            App.setPage("table_managed");
            App.init();
        });
    </script>
    <style>
        #addCategorie .modal-body {
            overflow-y: visible; 
        }
    </style>
</body>
<!-- END BODY -->
</html>
<?php
}
else{
    header("Location:index.php");
}
?>