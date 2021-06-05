<?php
require_once('../app/classLoad.php');
include('config.php');
session_start();

if (isset($_SESSION['userMerlaTrav'])
    and $_SESSION['userMerlaTrav']->profil() == "admin"
){
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
        <div class="page-container row-fluid">
            <?php include("../include/sidebar.php"); ?>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li>
                                    <i class="icon-home"></i>
                                    <a>Accueil</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li>
                                    <i class="icon-wrench"></i>
                                    <a href="configuration.php">Paramètrages</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li><a>Ajouter fournisseur</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="tab-pane active" id="tab_1">
                                 <?php if(isset($_SESSION['fournisseur-add-error'])){ ?>
                                    <div class="alert alert-error">
                                        <button class="close" data-dismiss="alert"></button>
                                        <?= $_SESSION['fournisseur-add-error'] ?>
                                    </div>
                                 <?php }
                                    unset($_SESSION['fournisseur-add-error']);
                                 ?>
                               <div class="portlet box grey">
                                  <div class="portlet-title">
                                     <h4><i class="icon-edit"></i> Fournisseur</h4>
                                  </div>
                                  <div class="portlet-body form">
                                     <form action="../controller/FournisseurActionController.php" method="POST" class="horizontal-form">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <img src="../assets/img/form_wizard_fournisseur_livraison_1.png">
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="progress progress-striped progress-success">
                                                    <div style="width: 50%;" class="bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                           <div class="span4">
                                              <div class="control-group autocomplet_container">
                                                 <label class="control-label" for="nom">Nom</label>
                                                 <div class="controls">
                                                    <input type="text" id="nomFournisseur" name="nom" class="m-wrap span12" onkeyup="autocompletFournisseur()">
                                                    <ul id="fournisseurList"></ul>
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="span4">
                                              <div class="control-group">
                                                 <label class="control-label" for="adresse">Adresse</label>
                                                 <div class="controls">
                                                    <input type="text" id="adresse" name="adresse" class="m-wrap span12">
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="span4">
                                              <div class="control-group">
                                                 <label class="control-label" for="telephone1">Téléphone 1</label>
                                                 <div class="controls">
                                                    <input type="text" id="telephone1" name="telephone1" class="m-wrap span12">
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span4">
                                              <div class="control-group">
                                                 <label class="control-label" for="telephone2">Téléphone 2</label>
                                                 <div class="controls">
                                                    <input type="text" id="telephone2" name="telephone2" class="m-wrap span12">
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="span4">
                                              <div class="control-group">
                                                 <label class="control-label" for="email">Email</label>
                                                 <div class="controls">
                                                    <input type="text" id="email" name="email" class="m-wrap span12">
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="span4">
                                              <div class="control-group">
                                                 <label class="control-label" for="fax">Fax</label>
                                                 <div class="controls">
                                                    <input type="text" id="fax" name="fax" class="m-wrap span12">
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="idFournisseur" name="idFournisseur" class="m-wrap span12" />
                                            <button type="reset" class="btn red">Annuler</button>
                                            <button type="submit" class="btn black">Continuer <i class="m-icon-swapright m-icon-white"></i></button>
                                        </div>
                                     </form>
                                  </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            2015 &copy; MerlaTravERP. Management Application.
            <div class="span pull-right">
                <span class="go-top"><i class="icon-angle-up"></i></span>
            </div>
        </div>
        <script src="../assets/js/jquery-1.8.3.min.js"></script>
        <script src="../assets/breakpoints/breakpoints.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.blockui.js"></script>
        <script src="../assets/js/jquery.cookie.js"></script>
        <script src="../assets/fancybox/source/jquery.fancybox.pack.js"></script>
        <!-- ie8 fixes -->
        <!--[if lt IE 9]>
        <script src="../assets/js/excanvas.js"></script>
        <script src="../assets/js/respond.js"></script>
        <![endif]-->
        <script type="text/javascript" src="../assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="../assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../assets/data-tables/DT_bootstrap.js"></script>
        <script src="../assets/js/app.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                //App.setPage("table_editable");
                App.init();
            });
        </script>
    </body>
</html>
<?php
} elseif (isset($_SESSION['userMerlaTrav'])
    and $_SESSION['userMerlaTrav']->profil() != "admin")
{
	header('Location:dashboard.php');
} else {
    header('Location:index.php');    
}
