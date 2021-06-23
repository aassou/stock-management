<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userstock']) ) {
    // create Controller
    $warehouseActionController = new AppController('warehouse');
    // Legacy calls
    $clientsManager = new ClientManager(PDOFactory::getMysqlConnection());
    $categorieManager = new CategorieManager(PDOFactory::getMysqlConnection());
    $produitManager = new ProduitManager(PDOFactory::getMysqlConnection());
    // objs and vars
    $clientNumber = $clientsManager->getClientsNumber();
    $clients = $clientsManager->getClients();
    $categories = $categorieManager->getCategories();
    $categoriesNumber = $categorieManager->getCategoriesNumber();
    // get objects
    $warehouses = $warehouseActionController->getAll();
    // breadcurmb
    $breadcrumb = new Breadcrumb(
        [
            [
                'class' => 'icon-bar-chart',
                'link' => 'warehouse.php',
                'title' => 'Stock'
            ]
        ]
    );
    /*$warehousesNumber = $warehouseActionController->getAllNumber(); 
    $p = 1;
    if ( $warehousesNumber != 0 ) {
        $warehousePerPage = 20;
        $pageNumber = ceil($warehousesNumber/$warehousePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $warehousePerPage;
        $pagination = paginate('warehouse.php', '?p=', $pageNumber, $p);
        $warehouses = $warehouseActionController->getAllByLimits($begin, $warehousePerPage);
    }*/ 
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
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addWarehouse box begin -->
                            <div id="addWarehouse" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Warehouse</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">ProductId</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="productId" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Quantity</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="quantity" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="warehouse" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addWarehouse box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Warehouses</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addWarehouse" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Warehouse
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10">ProductId</th>
                                                <th class="t10">Quantity</th>
                                                <th class="t10 hidden-phone">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $warehousesNumber != 0 ) { 
                                            foreach ( $warehouses as $warehouse ) {
                                            ?>
                                            <tr>
                                                <td><?= $warehouse->getProductId() ?></td>
                                                <td><?= $warehouse->getQuantity() ?></td>
                                                <td class="hidden-phone">
                                                    <a href="#updateWarehouse<?= $warehouse->getId() ?>" data-toggle="modal" data-id="<?= $warehouse->getId() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="#deleteWarehouse<?= $warehouse->getId() ?>" data-toggle="modal" data-id="<?= $warehouse->getId() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                </td>
                                            </tr> 
                                            <!-- updateWarehouse box begin -->
                                            <div id="updateWarehouse<?= $warehouse->getId() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Warehouse</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">ProductId</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="productId"  value="<?= $warehouse->getProductId() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Quantity</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="quantity"  value="<?= $warehouse->getQuantity() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $warehouse->getId() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="warehouse" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateWarehouse box end --> 
                                            <!-- deleteWarehouse box begin -->
                                            <div id="deleteWarehouse<?= $warehouse->getId() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Warehouse</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Warehouse : <?= $warehouse->getProductId() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $warehouse->getId() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="warehouse" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteWarehouse box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($warehousesNumber != 0){ echo $pagination; }*/ ?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>     
        <script>jQuery(document).ready( function(){ App.setPage("table_managed"); App.init(); } );</script>
    </body>
</html>
<?php
}
else{
    header('Location:../index.php');    
}
?>
