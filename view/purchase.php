<?php

require('../app/classLoad.php');
session_start();

if (isset($_SESSION['userstock'])) {
    // Create Controller
    $purchaseActionController = new PurchaseActionController('purchase');
    $providerActionController = new ProviderActionController('provider');

    // Vars and objects
    $purchases = $purchaseActionController->getAll();
    $providers = $providerActionController->getAll();

    // Breadcurmb
    $breadcrumb = new Breadcrumb(
        [
            [
                'class' => 'icon-shopping-cart',
                'link' => 'purchase.php',
                'title' => '<strong>Achats</strong>'
            ]
        ]
    );
    /*$purchasesNumber = $purchaseActionController->getAllNumber(); 
    $p = 1;
    if ( $purchasesNumber != 0 ) {
        $purchasePerPage = 20;
        $pageNumber = ceil($purchasesNumber/$purchasePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $purchasePerPage;
        $pagination = paginate('purchase.php', '?p=', $pageNumber, $p);
        $purchases = $purchaseActionController->getAllByLimits($begin, $purchasePerPage);
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
                            <!-- addPurchase box begin -->
                            <div id="addPurchase" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Purchase</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Date Opération</label>
                                            <div class="controls">
                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                    <input name="operationDate" id="operationDate" class="m-wrap date-picker span12" type="text" value="<?= date('Y-m-d') ?>" />
                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Fournisseur</label>
                                            <div class="controls">
                                                <select required="required" class="m-wrap span12" name="clientId">
                                                    <?php foreach ($providers as $provider) { ?>
                                                        <option value="<?= $provider->getId() ?>"><?= $provider->getName() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Numéro Opération</label>
                                            <div class="controls">
                                                <input type="text" name="number" class="m-wrap span12" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Description</label>
                                            <div class="controls">
                                                <input type="text" name="description" class="m-wrap span12" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="purchase" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addPurchase box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Achats</h4>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addPurchase" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Achat
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10">Date</th>
                                                <th class="t10">Numéro Opération</th>
                                                <th class="t10">Fournisseur</th>
                                                <th class="t10">Description</th>
                                                <th class="t10 hidden-phone">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $purchasesNumber != 0 ) { 
                                            foreach ($purchases as $purchase) {
                                                $currentProvider = $providerActionController->getOneById($purchase->getClientId());
                                            ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($purchase->getOperationDate())) ?></td>
                                                <td><?= $purchase->getNumber() ?></td>
                                                <td><?= $currentProvider->getName() ?></td>
                                                <td><?= $purchase->getDescription() ?></td>
                                                <td class="hidden-phone">
                                                    <a href="purchaseDetail.php?codePurchase=<?= $purchase->getCode() ?>" class="btn mini blue" title="Voir Détail Achat">
                                                        <i class="icon-eye-open"></i>
                                                    </a>
                                                    <a href="../print/PurchaseDetailPrint.php?codePurchase=<?= $purchase->getCode() ?>" class="btn mini black" title="Imprimer Bon de Livraison">
                                                        <i class="icon-print"></i>
                                                    </a>
                                                    <a href="#updatePurchase<?= $purchase->getId() ?>" data-toggle="modal" data-id="<?= $purchase->getId() ?>" class="btn mini green" title="Modifier Achat">
                                                        <i class="icon-refresh"></i>
                                                    </a>
                                                    <a href="#deletePurchase<?= $purchase->getId() ?>" data-toggle="modal" data-id="<?= $purchase->getId() ?>" class="btn mini red" title="Supprimer Achat">
                                                        <i class="icon-remove"></i>
                                                    </a>
                                                </td>
                                            </tr> 
                                            <!-- updatePurchase box begin -->
                                            <div id="updatePurchase<?= $purchase->getId() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Achat</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Date Opération</label>
                                                            <div class="controls">
                                                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd">
                                                                    <input name="operationDate" id="operationDate" class="m-wrap date-picker span12" type="text" value="<?= $purchase->getOperationDate() ?>" />
                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Fournisseur</label>
                                                            <div class="controls">
                                                                <select required="required" class="m-wrap span12" name="clientId">
                                                                    <option value="<?= $currentProvider->getId() ?>"><?= $currentProvider->getName() ?></option>
                                                                    <?php foreach ($providers as $provider) { ?>
                                                                        <option value="<?= $provider->getId() ?>"><?= $provider->getName() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Numéro Opération</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" type="text" name="number"  value="<?= $purchase->getNumber() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Description</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" type="text" name="description"  value="<?= $purchase->getDescription() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $purchase->getId() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="purchase" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updatePurchase box end --> 
                                            <!-- deletePurchase box begin -->
                                            <div id="deletePurchase<?= $purchase->getId() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Achat</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer cet Achat : <?= $purchase->getOperationDate() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $purchase->getId() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="purchase" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deletePurchase box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($purchasesNumber != 0){ echo $pagination; }*/ ?><br>
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
