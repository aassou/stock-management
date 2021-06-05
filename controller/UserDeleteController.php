<?php
require_once('../app/classLoad.php');
include('../config.php');
session_start();

$idUser = $_POST['idUser'];
$userManager = new UserManager(PDOFactory::getMysqlConnection());
$userManager->delete($idUser);
$_SESSION['user-delete-success'] = "<strong>Opération valide</strong> : Utlisateur supprimé avec succès.";
header('Location:../view/users.php');

