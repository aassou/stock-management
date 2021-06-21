<?php
require_once('../app/classLoad.php');
include('../config.php');
session_start();

//post input processing
$action = htmlentities($_POST['action']);
//This var contains result message of CRUD action
$actionMessage = "";
$typeMessage = "";
$redirectLink = "Location:../view/produits.php";

$produitManager = new ProduitManager(PDOFactory::getMysqlConnection());

if ($action == "add") {
    if (!empty($_POST['code'])) {
        $prixAchat = htmlentities($_POST['prixAchat']);
        $prixVente = htmlentities($_POST['prixVente']);
        $prixVenteMin = htmlentities($_POST['prixVenteMin']);
        $quantite = htmlentities($_POST['quantite']);
        $code = htmlentities($_POST['code']);
        $idCategorie = htmlentities($_POST['idCategorie']);
        $createdBy = $_SESSION['userstock']->login();
        $created = date('Y-m-d h:i:s');

        $produit = new Produit(array(
            'prixAchat' => $prixAchat,
            'prixVente' => $prixVente,
            'prixVenteMin' => $prixVenteMin,
            'quantite' => $quantite,
            'code' => $code,
            'idCategorie' => $idCategorie,
            'created' => $created,
            'createdBy' => $createdBy
        ));

        $produitManager->add($produit);
        $actionMessage = "Opération Valide : Produit Ajouté(e) avec succès.";
        $typeMessage = "success";
    } else {
        $actionMessage = "Erreur Ajout produit : Vous devez remplir le champ 'dimension'.";
        $typeMessage = "error";
    }
} elseif ($action == "update") {
    $idProduit = htmlentities($_POST['idProduit']);

    if(!empty($_POST['code'])){
        $prixAchat = htmlentities($_POST['prixAchat']);
        $prixVente = htmlentities($_POST['prixVente']);
        $prixVenteMin = htmlentities($_POST['prixVenteMin']);
        $quantite = htmlentities($_POST['quantite']);
        $code = htmlentities($_POST['code']);
        $idCategorie = htmlentities($_POST['idCategorie']);
        $updatedBy = $_SESSION['userstock']->login();
        $updated = date('Y-m-d h:i:s');

        $produit = new Produit(array(
            'id' => $idProduit,
            'prixAchat' => $prixAchat,
            'prixVente' => $prixVente,
            'prixVenteMin' => $prixVenteMin,
            'quantite' => $quantite,
            'code' => $code,
            'idCategorie' => $idCategorie,
            'updated' => $updated,
            'updatedBy' => $updatedBy
        ));

        $produitManager->update($produit);
        $actionMessage = "Opération Valide : Produit Modifié(e) avec succès.";
        $typeMessage = "success";
    } else {
        $actionMessage = "Erreur Modification Produit : Vous devez remplir le champ 'dimension'.";
        $typeMessage = "error";
    }
} elseif ($action == "updateQuantite") {
    $idProduit = htmlentities($_POST['idProduit']);
    $quantite = htmlentities($_POST['quantite']);
    $updatedBy = $_SESSION['userstock']->login();
    $updated = date('Y-m-d h:i:s');
    $produitManager->updateQuantite($idProduit, $quantite);
        ///$actionMessage = "Opération Valide : Produit Modifié(e) avec succès.";
        ///$typeMessage = "success";
    ///}
    ///else{
       /// $actionMessage = "Erreur Modification Produit : Vous devez remplir le champ 'dimension'.";
       /// $typeMessage = "error";
    ///}
} elseif ($action == "delete") {
    $idProduit = htmlentities($_POST['idProduit']);
    $produitManager->delete($idProduit);
    $actionMessage = "Opération Valide : Produit supprimé(e) avec succès.";
    $typeMessage = "success";
}

$_SESSION['produit-action-message'] = $actionMessage;
$_SESSION['produit-type-message'] = $typeMessage;

if (isset($_POST['source']) and $_POST['source'] == "stock") {
    $redirectLink = "Location:../view/stock.php";
} elseif (isset($_POST['source']) and $_POST['source'] == "produits") {
    $redirectLink = "Location:../view/produits.php";
}

header($redirectLink);

