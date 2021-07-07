<?php

require_once('../app/AppController.php');

/**
 * Class SaleDetailActionController
 */
class SaleDetailActionController extends AppController {

    public function add($formInputs)
    {
        parent::add($formInputs);

        $productManager = new ProduitManager(PDOFactory::getMysqlConnection());
        $productManager->updateProductQuantity($formInputs['productId'], -$formInputs['quantity']);
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getAllByCode($code) {
        return $this->_manager->getAllByCode($code);
    }

    /**
     * @param $codeSale
     * @return mixed
     */
    public function getTotalAmountByCode($codeSale) {
        return $this->_manager->getTotalAmountByCode($codeSale);
    }
}
