<?php
require_once('../app/classLoad.php');
include('config.php');
session_start();

if (isset($_SESSION['userstock'])) {
    $clientsManager = new ClientManager(PDOFactory::getMysqlConnection());
    $clientNumber = $clientsManager->getClientsNumber();
    $clients = $clientsManager->getClients();
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
                        <div class="span12">
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
                                    <i class="icon-group"></i>
                                    <a>Gestion des clients</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php
                             if ( isset($_SESSION['client-action-message'])
                             and isset($_SESSION['client-type-message']) ) {
                                 $message = $_SESSION['client-action-message'];
                                 $typeMessage = $_SESSION['client-type-message'];
                             ?>
                                <div class="alert alert-<?= $typeMessage ?>">
                                    <button class="close" data-dismiss="alert"></button>
                                    <?= $message ?>
                                </div>
                             <?php }
                                unset($_SESSION['client-action-message']);
                                unset($_SESSION['client-type-message']);
                             ?>
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des clients</h4>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th style="width:10%">Code</th>
                                                <th style="width:20%">Matricule</th>
                                                <th style="width:20%" class="hidden-phone">Nom</th>
                                                <th style="width:10%" class="hidden-phone">CIN</th>
                                                <th style="width:15%" class="hidden-phone">Téléphone</th>
                                                <th style="width:15%" class="hidden-phone">Ville</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($clients as $client) { ?>
                                            <tr class="odd gradeX">
                                                <td><?= $client->code() ?></td>
                                                <td><?= $client->matricule() ?></td>
                                                <td><?= $client->nom() ?></td>
                                                <td><?= $client->cin() ?></td>
                                                <td><?= $client->telephone() ?></td>
                                                <td><?= $client->ville() ?></td>
                                                <td>
                                                    <a href="#update<?= $client->id() ?>" data-toggle="modal" data-id="<?= $client->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                    <a href="#delete<?= $client->id() ?>" data-toggle="modal" data-id="<?= $client->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                </td>
                                            </tr>
                                            <div id="update<?= $client->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier les informations du client </h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="../controller/ClientActionController.php" method="post">
                                                        <p>Êtes-vous sûr de vouloir modifier les infos du client <strong><?= $client->nom() ?></strong> ?</p>
                                                        <div class="control-group">
                                                            <label class="control-label">Code</label>
                                                            <div class="controls">
                                                                <input type="text" name="code" value="<?= $client->code() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Matricule</label>
                                                            <div class="controls">
                                                                <input type="text" name="matricule" value="<?= $client->matricule() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Nom</label>
                                                            <div class="controls">
                                                                <input type="text" name="nom" value="<?= $client->nom() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">CIN</label>
                                                            <div class="controls">
                                                                <input type="text" name="cin" value="<?= $client->cin() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Téléphone</label>
                                                            <div class="controls">
                                                                <input type="text" name="telephone" value="<?= $client->telephone() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Ville</label>
                                                            <div class="controls">
                                                                <input type="text" name="ville" value="<?= $client->ville() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <input type="hidden" name="idClient" value="<?= $client->id() ?>" />
                                                            <input type="hidden" name="action" value="update" />
                                                            <input type="hidden" name="source" value="clients-list" />
                                                            <div class="controls">
                                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="delete<?= $client->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Client</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal loginFrm" action="../controller/ClientActionController.php" method="post">
                                                        <p>Êtes-vous sûr de vouloir supprimer ce client <?= $client->nom() ?> ?</p>
                                                        <div class="control-group">
                                                            <label class="right-label"></label>
                                                            <input type="hidden" name="idClient" value="<?= $client->id() ?>" />
                                                            <input type="hidden" name="action" value="delete" />
                                                            <input type="hidden" name="source" value="clients" />
                                                            <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                            <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
        <script src="../assets/js/app.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.setPage("table_managed");
                App.init();
            });
        </script>
    </body>
</html>
<?php
} else {
    header("Location:index.php");
}
