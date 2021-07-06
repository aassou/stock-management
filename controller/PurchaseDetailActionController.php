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
     * @param $id
     * @return mixed
     */
    public function getAllById($id) {
        return $this->_manager->getAllById($id);
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getAllByCode($code) {
        return $this->_manager->getAllByCode($code);
    }

    /**
     * @return mixed
     */
    public function getTotalAmount() {
        return $this->_manager->getTotalAmount();
    }

    /**
     * @param $codePurchase
     * @return mixed
     */
    public function getTotalAmountByCode($codePurchase) {
        return $this->_manager->getTotalAmountByCode($codePurchase);
    }
}
