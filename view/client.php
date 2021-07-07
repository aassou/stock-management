<?php

require('../app/classLoad.php');
session_start();

if (isset($_SESSION['userstock'])) {
    // Create Controller
    $clientActionController = new ClientActionController('client');
    
    // Vars and objects
    $clients = $clientActionController->getAll();
    
    // Breadcurmb
    $breadcrumb = new Breadcrumb(
        [
            [
                'class' => '',
                'link' => 'client.php',
                'title' => '<strong>Clients</strong>'
            ]
        ]
    );
    
    /*$clientsNumber = $clientActionController->getAllNumber(); 
    $p = 1;
    if ( $clientsNumber != 0 ) {
        $clientPerPage = 20;
        $pageNumber = ceil($clientsNumber/$clientPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $clientPerPage;
        $pagination = paginate('client.php', '?p=', $pageNumber, $p);
        $clients = $clientActionController->getAllByLimits($begin, $clientPerPage);
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
                            <!-- addClient box begin -->
                            <div id="addClient" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter Client</h3>
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
                                                <input type="hidden" name="source" value="client" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addClient box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Clients</h4>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addClient" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;Client
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10">Nom</th>
                                                <th class="t10">Adresse</th>
                                                <th class="t30">Téléphone</th>
                                                <th class="t10 hidden-phone">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $clientsNumber != 0 ) { 
                                            foreach ( $clients as $client ) {
                                            ?>
                                            <tr>
                                                <td><?= $client->getName() ?></td>
                                                <td><?= $client->getAddress() ?></td>
                                                <td><?= $client->getPhone() ?></td>
                                                <td class="hidden-phone">
                                                    <a href="#updateClient<?= $client->getId() ?>" data-toggle="modal" data-id="<?= $client->getId() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="#deleteClient<?= $client->getId() ?>" data-toggle="modal" data-id="<?= $client->getId() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                </td>
                                            </tr> 
                                            <!-- updateClient box begin -->
                                            <div id="updateClient<?= $client->getId() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info Client</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Nom</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" required="required" type="text" name="name"  value="<?= $client->getName() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" type="text" name="address"  value="<?= $client->getAddress() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Téléphone</label>
                                                            <div class="controls">
                                                                <input class="m-wrap span12" type="text" name="phone"  value="<?= $client->getPhone() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $client->getId() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="client" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateClient box end --> 
                                            <!-- deleteClient box begin -->
                                            <div id="deleteClient<?= $client->getId() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Client</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer Client : <?= $client->getName() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $client->getId() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="client" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteClient box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table><br>
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
