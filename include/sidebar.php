<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        	
			<ul>
			    <li>
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <form class="sidebar-search" action="controller/ClientActionController.php" method="post">
                        <div class="input-box">
                            <a href="javascript:;" class="remove"></a>
                            <input type="hidden" name="action" value="search">
                            <input type="hidden" name="source" value="clients-search">
                            <input type="text" name="clientName" placeholder="Chercher un client">             
                            <input type="button" class="submit" value="">
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
				</li>
				<!---------------------------- Dashboard Begin  -------------------------------------------->
				<li class="start <?php if($currentPage=="dashboard.php"
				){echo "active ";} ?>">
					<a href="dashboard.php">
					<i class="icon-dashboard"></i> 
					<span class="title">Accueil</span>
					</a>
				</li>
				<!---------------------------- Dashboard End    -------------------------------------------->
				<!---------------------------- Gestion Achats Begin ----------------------------------->
				<?php 
				if ( 
				    $_SESSION["userMerlaTrav"]->profil() == "admin" ||
				    $_SESSION['userMerlaTrav']->profil() == "manager" ||
				    $_SESSION['userMerlaTrav']->profil() == "consultant" 
                    ) { 
					$gestionAchatClass="";
					if($currentPage=="projet-list.php"
					){
						$gestionAchatClass = "active ";
					}
				?> 
				<li class="<?= $gestionAchatClass; ?>" >
					<a href="projets.php">
					<i class="icon-shopping-cart"></i> 
					<span class="title">Gestion Achats</span>
					</a>
				</li>
				<?php
				}
				?> 
				<!---------------------------- Gestion Achats End -------------------------------------->
				<!---------------------------- Gestion Stock Begin  -------------------------------------------->
                <?php 
                if ( 
                    $_SESSION["userMerlaTrav"]->profil() == "admin" ||
                    $_SESSION['userMerlaTrav']->profil() == "manager" ||
                    $_SESSION['userMerlaTrav']->profil() == "consultant" 
                    ) { 
                    $gestionStockClass="";
                    if($currentPage=="stock.php"
                    or $currentPage=="stock-update-produit.php"
                    or $currentPage=="stock-delete-produit.php"
                    ){
                        $gestionStockClass = "active ";
                    }
                ?> 
                <li class="<?= $gestionStockClass ?>" >
                    <a href="stock.php">
                    <i class="icon-bar-chart"></i> 
                    <span class="title">Gestion Stock</span>
                    </a>
                </li>
                <?php
                }
                ?> 
                <!---------------------------- Gestion Stock End    -------------------------------------------->
                <!---------------------------- Gestion Clients Begin  -------------------------------------------->
                <?php 
                if ( 
                    $_SESSION["userMerlaTrav"]->profil() == "admin" ||
                    $_SESSION['userMerlaTrav']->profil() == "manager" ||
                    $_SESSION['userMerlaTrav']->profil() == "consultant" 
                    ) { 
                    $gestionClientsClass="";
                    if($currentPage=="factures-clients-list.php"
                    ){
                        $gestionClientsClass = "active ";
                    }
                ?> 
                <li class="<?= $gestionClientsClass ?>" >
                    <a href="factures-clients-list.php">
                    <i class="icon-group"></i> 
                    <span class="title">Gestion Clients</span>
                    </a>
                </li>
                <?php
                }
                ?> 
                <!---------------------------- Gestion Clients End    -------------------------------------------->
                <!---------------------------- Gestion Fournisseurs Begin  -------------------------------------------->
                <?php 
                if ( 
                    $_SESSION["userMerlaTrav"]->profil() == "admin" ||
                    $_SESSION['userMerlaTrav']->profil() == "manager" ||
                    $_SESSION['userMerlaTrav']->profil() == "consultant" 
                    ) { 
                    $gestionFournisseursClass="";
                    if($currentPage=="projet-list.php"
                    ){
                        $gestionFournisseursClass = "active ";
                    }
                ?> 
                <li class="<?= $gestionFournisseursClass ?>" >
                    <a href="projets.php">
                    <i class="icon-truck"></i> 
                    <span class="title">Gestion Fournisseurs</span>
                    </a>
                </li>
                <?php
                }
                ?> 
                <!---------------------------- Gestion Fournisseurs End    -------------------------------------------->
				<!---------------------------- Gestion Charges Begin  -------------------------------------------->
                <?php 
                if ( 
                    $_SESSION["userMerlaTrav"]->profil() == "admin" ||
                    $_SESSION['userMerlaTrav']->profil() == "manager" ||
                    $_SESSION['userMerlaTrav']->profil() == "consultant" 
                    ) { 
                    $gestionChargesClass="";
                    if($currentPage=="projet-list.php"
                    ){
                        $gestionChargesClass = "active ";
                    }
                ?> 
                <li class="<?= $gestionChargesClass ?>" >
                    <a href="projets.php">
                    <i class="icon-money"></i> 
                    <span class="title">Gestion Charges</span>
                    </a>
                </li>
                <?php
                }
                ?> 
                <!---------------------------- Gestion Charges End    -------------------------------------------->
                <!---------------------------- Gestion Produits Begin  -------------------------------------------->
                <?php 
                if ( 
                    $_SESSION["userMerlaTrav"]->profil() == "admin" ||
                    $_SESSION['userMerlaTrav']->profil() == "manager" ||
                    $_SESSION['userMerlaTrav']->profil() == "consultant" 
                    ) { 
                    $gestionProduitsClass="";
                    if($currentPage=="produits.php"
                    ){
                        $gestionProduitsClass = "active ";
                    }
                ?> 
                <li class="<?= $gestionProduitsClass ?>" >
                    <a href="produits.php">
                    <i class="icon-barcode"></i> 
                    <span class="title">Gestion Produits</span>
                    </a>
                </li>
                <?php
                }
                ?> 
                <!---------------------------- Gestion Produits End    -------------------------------------------->
                <!---------------------------- Parametrage Begin  -------------------------------------------->
                <?php 
                if ( 
                    $_SESSION["userMerlaTrav"]->profil() == "admin" ||
                    $_SESSION['userMerlaTrav']->profil() == "manager" ||
                    $_SESSION['userMerlaTrav']->profil() == "consultant" 
                    ) { 
                    $gestionParametragesClass="";
                    if($currentPage=="configuration.php"
                    or $currentPage=="clients-list.php"
                    or $currentPage=="categories.php"
                    ){
                        $gestionParametragesClass = "active ";
                    }
                ?> 
                <li class="<?= $gestionParametragesClass ?>" >
                    <a href="configuration.php">
                    <i class="icon-wrench"></i> 
                    <span class="title">Paramètrages</span>
                    </a>
                </li>
                <?php
                }
                ?> 
                <!---------------------------- Gestion Parametrage End    -------------------------------------------->
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>