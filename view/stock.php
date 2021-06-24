<?php
require_once('../app/classLoad.php');
session_start();

if (isset($_SESSION['userstock'])) {
    // Legacy calls
    $clientsManager = new ClientManager(PDOFactory::getMysqlConnection());
    $categorieManager = new CategorieManager(PDOFactory::getMysqlConnection());
    $produitManager = new ProduitManager(PDOFactory::getMysqlConnection());

    // objs and vars
    $clientNumber = $clientsManager->getClientsNumber();
    $clients = $clientsManager->getClients();
    $categories = $categorieManager->getCategories();
    $categoriesNumber = $categorieManager->getCategoriesNumber();

    $breadcrumb = new Breadcrumb([
        [
            'class' => 'icon-bar-chart',
            'link' => 'stock.php',
            'title' => '<strong>Stock</strong>'
        ]
    ]);
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
                        <?= $breadcrumb->getBreadcrumb() ?>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
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
                            <?php
                            if ( isset($_SESSION['produit-action-message'])
                            and isset($_SESSION['produit-type-message']) ) {
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
                            <!-- addCategorie box begin -->
                            <div id="addCategorie" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <form id="new-category-stock" class="form-horizontal" action="../controller/CategorieActionController.php" method="post">
                                    <div class="modal-header">
                                        <h3>Ajouter une nouvelle catégorie</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Nom</label>
                                            <div class="controls">
                                                <input id="nomFR" required="required" type="text" name="nomFR" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Forme</label>
                                            <div class="controls">
                                                <input type="text" name="forme" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Couleur</label>
                                            <div class="controls">
                                                <input type="text" name="couleur" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add">
                                                <input type="hidden" name="source" value="stock">
                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- addCategorie box end -->
                            <!-- addProduit box begin -->
                            <div id="addProduit" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <form id="new-product-stock" class="form-horizontal" action="../controller/ProduitActionController.php" method="post">
                                    <div class="modal-header">
                                        <h3>Ajouter un nouveau produit</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Catégorie</label>
                                            <div class="controls">
                                                <select name="idCategorie">
                                                    <?php foreach($categories as $categorie){ ?>
                                                    <option value="<?= $categorie->id() ?>"><?= $categorie->nomFR() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Code</label>
                                            <div class="controls">
                                                <input required="required" id="code" type="text" name="code" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prix Achat</label>
                                            <div class="controls">
                                                <input required="required" id="prixAchat" type="text" name="prixAchat" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prix Vente</label>
                                            <div class="controls">
                                                <input required="required" id="prixVente" type="text" name="prixVente" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prix Vente Min</label>
                                            <div class="controls">
                                                <input required="required" id="prixVenteMin" type="text" name="prixVenteMin" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Quantité</label>
                                            <div class="controls">
                                                <input required="required" id="quantite" type="text" name="quantite" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add">
                                                <input type="hidden" name="source" value="stock">
                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- addProduit box end -->
                            <div class="portlet box grey">
                                <div class="portlet-title">
                                    <h4><i class="icon-reorder"></i>Gestion de stock</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="javascript:;" class="remove"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group pull-left">
                                            <a class="btn green" href="#addProduit" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>
                                                 Nouveau Produit
                                            </a>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <a class="btn blue" href="#addCategorie" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>
                                                 Nouvelle Catégorie
                                            </a>
                                        </div>
                                    </div>
                                    <div class="accordion" id="accordion1">
                                        <?php
                                        foreach($categories as $categorie){
                                            $produits = $produitManager->getProduitsByIdCategorie($categorie->id());
                                        ?>
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?= $categorie->id() ?>">
                                                <strong><?= $categorie->nomFR() ?></strong>
                                                </a>
                                            </div>
                                            <div id="collapse_<?= $categorie->id() ?>" class="accordion-body collapse">
                                                <div class="accordion-inner">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:8%">Qté</th>
                                                                <th style="width:17%">Produit</th>
                                                                <th style="width:10%">PrixAchat</th>
                                                                <th style="width:10%">PrixMinVente</th>
                                                                <th style="width:10%">PrixVente</th>
                                                                <th style="width:7%">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach($produits as $produit){
                                                                $classQuantiteMin = "btn mini";
                                                                $textQuantite = "Normal";
                                                                if ( $produit->quantite() <= 10 ){
                                                                    $classQuantiteMin = "btn mini red";
                                                                    $textQuantite = "Qté.Min";
                                                                }
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td><a><strong><?= $produit->quantite() ?></strong></a></td>
                                                                <td><?= $produit->code() ?></td>
                                                                <td><a><strong><?= number_format($produit->prixAchat(), 2, ',', ' ') ?>&nbsp;DH</strong></a></td>
                                                                <td><a><strong><?= number_format($produit->prixVenteMin(), 2, ',', ' ') ?>&nbsp;DH</strong></a></td>
                                                                <td><a><strong><?= number_format($produit->prixVente(), 2, ',', ' ') ?>&nbsp;DH</strong></a></td>
                                                                <td><a class="<?= $classQuantiteMin ?>"><?= $textQuantite ?></a></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
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
        <!-- ie8 fixes -->
        <!--[if lt IE 9]>
        <script src="../assets/js/excanvas.js"></script>
        <script src="../assets/js/respond.js"></script>
        <![endif]-->
        <script type="text/javascript" src="../assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="../assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../assets/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="../assets/jquery-validation/jquery.validate.js"></script>
        <script src="../assets/js/app.js"></script>
        <script>
            jQuery(document).ready(function() {
                App.setPage("table_managed");
                App.init();
                $("#new-product-stock").validate({
                    rules:{
                       code: {
                           required: true
                       },
                       dimension1: {
                           number: true,
                           required: true
                       },
                       dimension2: {
                           number: true,
                           required: true
                       },
                       prixAchat: {
                           number: true,
                           required: true
                       },
                       prixVenteMin: {
                           number: true,
                           required: true
                       },
                       prixVente: {
                           number: true,
                           required: true
                       },
                       quantite: {
                           number: true,
                           required: true
                       }
                     },
                     errorClass: "error-class",
                     validClass: "valid-class"
                });
                $("#new-category-stock").validate({
                    rules:{
                       nomFR: {
                           required: true
                       }
                     },
                     errorClass: "error-class",
                     validClass: "valid-class"
                });
            });
        </script>
    </body>
</html>
<?php
}
else{
    header("Location:index.php");
}
?>