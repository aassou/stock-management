<?php
require_once('../app/classLoad.php');
include('config.php');
session_start();

if (isset($_SESSION['userMerlaTrav'])
    and $_SESSION['userMerlaTrav']->profil() == "admin"
) {
    $fournisseursManager = new FournisseurManager(PDOFactory::getMysqlConnection());
    $fournisseurNumber = $fournisseursManager->getFournisseurNumbers();

    if ($fournisseurNumber != 0) {
        $fournisseurs = $fournisseursManager->getFournisseurs();
    }
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
                                    <i class="icon-home"></i>
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
                                    <a>Gestion des fournisseurs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <!--div class="pull-right get-down">
                                <a href="#addFournisseur" data-toggle="modal" class="btn blue">
                                    Ajouter Nouveau Fournisseur <i class="icon-plus-sign "></i>
                                </a>
                            </div>
                            <div class="row-fluid">
                                <div class="input-box">
                                    <input class="m-wrap" name="provider" id="provider" type="text" placeholder="Fournisseur..." />
                                </div>
                            </div-->
                            <!-- addFournisseur box begin-->
                            <div id="addFournisseur" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter un nouveau fournisseur </h3>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" action="../controller/FournisseurActionController.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label">Nom</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="nom" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Adresse</label>
                                            <div class="controls">
                                                <input type="text" name="adresse" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tél.1</label>
                                            <div class="controls">
                                                <input type="text" name="telephone1" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tél.2</label>
                                            <div class="controls">
                                                <input type="tel" name="telephone2" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Fax</label>
                                            <div class="controls">
                                                <input type="text" name="fax" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>
                                            <div class="controls">
                                                <input type="email" name="email" value="" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="fournisseurs" />
                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                             <?php
                             if ( isset($_SESSION['fournisseur-action-message'])
                             and isset($_SESSION['fournisseur-type-message']) ) {
                                 $message = $_SESSION['fournisseur-action-message'];
                                 $typeMessage = $_SESSION['fournisseur-type-message'];
                             ?>
                                <div class="alert alert-<?= $typeMessage ?>">
                                    <button class="close" data-dismiss="alert"></button>
                                    <?= $message ?>
                                </div>
                             <?php }
                                unset($_SESSION['fournisseur-action-message']);
                                unset($_SESSION['fournisseur-type-message']);
                             ?>
                                <div class="portlet box light-grey">
                                    <div class="portlet-title">
                                        <h4>Liste des fournisseurs</h4>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <a href="fournisseur-add.php" class="btn blue">
                                                Nouveau Fournisseur <i class="icon-plus-sign"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th style="width:5%"></th>
                                                <th style="width:20%">Nom</th>
                                                <th style="width:30%">Adresse</th>
                                                <th style="width:10%">Tél1</th>
                                                <th style="width:10%">Tél2</th>
                                                <th style="width:10%">Fax</th>
                                                <th style="width:15%">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($fournisseurNumber!=0){
                                            foreach ($fournisseurs as $fournisseur) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td class="hidden-phone"><a class="btn green mini" href="#update<?= $fournisseur->id();?>" data-toggle="modal" data-id="<?= $fournisseur->id(); ?>"><i class="icon-refresh"></i></a></td>
                                                <td><?= $fournisseur->nom() ?></td>
                                                <td class="hidden-phone"><?= $fournisseur->adresse()?></td>
                                                <td class="hidden-phone"><?= $fournisseur->telephone1() ?></td>
                                                <td class="hidden-phone"><?= $fournisseur->telephone2() ?></td>
                                                <td class="hidden-phone"><?= $fournisseur->fax() ?></td>
                                                <td class="hidden-phone"><a target="_blank" href="mailto:<?= $fournisseur->email() ?>"><?= $fournisseur->email() ?></a></td>
                                            </tr>
                                            <div id="update<?= $fournisseur->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier les informations du fournisseur </h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="../controller/FournisseurActionController.php" method="post">
                                                        <p>Êtes-vous sûr de vouloir modifier les infos du fournisseur <strong><?= $fournisseur->nom() ?></strong> ?</p>
                                                        <div class="control-group">
                                                            <label class="control-label">Nom</label>
                                                            <div class="controls">
                                                                <input type="text" name="nom" value="<?= $fournisseur->nom() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Adresse</label>
                                                            <div class="controls">
                                                                <input type="text" name="adresse" value="<?= $fournisseur->adresse() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tél.1</label>
                                                            <div class="controls">
                                                                <input type="text" name="telephone1" value="<?= $fournisseur->telephone1() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Tél.2</label>
                                                            <div class="controls">
                                                                <input type="text" name="telephone2" value="<?= $fournisseur->telephone2() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Fax</label>
                                                            <div class="controls">
                                                                <input type="text" name="fax" value="<?= $fournisseur->fax() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Email</label>
                                                            <div class="controls">
                                                                <input type="email" name="email" value="<?= $fournisseur->email() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <input type="hidden" name="idFournisseur" value="<?= $fournisseur->id() ?>" />
                                                            <input type="hidden" name="action" value="update" />
                                                            <input type="hidden" name="source" value="fournisseurs" />
                                                            <div class="controls">
                                                                <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="delete<?= $fournisseur->id();?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer Fournisseur</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal loginFrm" action="../controller/FournisseurActionController.php" method="post">
                                                        <p>Êtes-vous sûr de vouloir supprimer ce fournisseur <?= $fournisseur->nom() ?> ?</p>
                                                        <div class="control-group">
                                                            <label class="right-label"></label>
                                                            <input type="hidden" name="idFournisseur" value="<?= $fournisseur->id() ?>" />
                                                            <input type="hidden" name="action" value="delete" />
                                                            <input type="hidden" name="source" value="fournisseurs" />
                                                            <button class="btn" data-dismiss="modal"aria-hidden="true">Non</button>
                                                            <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php }
                                            } ?>
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
            2015 &copy; ImmoERP. Management Application.
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
        <script src="../assets/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="../assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="../assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="../assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../assets/data-tables/DT_bootstrap.js"></script>
        <script src="../assets/js/app.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.setPage("table_managed");
                App.init();
            });
            $('.providers').show();
            $('#provider').keyup(function(){
               $('.providers').hide();
               var txt = $('#provider').val();
               $('.providers').each(function(){
                   if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                       $(this).show();
                   }
                });
            });
        </script>
    </body>
</html>
<?php
} else {
    header('Location:index.php');    
}
