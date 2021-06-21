<?php
include('config.php');
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM t_produit WHERE code LIKE (:keyword) ORDER BY id ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
    // put in bold the written text
    $code = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['code']);
    // add new option
    echo '<li onclick="setItemProduit(\''.str_replace("'", "\'", $rs['code']).'\', \''.$rs['dimension1'].
    '\', \''.$rs['dimension2'].'\', \''.$rs['prixAchat'].'\', \''.$rs['prixVente'].'\', 
    \''.$rs['prixVenteMin'].'\', \''.$rs['quantite'].'\', \''.$rs['id'].'\')">'.$code.'</li>';
}
?>
