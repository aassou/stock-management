<?php

require('../app/classLoad.php');
session_start();

if (isset($_SESSION['userstock'])) {
    // Create Controller
    $providerActionController = new ProviderActionController('provider');
    
    // Vars and objects
    $providers = $providerActionController->getAll();
    
    // Breadcurmb
    $breadcrumb = new Breadcrumb(
        [
            [
                'class' => '',
                'link' => 'provider.php',
                'title' => '<strong>Fournisseurs</strong>'
            ]
        ]
    );
    
    /*$providersNumber = $providerActionController->getAllNumber(); 
    $p = 1;
    if ( $providersNumber != 0 ) {
        $providerPerPage = 20;
        $pageNumber = ceil($providersNumber/$providerPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $providerPerPage;
        $pagination = paginate('provider.php', '?p=', $pageNumber, $p);
        $providers = $providerActionController->getAllByLimits($begin, $providerPerPage);
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
                            <!-- addProvider box begin -->
                            <div id="addProvider" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Founisseur</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">Nom</label>
                                            <div class="controls">
                                                <input class="m-wrap span12" required="required" type="text" name="name" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Adresse</label>
                                            <div class="controls">
                                                <input class="m-wrap span12" type="text" name="address" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Téléphone</label>
                                            <div class="controls">
                                                <input class="m-wrap span12" type="text" name="phone" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="provider" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addProvider box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des founisseurs</h4>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addProvider" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Fournisseur
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t30">Nom</th>
                                                <th class="t30">Adresse</th>
                                                <th class="t30">Téléphone</th>
                                                <th class="t10 hidden-phone">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $providersNumber != 0 ) { 
                                            foreach ( $providers as $provider ) {
                                            ?>
                                            <tr>
                                                <td><?= $provider->getName() ?></td>
                                                <td><?= $provider->getAddress() ?></td>
                                                <td><?= $provider->getPhone() ?></td>
                                                <td class="hidden-phone">
                                                    <a href="#updateProvider<?= $provider->getId() ?>" data-toggle="modal" data-id="<?= $provider->getId() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="#deleteProvider<?= $provider->getId() ?>" data-toggle="modal" data-id="<?= $provider->getId() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                </td>
                                            </tr> 
                                            <!-- updateProvider box begin -->
                                            <div id="updateProvider<?= $provider->getId() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Founisseur</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Nom</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" required="required" type="text" name="name"  value="<?= $provider->getName() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" type="text" name="address"  value="<?= $provider->getAddress() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Téléphone</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" type="text" name="phone"  value="<?= $provider->getPhone() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $provider->getId() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="provider" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateProvider box end --> 
                                            <!-- deleteProvider box begin -->
                                            <div id="deleteProvider<?= $provider->getId() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Founisseur</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer ce Fournisseur : <?= $provider->getName() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $provider->getId() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="provider" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteProvider box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($providersNumber != 0){ echo $pagination; }*/ ?><br>
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
