<?php

require('../app/classLoad.php');
session_start();

if (isset($_SESSION['userstock'])) {
    $codePurchase = htmlentities($_GET['codePurchase']);

    // Create Controller
    $purchaseDetailActionController = new PurchaseDetailActionController('purchaseDetail');

    // Legacy Calls
    $productManager = new ProduitManager(PDOFactory::getMysqlConnection());

    // Vars and objects
    $purchaseDetails = $purchaseDetailActionController->getAllByCode($codePurchase);
    $totalAmountByCodePurchase = $purchaseDetailActionController->getTotalAmountByCode($codePurchase);
    $products = $productManager->getProduits();

    // Breadcurmb
    $breadcrumb = new Breadcrumb(
        [
            [
                'class' => 'icon-shopping-cart',
                'link' => 'purchase.php',
                'title' => 'Achats'
            ],
            [
                'class' => '',
                'link' => '',
                'title' => '<strong>Détails Achat</strong>'
            ]
        ]
    );

    /*$purchaseDetailsNumber = $purchaseDetailActionController->getAllNumber(); 
    $p = 1;
    if ( $purchaseDetailsNumber != 0 ) {
        $purchaseDetailPerPage = 20;
        $pageNumber = ceil($purchaseDetailsNumber/$purchaseDetailPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $purchaseDetailPerPage;
        $pagination = paginate('purchaseDetail.php', '?p=', $pageNumber, $p);
        $purchaseDetails = $purchaseDetailActionController->getAllByLimits($begin, $purchaseDetailPerPage);
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
                            <!-- addPurchaseDetail box begin -->
                            <div id="addPurchaseDetail" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Opération Achat</h3>
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
                                                <input type="hidden" name="source" value="purchaseDetail" />
                                                <input type="hidden" name="codePurchase" value="<?= $codePurchase ?>" />
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addPurchaseDetail box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Opération Achat</h4>
                                </div>
                                <div class="portlet-body">
                                    <div class="flex">
                                        <div class="flex-1">
                                            <a class="btn blue pull-left" href="#addPurchaseDetail" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Opération Achat
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a
                                                class="btn black"
                                                href="../print/PurchaseDetailPrint.php?codePurchase=<?= $codePurchase ?>"
                                            >
                                                <i class="icon-print"></i>&nbsp;Imprimer Bon de livraison
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t30">Produit</th>
                                                <th class="t20">Quantité</th>
                                                <th class="t20">Prix</th>
                                                <th class="t20">Total</th>
                                                <th class="t10 hidden-phone">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $purchaseDetailsNumber != 0 ) { 
                                            foreach ($purchaseDetails as $purchaseDetail) {
                                                $product = $productManager->getProduitById($purchaseDetail->getProductId());
                                            ?>
                                            <tr>
                                                <td class="t30"><?= $product->code() ?></td>
                                                <td class="t20"><?= $purchaseDetail->getQuantity() ?></td>
                                                <td class="t30"><?= Utils::numberFormatMoney($purchaseDetail->getPrice()) ?></td>
                                                <td class="t30"><?= Utils::numberFormatMoney($purchaseDetail->getPrice() * $purchaseDetail->getQuantity()) ?></td>
                                                <td class="t10 hidden-phone">
                                                    <a href="#updatePurchaseDetail<?= $purchaseDetail->getId() ?>" data-toggle="modal" data-id="<?= $purchaseDetail->getId() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="#deletePurchaseDetail<?= $purchaseDetail->getId() ?>" data-toggle="modal" data-id="<?= $purchaseDetail->getId() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                </td>
                                            </tr> 
                                            <!-- updatePurchaseDetail box begin -->
                                            <div id="updatePurchaseDetail<?= $purchaseDetail->getId() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Opération Achat</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
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
                                                                <input required="required" type="text" name="quantity"  value="<?= $purchaseDetail->getQuantity() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Prix</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="price"  value="<?= $purchaseDetail->getPrice() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Description</label>
                                                            <div class="controls">
                                                                <input type="text" name="description"  value="<?= $purchaseDetail->getDescription() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $purchaseDetail->getId() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="purchaseDetail" />
                                                                <input type="hidden" name="codePurchase" value="<?= $codePurchase ?>" />
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updatePurchaseDetail box end --> 
                                            <!-- deletePurchaseDetail box begin -->
                                            <div id="deletePurchaseDetail<?= $purchaseDetail->getId() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Opération Achat</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Opération Achat : <?= $purchaseDetail->getProductId() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $purchaseDetail->getId() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="purchaseDetail" />
                                                                <input type="hidden" name="codePurchase" value="<?= $codePurchase ?>" />
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deletePurchaseDetail box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th class="t30"></th>
                                                <th class="t20"></th>
                                                <th class="t20"><strong>Total</strong></th>
                                                <th class="t20">
                                                    <strong>
                                                        <a>
                                                            <strong>
                                                                <?= Utils::numberFormatMoney($totalAmountByCodePurchase) ?>&nbsp;DH
                                                            </strong>
                                                        </a>
                                                    </strong>
                                                </th>
                                                <th class="t10"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <?php /*if($purchaseDetailsNumber != 0){ echo $pagination; }*/ ?><br>
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
