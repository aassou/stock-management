<?php
include('include/config.php');
include('model/ProduitManager.php');
//$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
$produitManager = new ProduitManager($pdo);
$idCategorie = $_POST['idCategorie'];
//SQL
//$sql = "select item from products where brand='$brand'";
$produits = $produitManager->getProduitsByIdCategorie($idCategorie); 
/*$res = mysqli_query($con,$sql);
 
$result = array();
 
while($row = mysqli_fetch_array($res)){
    array_push($result, 
    array('item'=>$row[0]));
}*/
 
//echo json_encode(array('result'=>$result));
session_start();
$_SESSION['products-choosed'] = $produits;
//echo json_encode($produits);