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

    //Component Class Manager

    $clientManager = new ClientManager($pdo);
	//Action Add Processing Begin
    	if($action == "add"){
        if( !empty($_POST['code']) ){
			$code = htmlentities($_POST['code']);
			$matricule = htmlentities($_POST['matricule']);
			$nom = htmlentities($_POST['nom']);
			$cin = htmlentities($_POST['cin']);
			$ville = htmlentities($_POST['ville']);
			$telephone = htmlentities($_POST['telephone']);
			$createdBy = $_SESSION['userMerlaTrav']->login();
            $created = date('Y-m-d h:i:s');
            //create object
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
            //add it to db
            $clientManager->add($client);
            $actionMessage = "Opération Valide : Client Ajouté(e) avec succès.";  
            $typeMessage = "success";
        }
        else{
            $actionMessage = "Erreur Ajout client : Vous devez remplir le champ 'code'.";
            $typeMessage = "error";
        }
    }
    //Action Add Processing End
    //Action Update Processing Begin
    else if($action == "update"){
        $idClient = htmlentities($_POST['idClient']);
        if(!empty($_POST['code'])){
			$code = htmlentities($_POST['code']);
			$matricule = htmlentities($_POST['matricule']);
			$nom = htmlentities($_POST['nom']);
			$cin = htmlentities($_POST['cin']);
			$ville = htmlentities($_POST['ville']);
			$telephone = htmlentities($_POST['telephone']);
			$updatedBy = $_SESSION['userMerlaTrav']->login();
            $updated = date('Y-m-d h:i:s');
            			$client = new Client(array(
				'id' => $idClient,
				'code' => $code,
				'matricule' => $matricule,
				'nom' => $nom,
				'cin' => $cin,
				'ville' => $ville,
				'telephone' => $telephone,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $clientManager->update($client);
            $actionMessage = "Opération Valide : Client Modifié(e) avec succès.";
            $typeMessage = "success";
        }
        else{
            $actionMessage = "Erreur Modification Client : Vous devez remplir le champ 'code'.";
            $typeMessage = "error";
        }
    }
    //Action Update Processing End
    //Action Delete Processing Begin
    else if($action == "delete"){
        $idClient = htmlentities($_POST['idClient']);
        $clientManager->delete($idClient);
        $actionMessage = "Opération Valide : Client supprimé(e) avec succès.";
        $typeMessage = "success";
    }
    //Action Delete Processing End
    $_SESSION['client-action-message'] = $actionMessage;
    $_SESSION['client-type-message'] = $typeMessage;
    header('Location:../file-name-please.php');

