<?php

require_once('../app/classLoad.php');
session_start();

$redirectLink='../view/users.php';
$idUser = $_GET['idUser'];
$userManager = new UserManager(PDOFactory::getMysqlConnection());
$status = $userManager->getStatusById($idUser);
if ( $status == 0 ) {
	$userManager->changeStatus(1, $idUser);
}
else {
	$userManager->changeStatus(0, $idUser);
}
$_SESSION['user-status-success'] = "<strong>Opération valide</strong> : Status Utilisateur est changé avec succès.";
header('Location:'.$redirectLink);
exit;
?>