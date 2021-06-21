<?php
require_once('../app/classLoad.php');
include('config.php');
session_start();

if (isset($_SESSION['userstock'])) {
    //post processing
    $idProduit = htmlentities($_GET['idProduit']);
    $source = htmlentities($_GET['source']);
    //Class Managers
    $clientsManager = new ClientManager(PDOFactory::getMysqlConnection());
    $categorieManager = new CategorieManager(PDOFactory::getMysqlConnection());
    $produitManager = new ProduitManager(PDOFactory::getMysqlConnection());
    //objs and vars
    $clientNumber = $clientsManager->getClientsNumber();
    $clients = $clientsManager->getClients();
    $categories = $categorieManager->getCategories();
    $categoriesNumber = $categorieManager->getCategoriesNumber();
    $produit = $produitManager->getProduitById($idProduit);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
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
                                    <i class="icon-dashboard"></i>
                                    <a href="dashboard.php">Accueil</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li>
                                    <i class="icon-barcode"></i>
                                    <a href="produits.php">Produits</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li>
                                    <strong>Suppression : <?= strtoupper($produit->code()) ?></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="tab-pane active" id="tab_1">
                                <?php if( isset($_SESSION['produit-action-message'])
                                    and isset($_SESSION['produit-type-message']) ){
                                    $message = $_SESSION['produit-action-message'];
                                    $typeMessage = $_SESSION['produit-type-message'];
                                    ?>
                                    <div class="alert alert-<?= $typeMessage ?>">
                                        <button class="close" data-dismiss="alert"></button>
                                        <?= $message ?>
                                    </div>
                                <?php }
                                unset($_SESSION['produit-action-message']);
                                unset($_SESSION['produit-type-message']);
                                ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <h4>Supprimer Produit <?= $produit->code() ?></h4>
                                    </div>
                                    <div class="portlet-body form">
                                        <form action="../controller/ProduitActionController.php" method="POST" id="clientForm" class="horizontal-form">
                                            <h3>Êtes-vous sûr de vouloir supprimer le produit <?= $produit->code() ?> ?</h3>
                                            <div class="form-actions">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="idProduit" value="<?= $produit->id() ?>">
                                                <input type="hidden" name="source" value="produits">
                                                <a href="produits.php" class="btn">Non</a>
                                                <button type="submit" class="btn red">Oui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <?= date('Y') ?> &copy; Stock Management Application.
            <div class="span pull-right">
                <span class="go-top"><i class="icon-angle-up"></i></span>
            </div>
        </div>
        <script src="../assets/js/jquery-1.8.3.min.js"></script>
        <script src="../assets/breakpoints/breakpoints.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.blockui.js"></script>
        <script src="../assets/js/jquery.cookie.js"></script>
        <script src="../assets/fancybox/source/jquery.fancybox.pack.js"></script>
        <!-- ie8 fixes -->
        <!--[if lt IE 9]>
        <script src="../assets/js/excanvas.js"></script>
        <script src="../assets/js/respond.js"></script>
        <![endif]-->
        <script type="text/javascript" src="../assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="../assets/jquery-validation/jquery.validate.js"></script>
        <script type="text/javascript" src="../assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../assets/data-tables/DT_bootstrap.js"></script>
        <script src="../assets/js/app.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                //App.setPage("table_editable");
                App.init();
            });
        </script>
    </body>
</html>
<?php
} else {
    header('Location:index.php');
}
