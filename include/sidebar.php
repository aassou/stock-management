<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="page-sidebar nav-collapse collapse">
    <ul>
        <li>
            <form class="sidebar-search" action="controller/ClientActionController.php" method="post">
                <div class="input-box">
                    <a href="javascript:;" class="remove"></a>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="clients-search">
                    <input type="text" name="clientName" placeholder="Chercher un client">
                    <input type="button" class="submit" value="">
                </div>
            </form>
        </li>
        <li>
            <div class="sidebar-toggler hidden-phone"></div>
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
        <!---------------------------- Gestion Factures Begin ----------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
            ) {
            $gestionAchatClass="";
            if($currentPage=="factures.php"
            or $currentPage=="facture-details.php"
            ){
                $gestionAchatClass = "active ";
            }
        ?>
        <li class="<?= $gestionAchatClass; ?>" >
            <a href="factures.php">
            <i class="icon-file"></i>
            <span class="title">Factures</span>
            </a>
        </li>
        <?php
        }
        ?>
        <!---------------------------- Gestion Factures End -------------------------------------->
        <!---------------------------- Gestion Achats Begin ----------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
            ) {
            $gestionAchatClass="";
            if($currentPage == "purchase.php"
                or $currentPage == "purchaseDetail.php"
            ){
                $gestionAchatClass = "active ";
            }
        ?>
        <li class="<?= $gestionAchatClass; ?>" >
            <a href="purchase.php">
            <i class="icon-shopping-cart"></i>
            <span class="title">Achats</span>
            </a>
        </li>
        <?php
        }
        ?>
        <!---------------------------- Gestion Achats End -------------------------------------->
        <!---------------------------- Gestion Ventes Begin ----------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
        ) {
            $gestionAchatClass="";
            if ($currentPage == "Sale.php"
                or $currentPage == 'SaleDetail.php'
            ){
                $gestionAchatClass = "active ";
            }
            ?>
            <li class="<?= $gestionAchatClass; ?>" >
                <a href="Sale.php">
                    <i class="icon-signal"></i>
                    <span class="title">Ventes</span>
                </a>
            </li>
            <?php
        }
        ?>
        <!---------------------------- Gestion Ventes End -------------------------------------->
        <!---------------------------- Gestion Stock Begin  -------------------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
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
            <span class="title">Stock</span>
            </a>
        </li>
        <?php
        }
        ?>
        <!---------------------------- Gestion Stock End    -------------------------------------------->
        <!---------------------------- Gestion Clients Begin  -------------------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
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
            <span class="title">Clients</span>
            </a>
        </li>
        <?php
        }
        ?>
        <!---------------------------- Gestion Clients End    -------------------------------------------->
        <!---------------------------- Gestion Fournisseurs Begin  -------------------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
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
            <span class="title">Fournisseurs</span>
            </a>
        </li>
        <?php
        }
        ?>
        <!---------------------------- Gestion Fournisseurs End    -------------------------------------------->
        <!---------------------------- Gestion Charges Begin  -------------------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
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
            <span class="title">Charges</span>
            </a>
        </li>
        <?php
        }
        ?>
        <!---------------------------- Gestion Charges End    -------------------------------------------->
        <!---------------------------- Parametrage Begin  -------------------------------------------->
        <?php
        if (
            $_SESSION['userstock']->profil() == "admin" ||
            $_SESSION['userstock']->profil() == "manager" ||
            $_SESSION['userstock']->profil() == "consultant"
            ) {
            $gestionParametragesClass="";
            if($currentPage=="configuration.php"
            or $currentPage=="clients-list.php"
            or $currentPage=="categories.php"
            or $currentPage=="produits.php"
            or $currentPage=="produit-update.php"
            or $currentPage=="produit-delete.php"
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
</div>