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
        $categorieManager = new CategorieManager($pdo);
        $produitManager = new ProduitManager($pdo);
        //objs and vars
        $categories = $categorieManager->getCategories();
        $produits = $produitManager->getProduits();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Rachid Bekkali - Management Application</title>
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
    <link rel="stylesheet" href="assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
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
                            Gestion des produits
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
                                <i class="icon-barcode"></i>
                                <a>Gestion des produits</a>
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
                            <form class="form-horizontal" action="controller/CategorieActionController.php" method="post">
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
                                    <div class="control-group">
                                        <label class="control-label">Longueur</label>
                                        <div class="controls">
                                            <input type="text" name="longueur" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Largeur</label>
                                        <div class="controls">
                                            <input type="text" name="largeur" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Hauteur</label>
                                        <div class="controls">
                                            <input type="text" name="hauteur" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Diamétre</label>
                                        <div class="controls">
                                            <input type="text" name="diametre" />
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
                                    <div class="control-group">
                                        <label class="control-label">الاسم</label>
                                        <div class="controls">
                                            <input type="text" name="nomAR" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="control-group">
                                        <div class="controls">  
                                            <input type="hidden" name="action" value="add">    
                                            <input type="hidden" name="source" value="produits">
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
                            <form class="form-horizontal" action="controller/ProduitActionController.php" method="post">
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
                                            <input type="text" name="code" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Dimension</label>
                                        <div class="controls">
                                            <input required="required" id="dimension1" class="span4" type="text" name="dimension1" />
                                            <input required="required" id="dimension2" class="span4" type="text" name="dimension2" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Diametre</label>
                                        <div class="controls">
                                            <input type="text" name="diametre" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Forme</label>
                                        <div class="controls">
                                            <input type="text" name="forme" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Prix Achat</label>
                                        <div class="controls">
                                            <input type="text" name="prixAchat" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Prix Vente</label>
                                        <div class="controls">
                                            <input type="text" name="prixVente" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Prix Vente Min</label>
                                        <div class="controls">
                                            <input type="text" name="prixVenteMin" />
                                        </div>  
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Quantité</label>
                                        <div class="controls">
                                            <input type="text" name="quantite" />
                                        </div>  
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Poids</label>
                                        <div class="controls">
                                            <input type="text" name="poids" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="control-group">
                                        <div class="controls">  
                                            <input type="hidden" name="action" value="add">    
                                            <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                            <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- addProduit box end -->
                        <div class="portlet box light-grey">
                            <div class="portlet-title">
                                <h4>Liste des produits</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="reload"></a>
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
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th style="width:8%">Catégorie</th>
                                            <th style="width:10%">Produit</th>
                                            <th style="width:10%">Dimensions</th>
                                            <th style="width:8%">Diamétre</th>
                                            <th style="width:8%">Forme</th>
                                            <th style="width:10%">PrixAchat</th>
                                            <th style="width:10%">PrixVente</th>
                                            <th style="width:10%">PrixVenteMin</th>
                                            <th style="width:8%">Quantité</th>
                                            <th style="width:8%">Poids</th>
                                            <th style="width:10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($produits as $produit){
                                            $categorie = $categorieManager->getCategorieById($produit->idCategorie());
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?= $categorie->nomFR() ?></td>
                                            <td><?= $produit->code().($produit->dimension1()+0)."x".($produit->dimension1()+0) ?></td>
                                            <td><?= ($produit->dimension1()+0)."x".($produit->dimension1()+0) ?></td>
                                            <td><?= $produit->diametre() ?></td>
                                            <td><?= $produit->forme() ?></td>
                                            <td><?= number_format($produit->prixAchat(), 2, ',', ' ') ?></td>
                                            <td><?= number_format($produit->prixVente(), 2, ',', ' ') ?></td>
                                            <td><?= number_format($produit->prixVenteMin(), 2, ',', ' ') ?></td>
                                            <td><?= $produit->quantite() ?></td>
                                            <td><?= $produit->poids() ?></td>
                                            <td>
                                                <a href="stock-update-produit.php?idProduit=<?= $produit->id() ?>&source=produits" class="btn mini green"><i class="icon-refresh"></i></a>
                                                <a href="stock-delete-produit.php?idProduit=<?= $produit->id() ?>&source=produits" class="btn mini red"><i class="icon-remove"></i></a>
                                            </td>    
                                        </tr>   
                                        <?php
                                        }//end for
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
        <?= date('Y') ?> &copy; Rachid Bekkali.
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
    <!-- ie8 fixes -->
    <!--[if lt IE 9]>
    <script src="assets/js/excanvas.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->    
    <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
    <script src="assets/js/app.js"></script>        
    <script>
        jQuery(document).ready(function() {         
            // initiate layout and plugins
            App.setPage("table_managed");
            App.init();
        });
        $('#idCategorieChoice').change(function(){
            var idCategorie = $(this).val();
            $.post("product-choice.php", {"idCategorie" : idCategorie});
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