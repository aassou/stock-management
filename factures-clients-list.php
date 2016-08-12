<?php
//classes loading begin
    function classLoad ($myClass) {
        if(file_exists('model/'.$myClass.'.php')){
            include('model/'.$myClass.'.php');
        }
        elseif(file_exists('controller/'.$myClass.'.php')){
            include('controller/'.$myClass.'.php');
        }
    }
    spl_autoload_register("classLoad"); 
    include('config.php');  
    include('lib/pagination.php');
    //classes loading end
    session_start();
    if( isset($_SESSION['userMerlaTrav']) ){
        //les sources
        $clientsManager = new ClientManager($pdo);
        $clientNumber = $clientsManager->getClientsNumber();
        $clients = $clientsManager->getClients();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Rachid Bekkali - Management Application</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/metro.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/style_responsive.css" rel="stylesheet" />
    <link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
    <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <?php include("include/top-menu.php"); ?>  
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid sidebar-closed">
        <!-- BEGIN SIDEBAR -->
        <?php include("include/sidebar.php"); ?>  
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN PAGE CONTAINER-->            
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->           
                        <h3 class="page-title">
                            Gestion des clients
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-dashboard"></i>
                                <a href="dashboard.php">Accueil</a> 
                                <i class="icon-angle-right"></i>
                            </li>
                            <li>
                                <i class="icon-group"></i>
                                <a>Gestion des clients</a>
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN ACCORDION PORTLET-->
                        <div class="portlet box grey">
                            <div class="portlet-title">
                                <h4><i class="icon-reorder"></i>Gestion des clients</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    <a href="javascript:;" class="reload"></a>
                                    <a href="javascript:;" class="remove"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="accordion" id="accordion1">
                                    <?php for($i=0;$i<$clientNumber;$i++){ ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?= $i+1 ?>">
                                            <i class="icon-angle-right"></i>
                                            <?= $clients[$i]->matricule() ?>
                                            </a>
                                        </div>
                                        <div id="collapse_<?= $i+1 ?>" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:10%">Actions</th>
                                                            <th style="width:10%">N°Facture</th>
                                                            <th style="width:20%">Somme</th>
                                                            <th style="width:20%">Avance</th>
                                                            <th style="width:10%">Date Vente</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="odd gradeX">
                                                            <td>
                                                                <a href="#update" data-toggle="modal" data-id="" class="btn mini green"><i class="icon-refresh"></i></a>
                                                                <a href="#delete" data-toggle="modal" data-id="" class="btn mini red"><i class="icon-remove"></i></a>
                                                            </td>    
                                                            <td>415 / 2014</td>
                                                            <td>9 896,00 DH</td>
                                                            <td>0 ,00 DH</td>
                                                            <td><?= date('d/m/Y',strtotime('2014-10-17'))?></td>
                                                        </tr>    
                                                        <tr class="odd gradeX">
                                                            <td>
                                                                <a href="#update" data-toggle="modal" data-id="" class="btn mini green"><i class="icon-refresh"></i></a>
                                                                <a href="#delete" data-toggle="modal" data-id="" class="btn mini red"><i class="icon-remove"></i></a>
                                                            </td>    
                                                            <td>415 / 2014</td>
                                                            <td>9 896,00 DH</td>
                                                            <td>0 ,00 DH</td>
                                                            <td><?= date('d/m/Y',strtotime('2014-10-17'))?></td>
                                                        </tr>
                                                        <tr class="odd gradeX">
                                                            <td>
                                                                <a href="#update" data-toggle="modal" data-id="" class="btn mini green"><i class="icon-refresh"></i></a>
                                                                <a href="#delete" data-toggle="modal" data-id="" class="btn mini red"><i class="icon-remove"></i></a>
                                                            </td>    
                                                            <td>415 / 2014</td>
                                                            <td>9 896,00 DH</td>
                                                            <td>0 ,00 DH</td>
                                                            <td><?= date('d/m/Y',strtotime('2014-10-17'))?></td>
                                                        </tr>
                                                        <tr class="odd gradeX">
                                                            <th></th>    
                                                            <th></th>
                                                            <th>Somme à payer</th>
                                                            <th>Avance payée</th>
                                                            <th></th>
                                                        </tr>
                                                        <tr class="odd gradeX">
                                                            <td></td>    
                                                            <td></td>
                                                            <td>29 688,00 DH</td>
                                                            <td>0 ,00 DH</td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- END ACCORDION PORTLET-->      
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <?= date('Y') ?> &copy; Rachid Bekkali.
        <div class="span pull-right">
            <span class="go-top"><i class="icon-angle-up"></i></span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS -->
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <script src="assets/js/jquery-1.8.3.min.js"></script>   
    <script src="assets/breakpoints/breakpoints.js"></script>   
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>        
    <script src="assets/js/jquery.blockui.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- ie8 fixes -->
    <!--[if lt IE 9]>
    <script src="assets/js/excanvas.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->    
    <script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="assets/js/app.js"></script>        
    <script>
        jQuery(document).ready(function() {         
            // initiate layout and plugins
            App.setPage("table_managed");
            App.init();
        });
    </script>
</body>
<!-- END BODY -->
</html>
<?php
}
else{
    header("Location:index.php");
}
?>