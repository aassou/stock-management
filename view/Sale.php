<?php
require('../app/classLoad.php');
session_start();

if ( isset($_SESSION['userstock']) ) {
    //create Controller
    $SaleActionController = new SaleActionController('Sale');
    //get objects
    $Sales = $SaleActionController->getAll();
    //breadcurmb
    $breadcrumb = new Breadcrumb(
        [
            [
                'class' => 'icon-signal',
                'link' => '',
                'title' => '<strong>Ventes</strong>'
            ]
        ]
    );
    /*$SalesNumber = $SaleActionController->getAllNumber(); 
    $p = 1;
    if ( $SalesNumber != 0 ) {
        $SalePerPage = 20;
        $pageNumber = ceil($SalesNumber/$SalePerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $SalePerPage;
        $pagination = paginate('Sale.php', '?p=', $pageNumber, $p);
        $Sales = $SaleActionController->getAllByLimits($begin, $SalePerPage);
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
                            <!-- addSale box begin -->
                            <div id="addSale" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Vente</h3>
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
                                            <label class="control-label">Numéro Opération</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="number" class="m-wrap span12" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Client</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="label" class="m-wrap span12" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Description</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="description" class="m-wrap span12" />
                                            </div>
                                        </div>
<!--                                        <div class="control-group">-->
<!--                                            <label class="control-label">ClientId</label>-->
<!--                                            <div class="controls">-->
<!--                                                <input required="required" type="text" name="clientId" />-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="Sale" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addSale box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Ventes</h4>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addSale" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Nouvelle Vente
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10">Date</th>
                                                <th class="t10">Numéro Opération</th>
                                                <th class="t10">Client</th>
                                                <th class="t10">Description</th>
                                                <th class="t10 hidden-phone">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($Sales as $Sale) {
                                            ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($Sale->getOperationDate())) ?></td>
                                                <td><?= $Sale->getNumber() ?></td>
                                                <td><?= $Sale->getLabel() ?></td>
                                                <td><?= $Sale->getDescription() ?></td>
                                                <td class="hidden-phone">
                                                    <a href="SaleDetail.php?codeSale=<?= $Sale->getCode() ?>" class="btn mini blue" title="Voir Détail Vente">
                                                        <i class="icon-eye-open"></i>
                                                    </a>
                                                    <a href="#updateSale<?= $Sale->getId() ?>" data-toggle="modal" data-id="<?= $Sale->getId() ?>" class="btn mini green" title="Modifier Vente">
                                                        <i class="icon-refresh"></i>
                                                    </a>
                                                    <a href="#deleteSale<?= $Sale->getId() ?>" data-toggle="modal" data-id="<?= $Sale->getId() ?>" class="btn mini red" title="Supprimer Vente">
                                                        <i class="icon-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div id="updateSale<?= $Sale->getId() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Vente</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Date Opération</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="operationDate"  value="<?= $Sale->getOperationDate() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Number</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="number"  value="<?= $Sale->getNumber() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Label</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="label"  value="<?= $Sale->getLabel() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Description</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="description"  value="<?= $Sale->getDescription() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">ClientId</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="clientId"  value="<?= $Sale->getClientId() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $Sale->getId() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="Sale" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div id="deleteSale<?= $Sale->getId() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Vente</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer cette Vente et ses détails : <?= $Sale->getNumber() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $Sale->getId() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="Sale" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($SalesNumber != 0){ echo $pagination; }*/ ?><br>
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
