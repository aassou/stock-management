<?php
require_once('../app/classLoad.php');
include('../config.php');
session_start();

$action = htmlentities($_POST['action']);
$actionMessage = "";
$typeMessage = "";
$clientManager = new ClientManager(PDOFactory::getMysqlConnection());

if ($action == "add") {
    if (!empty($_POST['code'])) {
        $code = htmlentities($_POST['code']);
        $matricule = htmlentities($_POST['matricule']);
        $nom = htmlentities($_POST['nom']);
        $cin = htmlentities($_POST['cin']);
        $ville = htmlentities($_POST['ville']);
        $telephone = htmlentities($_POST['telephone']);
        $createdBy = $_SESSION['userstock']->login();
        $created = date('Y-m-d h:i:s');

        $client = new Client(array(
            'code' => $code,
            'matricule' => $matricule,
            'nom' => $nom,
            'cin' => $cin,
            'ville' => $ville,
            'telephone' => $telephone,
            'created' => $created,
            'createdBy' => $createdBy
        ));

        $clientManager->add($client);
        $actionMessage = "Opération Valide : Client Ajouté(e) avec succès.";
        $typeMessage = "success";
    } else {
        $actionMessage = "Erreur Ajout client : Vous devez remplir le champ 'code'.";
        $typeMessage = "error";
    }
} elseif ($action == "update") {
    $idClient = htmlentities($_POST['idClient']);

    if (!empty($_POST['code'])) {
        $code = htmlentities($_POST['code']);
        $matricule = htmlentities($_POST['matricule']);
        $nom = htmlentities($_POST['nom']);
        $cin = htmlentities($_POST['cin']);
        $ville = htmlentities($_POST['ville']);
        $telephone = htmlentities($_POST['telephone']);
        $updatedBy = $_SESSION['userstock']->login();
        $updated = date('Y-m-d h:i:s');

        $client = new Client(
            [
                'id' => $idClient,
                'code' => $code,
                'matricule' => $matricule,
                'nom' => $nom,
                'cin' => $cin,
                'ville' => $ville,
                'telephone' => $telephone,
                'updated' => $updated,
                'updatedBy' => $updatedBy
            ]
        );

        $clientManager->update($client);
        $actionMessage = "Opération Valide : Client Modifié(e) avec succès.";
        $typeMessage = "success";
    } else {
        $actionMessage = "Erreur Modification Client : Vous devez remplir le champ 'code'.";
        $typeMessage = "error";
    }
} elseif ($action == "delete") {
    $idClient = htmlentities($_POST['idClient']);
    $clientManager->delete($idClient);
    $actionMessage = "Opération Valide : Client supprimé(e) avec succès.";
    $typeMessage = "success";
}

$_SESSION['client-action-message'] = $actionMessage;
$_SESSION['client-type-message'] = $typeMessage;

header('Location:../view/clients-list.php');

