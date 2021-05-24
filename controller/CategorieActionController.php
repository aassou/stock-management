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

    $categorieManager = new CategorieManager($pdo);
	//Action Add Processing Begin
    	if($action == "add"){
        if( !empty($_POST['nomFR']) ){
			$nomFR = htmlentities($_POST['nomFR']);
			$forme = htmlentities($_POST['forme']);
			$couleur = htmlentities($_POST['couleur']);
			$createdBy = $_SESSION['userMerlaTrav']->login();
            $created = date('Y-m-d h:i:s');
            //create object
            $categorie = new Categorie(array(
				'nomFR' => $nomFR,
				'forme' => $forme,
				'couleur' => $couleur,
				'created' => $created,
            	'createdBy' => $createdBy
			));
            //add it to db
            $categorieManager->add($categorie);
            $actionMessage = "Opération Valide : Categorie Ajouté(e) avec succès.";  
            $typeMessage = "success";
        }
        else{
            $actionMessage = "Erreur Ajout categorie : Vous devez remplir le champ 'nomAR'.";
            $typeMessage = "error";
        }
    }
    //Action Add Processing End
    //Action Update Processing Begin
    else if($action == "update"){
        $idCategorie = htmlentities($_POST['idCategorie']);
        if(!empty($_POST['nomFR'])){
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
        }
        else{
            $actionMessage = "Erreur Modification Categorie : Vous devez remplir le champ 'nomAR'.";
            $typeMessage = "error";
        }
    }
    //Action Update Processing End
    //Action Delete Processing Begin
    else if($action == "delete"){
        $idCategorie = htmlentities($_POST['idCategorie']);
        //delete attached products before categorie
        $produitManager = new ProduitManager($pdo);
        $produitManager->deleteByIdCategorie($idCategorie);
        //then delete the categorie
        $categorieManager->delete($idCategorie);
        $actionMessage = "Opération Valide : Categorie supprimé(e) avec succès.";
        $typeMessage = "success";
    }
    //Action Delete Processing End
    $_SESSION['categorie-action-message'] = $actionMessage;
    $_SESSION['categorie-type-message'] = $typeMessage;
    if ( isset($_POST['source']) and $_POST['source'] == "produits" ) {
        $redirectLink = "Location:../produits.php";
    }
    if ( isset($_POST['source']) and $_POST['source'] == "stock" ) {
        $redirectLink = "Location:../stock.php";
    }  
    else {
        $redirectLink = "Location:../categories.php";
    }
    header($redirectLink);