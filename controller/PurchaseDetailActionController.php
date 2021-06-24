<?php

require_once('../app/AppController.php');

/**
 * Class PurchaseDetailActionController
 */
class PurchaseDetailActionController extends AppController {

    /**
     * @param $formInputs
     */
    public function add($formInputs) {
        parent::add($formInputs);

        $productManager = new ProduitManager(PDOFactory::getMysqlConnection());
        $productManager->updateProductQuantity($formInputs['productId'], $formInputs['quantity']);
    }

    /**
     * @param $code
     */
    public function getAllByCode($code) {
        $this->_manager->getAllByCode($code);
    }
}
