<?php
require_once('../app/classLoad.php');
include('../config.php');
session_start();

//post input processing
$action = htmlentities($_POST['action']);
//This var contains result message of CRUD action
$actionMessage = "";
$typeMessage = "";
$redirectLink = "";
$categorieManager = new CategorieManager(PDOFactory::getMysqlConnection());

if ($action == "add") {
    if (!empty($_POST['nomFR'])) {
        $nomFR = htmlentities($_POST['nomFR']);
        $forme = htmlentities($_POST['forme']);
        $couleur = htmlentities($_POST['couleur']);
        $createdBy = $_SESSION['userMerlaTrav']->login();
        $created = date('Y-m-d h:i:s');

        $categorie = new Categorie(array(
            'nomFR' => $nomFR,
            'forme' => $forme,
            'couleur' => $couleur,
            'created' => $created,
            'createdBy' => $createdBy
        ));

        $categorieManager->add($categorie);
        $actionMessage = "Opération Valide : Categorie Ajouté(e) avec succès.";
        $typeMessage = "success";
    } else {
        $actionMessage = "Erreur Ajout categorie : Vous devez remplir le champ 'nomAR'.";
        $typeMessage = "error";
    }
} else if($action == "update") {
    $idCategorie = htmlentities($_POST['idCategorie']);

    if (!empty($_POST['nomFR'])) {
        $nomFR = htmlentities($_POST['nomFR']);
        $forme = htmlentities($_POST['forme']);
        $couleur = htmlentities($_POST['couleur']);
        $updatedBy = $_SESSION['userMerlaTrav']->login();
        $updated = date('Y-m-d h:i:s');

        $categorie = new Categorie(array(
            'id' => $idCategorie,
            'nomFR' => $nomFR,
            'forme' => $forme,
            'couleur' => $couleur,
            'updated' => $updated,
            'updatedBy' => $updatedBy
        ));

        $categorieManager->update($categorie);
        $actionMessage = "Opération Valide : Categorie Modifié(e) avec succès.";
        $typeMessage = "success";
    } else {
        $actionMessage = "Erreur Modification Categorie : Vous devez remplir le champ 'nomAR'.";
        $typeMessage = "error";
    }
} else if($action == "delete") {
    $produitManager = new ProduitManager(PDOFactory::getMysqlConnection());
    $idCategorie = htmlentities($_POST['idCategorie']);
    $categorieManager->delete($idCategorie);
    $actionMessage = "Opération Valide : Categorie supprimé(e) avec succès.";
    $typeMessage = "success";
}

$_SESSION['categorie-action-message'] = $actionMessage;
$_SESSION['categorie-type-message'] = $typeMessage;

if (isset($_POST['source']) and $_POST['source'] == "produits") {
    $redirectLink = "Location:../view/produits.php";
}

if (isset($_POST['source']) and $_POST['source'] == "stock") {
    $redirectLink = "Location:../view/stock.php";
} else {
    $redirectLink = "Location:../view/categories.php";
}

header($redirectLink);