<?php

require_once('../app/AppController.php');

/**
 * Class SaleDetailActionController
 */
class SaleDetailActionController extends AppController {

    /**
     * @param $code
     */
    public function getAllByCode($code) {
        $this->_manager->getAllByCode($code);
    }
}
