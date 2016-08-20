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
    //classes loading end
    session_start();
    if( isset($_SESSION['userMerlaTrav']) ){
            $idFacture = htmlentities($_GET['idFacture']);
            //Class Managers
            $factureManager = new FactureManager($pdo);
            $factureDetailsManager = new FactureDetailsManager($pdo);
            $produitManager = new ProduitManager($pdo);
            $clientManager = new ClientManager($pdo);
            //objs and vars
            $facture = $factureManager->getFactureById($idFacture);
            $client = $clientManager->getClientById($facture->idClient());
            $factureDetails = $factureDetailsManager->getFacturesDetailByIdFacture($facture->id());
            $totalFactureDetails = 
            $factureDetailsManager->getTotalFactureByIdFacture($facture->id());
            $nombreArticle = 
            $factureDetailsManager->getNombreArticleFactureByIdFacture($facture->id());

ob_start();
?>
<style type="text/css">
    p, h1, h2, h3{
        text-align: center;
        text-decoration: underline;
    }
    table {
            border-collapse: collapse;
            width:100%;
        }
        
        table, th, td {
            border: 1px solid black;
        }
        td, th{
            padding : 5px;
        }
        
        th{
            background-color: grey;
        }
        p.facture-title{
            font-size: 16px;
            font-weight:bold;
            text-align: center;
        }
</style>
<page backtop="15mm" backbottom="20mm" backleft="10mm" backright="10mm">
    <!--img src="../assets/img/logo_company.png" style="width: 110px" /-->
    <h3>Facture</h3>
    <p class="facture-title">Client : <?= $client->nom() ?>&nbsp;/&nbsp;
    Date : <?= date('d/m/Y', strtotime($facture->date())) ?></p>
    <table>
        <tr>
            <th style="width: 30%">Produit</th>
            <th style="width: 15%">Quantité</th>
            <th style="width: 25%">Prix.Uni</th>
            <th style="width: 30%">Total</th>
        </tr>
        <?php
        foreach($factureDetails as $detail){
            $produit = $produitManager->getProduitById($detail->idProduit());
        ?>      
        <tr>
            <td>
                <?= $detail->designation() ?>
            </td>
            <td>
                <?= ($detail->quantite()+0) ?>
            </td>
            <td>
                <?= number_format($detail->prixUnitaire(), '2', ',', ' ') ?>&nbsp;DH
            </td>
            <td>
                <?= number_format($detail->prixUnitaire() * $detail->quantite(), '2', ',', ' ') ?>&nbsp;DH
            </td>
        </tr>   
        <?php
        }//end of loop
        ?>
    </table>
    <br />
    <table>
        <tr>
            <th style="width: 70%"><strong>Grand Total</strong></th>
            <th style="width: 30%"><strong><?= number_format($totalFactureDetails, 2, ',', ' ') ?>&nbsp;DH</strong></th>
        </tr>
    </table> 
    <br><br>
    <page_footer>
    <hr/>
    <p style="text-align: center;font-size: 9pt;">Imprimé le <?= date('d/m/Y') ?> | <?= date('h:i') ?> </p>
    </page_footer>
</page>    
<?php
    $content = ob_get_clean();
    
    require('../lib/html2pdf/html2pdf.class.php');
    try{
        $pdf = new HTML2PDF('P', 'A5', 'fr');
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->writeHTML($content);
        $fileName = "Facture-".date('Ymdhi').'.pdf';
        $pdf->Output($fileName);
    }
    catch(HTML2PDF_exception $e){
        die($e->getMessage());
    }
}
else{
    header("Location:index.php");
}
?>