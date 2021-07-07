<?php

use Mpdf\Mpdf;
use Mpdf\MpdfException;

require_once '../app/classLoad.php';
require_once '../vendor/autoload.php';

session_start();

if (isset($_SESSION['userstock'])) {
    $codePurchase = htmlentities($_GET['codePurchase']);

    // Create Controller
    $purchaseActionController = new PurchaseActionController('purchase');
    $purchaseDetailActionController = new PurchaseDetailActionController('purchaseDetail');
    $providerActionController = new ProviderActionController('provider');

    // Legacy Calls
    $productManager = new ProduitManager(PDOFactory::getMysqlConnection());

    // Vars and objects
    $purchase = $purchaseActionController->getOneByCode($codePurchase);
    $purchaseDetails = $purchaseDetailActionController->getAllByCode($codePurchase);
    $totalAmountByCodePurchase = $purchaseDetailActionController->getTotalAmountByCode($codePurchase);
    $products = $productManager->getProduits();
    $provider = $providerActionController->getOneById($purchase->getClientId());

    ob_start();
?>
<html>
    <head>
        <?php include'styling.php' ?>
    </head>
    <body>
        <h1 class="text-align-center">Bon de livraison</h1>
        <p class="text-align-center">
            <span class="bold">Fournisseur</span>:
            <?= $provider->getName() ?>
        </p>
        <p class="text-align-center">
            <span class="bold">Date</span>:
            <?= date('d/m/Y', strtotime($purchase->getOperationDate())) ?>
        </p>
        <p class="text-align-center">
            <span class="bold">Référence</span>:
            <?= $purchase->getNumber() ?>
        </p>
        <br><br>
        <table class="w100 text-align-center">
                <tr>
                    <td class="header w30">Produit</td>
                    <td class="header w20">Prix</td>
                    <td class="header w20">Quantité</td>
                    <td class="header w20">Total</td>
                </tr>
            <?php
            foreach ($purchaseDetails as $purchaseDetail) {
                $product = $productManager->getProduitById($purchaseDetail->getProductId());
                ?>
                <tr>
                    <td class="w30"><?= $product->code() ?></td>
                    <td class="w30"><?= Utils::numberFormatMoney($purchaseDetail->getPrice()) ?></td>
                    <td class="w20"><?= $purchaseDetail->getQuantity() ?></td>
                    <td class="w30"><?= Utils::numberFormatMoney($purchaseDetail->getPrice() * $purchaseDetail->getQuantity()) ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td class="header w30"></td>
                <td class="header w20"></td>
                <td class="header w20">Total</td>
                <td class="header w20">
                    <a>
                        <?= Utils::numberFormatMoney($totalAmountByCodePurchase) ?>
                        &nbsp;DH
                    </a>
                </td>
            </tr>
        </table>
    </body>
</html>
<?php
    $content = ob_get_clean();

    try {
        $mpdf = new Mpdf([
            'format' => 'A5-P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle(sprintf("Bon de livraison %s", date('d-m-Y')));
        $mpdf->SetAuthor("Acme Trading Co.");
        $mpdf->SetWatermarkText("Paid");
        $mpdf->showWatermarkText = false;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($content);
        $mpdf->Output();
    } catch (MpdfException $e) {
        die($e->getMessage());
    }
}
else {
    header('Location:../index.php');
}
