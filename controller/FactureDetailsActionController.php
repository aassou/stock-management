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
    $produitManager = new ProduitManager($pdo);
    $factureDetailsManager = new FactureDetailsManager($pdo);
	//Action Add Processing Begin
    if($action == "add"){
        if( !empty($_POST['codeProduit']) 
        and !empty($_POST['prixUnitaire']) 
        and !empty($_POST['quantite'])
        and $_POST['quantite'] > 0
        and $_POST['prixUnitaire'] > 0 ){
			$designation = htmlentities($_POST['codeProduit']);
			$quantite = htmlentities($_POST['quantite']);
			$prixUnitaire = htmlentities($_POST['prixUnitaire']);
			$idFacture = htmlentities($_POST['idFacture']);
            $codeFacture = htmlentities($_POST['codeFacture']);
            $idProduit = htmlentities($_POST['idProduit']);
			$createdBy = $_SESSION['userMerlaTrav']->login();
            $created = date('Y-m-d h:i:s');
            $produit = $produitManager->getProduitById($idProduit);
            
            if ( ($quantite > $produit->quantite()) or $prixUnitaire < $produit->prixVenteMin() ) {
                if ( ($quantite > $produit->quantite()) and $prixUnitaire < $produit->prixVenteMin() ) {
                    $actionMessage = "<strong>Erreur Ajout Produit</strong> : Manque de quantité en stock.<br>";
                    $actionMessage .= "<strong>Erreur Ajout Produit</strong> : Prix inférieur au PrixVenteMin.";    
                }
                else if ( $prixUnitaire < $produit->prixVenteMin() ) {
                    $actionMessage = "<strong>Erreur Ajout Produit</strong> : Prix inférieur au PrixVenteMin.";
                }
                else if ( $quantite > $produit->quantite() ) {
                    $actionMessage = "<strong>Erreur Ajout Produit</strong> : Manque de quantité en stock.";
                } 
                $typeMessage = "error";
                $redirectLink = "Location:../facture-details.php?codeFacture=".$codeFacture;
                $_SESSION['facture-details-action-message'] = $actionMessage;
                $_SESSION['facture-details-type-message'] = $typeMessage;
                header($redirectLink);
                exit;
            }
            //create object
            $factureDetails = new FactureDetails(array(
				'designation' => $designation,
				'quantite' => $quantite,
				'prixUnitaire' => $prixUnitaire,
				'idFacture' => $idFacture,
				'idProduit' => $idProduit,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $factureDetailsManager->add($factureDetails);
            $actionMessage = "<strong>Opération Valide</strong> : Produit Ajouté(e) avec succès.";  
            $typeMessage = "success";
        }
        else{
            $actionMessage = "<strong>Erreur Ajout Produit</strong> : Vous devez remplir tous les champs <strong>Produit, Prix Unitaire et Quantité</strong>.";
            $typeMessage = "error";
        }
    }
    //Action Add Processing End
    //Action Update Processing Begin
    else if($action == "update"){
        $codeFacture = htmlentities($_POST['codeFacture']);
        $idFactureDetails = htmlentities($_POST['idFactureDetail']);
        $factureDetails = $factureDetailsManager->getFactureDetailsById($idFactureDetails);
        if( !empty($_POST['prixUnitaire']) 
        and !empty($_POST['quantite'])
        and $_POST['quantite'] > 0
        and $_POST['prixUnitaire'] > 0 ){
			$quantite = htmlentities($_POST['quantite']);
			$prixUnitaire = htmlentities($_POST['prixUnitaire']);
			$updatedBy = $_SESSION['userMerlaTrav']->login();
            $updated = date('Y-m-d h:i:s');
            $produit = $produitManager->getProduitById($factureDetails->idProduit());
            if ( ($quantite > $produit->quantite()) or $prixUnitaire < $produit->prixVenteMin() ) {
                if ( ($quantite > $produit->quantite()) and $prixUnitaire < $produit->prixVenteMin() ) {
                    $actionMessage = "<strong>Erreur Modification Produit</strong> : Manque de quantité en stock.<br>";
                    $actionMessage .= "<strong>Erreur Modification Produit</strong> : Prix inférieur au PrixVenteMin.";    
                }
                else if ( $prixUnitaire < $produit->prixVenteMin() ) {
                    $actionMessage = "<strong>Erreur Modification Produit</strong> : Prix inférieur au PrixVenteMin.";
                }
                else if ( $quantite > $produit->quantite() ) {
                    $actionMessage = "<strong>Erreur Modification Produit</strong> : Manque de quantité en stock.";
                } 
                $typeMessage = "error";
                $redirectLink = "Location:../facture-details.php?codeFacture=".$codeFacture;
                $_SESSION['facture-details-action-message'] = $actionMessage;
                $_SESSION['facture-details-type-message'] = $typeMessage;
                header($redirectLink);
                exit;
            }
            $factureDetails = new FactureDetails(array(
				'id' => $idFactureDetails,
				'quantite' => $quantite,
				'prixUnitaire' => $prixUnitaire,
				'updated' => $updated,
            	'updatedBy' => $updatedBy
			));
            $factureDetailsManager->update($factureDetails);
            $actionMessage = "<strong>Opération Valide</strong> : Facture Modifié(e) avec succès.";
            $typeMessage = "success";
        }
        else{
            $actionMessage = "<strong>Erreur Modification Facture</strong> : Vous devez remplir tous les champs <strong>Produit, Prix Unitaire et Quantité</strong>.";
            $typeMessage = "error";
        }
    }
    //Action Update Processing End
    //Action Delete Processing Begin
    else if($action == "delete"){
        $idFactureDetails = htmlentities($_POST['idFactureDetail']);
        $factureDetailsManager->delete($idFactureDetails);
        $actionMessage = "<strong>Opération Valide</strong> : Facture supprimé(e) avec succès.";
        $typeMessage = "success";
    }
    //Action Delete Processing End
    $_SESSION['facture-details-action-message'] = $actionMessage;
    $_SESSION['facture-details-type-message'] = $typeMessage;
    if ( isset($_POST['source']) and $_POST['source'] == "dashboard" ) {
        $redirectLink = "Location:../dashboard.php";
    }
    else {
        $codeFacture = htmlentities($_POST['codeFacture']);
        $redirectLink = "Location:../facture-details.php?codeFacture=".$codeFacture;
    }
    header($redirectLink);