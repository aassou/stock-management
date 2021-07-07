<?php

require_once('../app/AppController.php');

/**
 * Class ClientActionController
 */
class ClientActionController extends AppController {

    /**
     * @return mixed
     */
    public function getNumberWeek() {
        return $this->_manager->getNumberWeek();
    }
}
