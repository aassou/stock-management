<?php
require_once('../app/classLoad.php');
include('../config.php');
session_start();

//post input processing
$idUser = $_POST['idUser'];
$profil = $_POST['profil'];
$userManager = new UserManager(PDOFactory::getMysqlConnection());
$userManager->updateProfil($idUser, $profil);
$_SESSION['user-update-success'] = "<strong>Opération valide</strong> : Profil Utlisateur est modifié avec succès.";
header('Location:../view/users.php');