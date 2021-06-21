<?php
require('../app/classLoad.php');
session_start();

if (isset($_SESSION['userstock'])) {
    $codeSale = htmlentities($_GET['codeSale']);
    //create Controller
    $SaleDetailActionController = new SaleDetailActionController('SaleDetail');
    // Legacy Calls
    $productManager = new ProduitManager(PDOFactory::getMysqlConnection());
    //get objects
    $SaleDetails = $SaleDetailActionController->getAllByCode($codeSale);
    $products = $productManager->getProduits();

    //breadcurmb
    $breadcrumb = new Breadcrumb(
        [
            [
                'class' => 'icon-signal',
                'link' => 'Sale.php',
                'title' => 'Vente'
            ],
            [
                'class' => '',
                'link' => '',
                'title' => '<strong>Détails Vente</strong>'
            ]
        ]
    );
    /*$SaleDetailsNumber = $SaleDetailActionController->getAllNumber(); 
    $p = 1;
    if ( $SaleDetailsNumber != 0 ) {
        $SaleDetailPerPage = 20;
        $pageNumber = ceil($SaleDetailsNumber/$SaleDetailPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $SaleDetailPerPage;
        $pagination = paginate('SaleDetail.php', '?p=', $pageNumber, $p);
        $SaleDetails = $SaleDetailActionController->getAllByLimits($begin, $SaleDetailPerPage);
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
                            <!-- addSaleDetail box begin -->
                            <div id="addSaleDetail" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Opération Vente</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Produit</label>
                                            <div class="controls">
                                                <select name="productId">
                                                    <?php foreach ($products as $product) { ?>
                                                        <option value="<?= $product->id() ?>"><?= $product->code() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Quantité</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="quantity" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Prix</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="price" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Description</label>
                                            <div class="controls">
                                                <textarea type="text" name="description"></textarea>
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="SaleDetail" />
                                                <input type="hidden" name="codeSale" value="<?= $codeSale ?>" />
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addSaleDetail box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Opération Vente</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addSaleDetail" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Opération Vente
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10">Produit</th>
                                                <th class="t10">Quantité</th>
                                                <th class="t10">Prix</th>
                                                <th class="t10">Total</th>
                                                <th class="t10">Description</th>
                                                <th class="t10 hidden-phone">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $SaleDetailsNumber != 0 ) { 
                                            foreach ($SaleDetails as $SaleDetail) {
                                                $product = $productManager->getProduitById($SaleDetail->getProductId());
                                            ?>
                                            <tr>
                                                <td><?= $product->code() ?></td>
                                                <td><?= $SaleDetail->getQuantity() ?></td>
                                                <td><?= Utils::numberFormatMoney($SaleDetail->getPrice()) ?></td>
                                                <td><?= Utils::numberFormatMoney($SaleDetail->getPrice() * $SaleDetail->getQuantity()) ?></td>
                                                <td><?= $SaleDetail->getDescription() ?></td>
                                                <td class="hidden-phone">
                                                    <a href="#updateSaleDetail<?= $SaleDetail->getId() ?>" data-toggle="modal" data-id="<?= $SaleDetail->getId() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="#deleteSaleDetail<?= $SaleDetail->getId() ?>" data-toggle="modal" data-id="<?= $SaleDetail->getId() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                </td>
                                            </tr> 
                                            <!-- updateSaleDetail box begin -->
                                            <div id="updateSaleDetail<?= $SaleDetail->getId() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Opération Vente</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Produit</label>
                                                            <div class="controls">
                                                                <select name="productId">
                                                                    <option value="<?= $product->id() ?>"><?= $product->code() ?></option>
                                                                    <option disabled="disabled">-----------------------</option>
                                                                    <?php foreach ($products as $product) { ?>
                                                                        <option value="<?= $product->id() ?>"><?= $product->code() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Quantité</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="quantity"  value="<?= $SaleDetail->getQuantity() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Prix</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="price"  value="<?= $SaleDetail->getPrice() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Description</label>
                                                            <div class="controls">
                                                                <input type="text" name="description"  value="<?= $SaleDetail->getDescription() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $SaleDetail->getId() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="SaleDetail" />
                                                                <input type="hidden" name="codeSale" value="<?= $codeSale ?>" />
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateSaleDetail box end --> 
                                            <!-- deleteSaleDetail box begin -->
                                            <div id="deleteSaleDetail<?= $SaleDetail->getId() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Opération Vente</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Opération Vente : <?= $SaleDetail->getProductId() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $SaleDetail->getId() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="SaleDetail" />
                                                                <input type="hidden" name="codeSale" value="<?= $codeSale ?>" />
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteSaleDetail box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($SaleDetailsNumber != 0){ echo $pagination; }*/ ?><br>
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
