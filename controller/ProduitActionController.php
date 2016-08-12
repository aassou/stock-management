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

    $produitManager = new ProduitManager($pdo);
	//Action Add Processing Begin
    if($action == "add"){
        if( !empty($_POST['dimension']) ){
			$dimension = htmlentities($_POST['dimension']);
			$diametre = htmlentities($_POST['diametre']);
			$forme = htmlentities($_POST['forme']);
			$prixAchat = htmlentities($_POST['prixAchat']);
			$prixVente = htmlentities($_POST['prixVente']);
			$prixVenteMin = htmlentities($_POST['prixVenteMin']);
			$quantite = htmlentities($_POST['quantite']);
			$poids = htmlentities($_POST['poids']);
			$code = htmlentities($_POST['code']);
			$idCategorie = htmlentities($_POST['idCategorie']);
			$createdBy = $_SESSION['userMerlaTrav']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $produit = new Produit(array(
				'dimension' => $dimension,
				'diametre' => $diametre,
				'forme' => $forme,
				'prixAchat' => $prixAchat,
				'prixVente' => $prixVente,
				'prixVenteMin' => $prixVenteMin,
				'quantite' => $quantite,
				'poids' => $poids,
				'code' => $code,
				'idCategorie' => $idCategorie,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $produitManager->add($produit);
            $actionMessage = "Opération Valide : Produit Ajouté(e) avec succès.";  
            $typeMessage = "success";
        }
        else{
            $actionMessage = "Erreur Ajout produit : Vous devez remplir le champ 'dimension'.";
            $typeMessage = "error";
        }
    }
    //Action Add Processing End
    //Action Update Processing Begin
    else if($action == "update"){
        $idProduit = htmlentities($_POST['idProduit']);
        if(!empty($_POST['dimension'])){
			$dimension = htmlentities($_POST['dimension']);
			$diametre = htmlentities($_POST['diametre']);
			$forme = htmlentities($_POST['forme']);
			$prixAchat = htmlentities($_POST['prixAchat']);
			$prixVente = htmlentities($_POST['prixVente']);
			$prixVenteMin = htmlentities($_POST['prixVenteMin']);
			$quantite = htmlentities($_POST['quantite']);
			$poids = htmlentities($_POST['poids']);
			$code = htmlentities($_POST['code']);
			$idCategorie = htmlentities($_POST['idCategorie']);
			$updatedBy = $_SESSION['userMerlaTrav']->login();
            $updated = date('Y-m-d h:i:s');
            $produit = new Produit(array(
				'id' => $idProduit,
				'dimension' => $dimension,
				'diametre' => $diametre,
				'forme' => $forme,
				'prixAchat' => $prixAchat,
				'prixVente' => $prixVente,
				'prixVenteMin' => $prixVenteMin,
				'quantite' => $quantite,
				'poids' => $poids,
				'code' => $code,
				'idCategorie' => $idCategorie,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $produitManager->update($produit);
            $actionMessage = "Opération Valide : Produit Modifié(e) avec succès.";
            $typeMessage = "success";
        }
        else{
            $actionMessage = "Erreur Modification Produit : Vous devez remplir le champ 'dimension'.";
            $typeMessage = "error";
        }
    }
    //Action Update Processing End
    //Action Delete Processing Begin
    else if($action == "delete"){
        $idProduit = htmlentities($_POST['idProduit']);
        $produitManager->delete($idProduit);
        $actionMessage = "Opération Valide : Produit supprimé(e) avec succès.";
        $typeMessage = "success";
    }
    //Action Delete Processing End
    $_SESSION['produit-action-message'] = $actionMessage;
    $_SESSION['produit-type-message'] = $typeMessage;
    header('Location:../produits.php');

