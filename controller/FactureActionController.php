<?php

    //classes loading begin
    function classLoad ($myClass) {
        if(file_exists('../model/'.$myClass.'.php')){
            include('../model/'.$myClass.'.php');
        }
        elseif(file_exists('../controller/'.$myClass.'.php')){
            include('../controller/'.$myClass.'.php');
        }
    }
    spl_autoload_register("classLoad"); 
    include('../config.php');  
    include('../lib/image-processing.php');
    //classes loading end
    session_start();
    
    //post input processing
    $action = htmlentities($_POST['action']);
    //This var contains result message of CRUD action
    $actionMessage = "";
    $typeMessage = "";
    $redirectLink = "";
    //Component Class Manager
    $factureManager = new FactureManager($pdo);
	//Action Add Processing Begin
    if($action == "add"){
        if( !empty($_POST['dateFacture']) and !empty($_POST['idClient']) ){
			$date = htmlentities($_POST['dateFacture']);
			$idClient = htmlentities($_POST['idClient']);
			$numero = htmlentities($_POST['numero']);
            $code = uniqid().date('YmdHis');
			$createdBy = $_SESSION['userMerlaTrav']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $facture = new Facture(array(
				'date' => $date,
				'idClient' => $idClient,
				'numero' => $numero,
				'code' => $code,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $factureManager->add($facture);
            $actionMessage = "Opération Valide : Facture Ajouté(e) avec succès.";  
            $typeMessage = "success";
            $redirectLink = "Location:../view/facture-details.php?codeFacture=".$code;
        }
        else{
            $actionMessage = "Erreur Ajout facture : Vous devez remplir les champs 'Date' et 'Client'.";
            $typeMessage = "error";
            $redirectLink = "Location:../view/factures.php";
            if ( isset($_POST['source']) and $_POST['source'] == "dashboard" ){
                $redirectLink = "Location:../view/dashboard.php#factures";
            } 
        }
    }
    //Action Add Processing End
    //Action Update Processing Begin
    else if($action == "update"){
        $idFacture = htmlentities($_POST['idFacture']);
        if(!empty($_POST['date'])){
			$date = htmlentities($_POST['date']);
			$idClient = htmlentities($_POST['idClient']);
			$numero = htmlentities($_POST['numero']);
			$updatedBy = $_SESSION['userMerlaTrav']->login();
            $updated = date('Y-m-d h:i:s');
            $facture = new Facture(array(
				'id' => $idFacture,
				'date' => $date,
				'idClient' => $idClient,
				'numero' => $numero,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $factureManager->update($facture);
            $actionMessage = "Opération Valide : Facture Modifié(e) avec succès.";
            $typeMessage = "success";
        }
        else{
            $actionMessage = "Erreur Modification Facture : Vous devez remplir le champ 'Date' et 'Client'.";
            $typeMessage = "error";
        }
    }
    //Action Update Processing End
    //Action Delete Processing Begin
    else if($action == "delete"){
        $idFacture = htmlentities($_POST['idFacture']);
        $factureManager->delete($idFacture);
        $actionMessage = "Opération Valide : Facture supprimé(e) avec succès.";
        $typeMessage = "success";
    }
    //Action Delete Processing End
    $_SESSION['facture-action-message'] = $actionMessage;
    $_SESSION['facture-type-message'] = $typeMessage;
    header($redirectLink);

