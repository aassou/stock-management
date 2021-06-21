<?php
require_once('../app/classLoad.php');
session_start();

$redirectLink='../index.php';

if (empty($_POST['login']) || empty($_POST['password'])) {
    $_SESSION['signin-error'] = "<strong>Erreur Connexion</strong> Tous les champs sont obligatoires.";
} else {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $userManager = new UserManager(PDOFactory::getMysqlConnection());
    if ($userManager->exists($login, $password)) {
		if ($userManager->getStatus($login)!=0) {
			$_SESSION['userstock'] = $userManager->getUserByLoginPassword($login, $password);
			$redirectLink='../view/dashboard.php';
		} else {
			$_SESSION['signin-error']="<strong>Erreur Connexion</strong> : Votre compte est inactif.";	
		}
    } else {
        $_SESSION['signin-error']="<strong>Erreur Connexion</strong> : Login ou Mot de passe invalide.";
    }
}
header('Location:'.$redirectLink);
exit;
