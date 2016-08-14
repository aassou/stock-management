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
        $clientsManager = new ClientManager($pdo);
        $categorieManager = new CategorieManager($pdo);
        $produitManager = new ProduitManager($pdo);
        //objs and vars
        $clientNumber = $clientsManager->getClientsNumber();
        $clients = $clientsManager->getClients();
        $categories = $categorieManager->getCategories();
        $categoriesNumber = $categorieManager->getCategoriesNumber();
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
                            Gestion de stock
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-dashboard"></i>
                                <a href="dashboard.php">Accueil</a> 
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <i class="icon-bar-chart"></i>
                                <a>Gestion de stock</a>
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN ACCORDION PORTLET-->
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
                                            <input type="text" name="dimension" />
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
                                    for($i=0; $i<$categoriesNumber; $i++){
                                        $produits = $produitManager->getProduitsByIdCategorie($categories[$i]->id()); 
                                    ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?= $i+1 ?>">
                                            <strong><?= $categories[$i]->nomFR() ?></strong>
                                            </a>
                                        </div>
                                        <div id="collapse_<?= $i+1 ?>" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:10%">Actions</th>
                                                            <th style="width:10%">Qté</th>
                                                            <th style="width:20%">Produit</th>
                                                            <th style="width:10%">Prix Achat</th>
                                                            <th style="width:10%">Prix Min.Vente</th>
                                                            <th style="width:10%">Prix Vente</th>
                                                            <th style="width:10%">Marge</th>
                                                            <th style="width:20%">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        foreach($produits as $produit){
                                                            $classQuantiteMin = "btn mini"; 
                                                            $textQuantite = "Normal";
                                                            if ( $produit->quantite() <= 50 ){
                                                                $classQuantiteMin = "btn mini red";
                                                                $textQuantite = "Qté.Min";
                                                            }    
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td>
                                                                <!--a href="#update<?php //$produit->id() ?>" data-toggle="modal" data-id="<?php //$produit->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a-->
                                                                <a href="stock-update-produit.php?idProduit=<?= $produit->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                                <a href="stock-delete-produit.php?idProduit=<?= $produit->id() ?>" data-toggle="modal" data-id="<?= $produit->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                            </td>    
                                                            <td><?= $produit->quantite() ?></td>
                                                            <td><?= $produit->code() ?></td>
                                                            <td><?= number_format($produit->prixAchat(), 2, ',', ' ') ?></td>
                                                            <td><?= number_format($produit->prixVenteMin(), 2, ',', ' ') ?></td>
                                                            <td><?= number_format($produit->prixVente(), 2, ',', ' ') ?></td>
                                                            <td><?= number_format($produit->prixVente()-$produit->prixAchat(), 2, ',', ' ') ?></td>
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
                        <!-- END ACCORDION PORTLET-->      
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
    <script src="assets/js/app.js"></script>        
    <script>
        jQuery(document).ready(function() {         
            // initiate layout and plugins
            App.setPage("table_managed");
            App.init();
        });
    </script>
</body>
<!-- END BODY -->
</html>
<?php
}
else{
    header("Location:index.php");
}
?>