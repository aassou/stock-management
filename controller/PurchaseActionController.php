<?php

require_once('../app/AppController.php');

/**
 * Class PurchaseActionController
 */
class PurchaseActionController extends AppController {

    /**
     * @param $formInputs
     */
    public function add($formInputs)
    {
        $this->_formInputs = $formInputs;
        $code = uniqid().date('YmdHis');
        $this->_formInputs['code'] = $code;
        $this->_formInputs['created'] = date('Y-m-d h:i:s');
        $this->_formInputs['createdBy'] = $_SESSION['userstock']->login();

        $this->_validation->validate($this->_formInputs, $this->_formInputs['action']);
        $puchase = new Purchase($this->_formInputs);
        $this->_manager->add($puchase);
        $this->_actionMessage = $this->_validation->getMessage();
        $this->_typeMessage = "success";
        $this->_source = $this->_validation->getTarget();
    }
    
}
