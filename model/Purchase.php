<?php

/**
 * Class Purchase
 */
class Purchase {

    private $_id;
	private $_operationDate;
	private $_number;
	private $_label;
	private $_description;
	private $_clientId;
	private $_code;
	private $_created;
    private $_createdBy;
    private $_updated;
    private $_updatedBy;

    /**
     * Purchase constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->hydrate($data);
    }

    /**
     * @param $data
     */
    public function hydrate($data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //setters
    
    public function setId($id) {
        $this->_id = $id;
    } 

    public function setOperationDate($operationDate) {
        $this->_operationDate = $operationDate;
    }
    public function setNumber($number) {
        $this->_number = $number;
    }
    public function setLabel($label) {
        $this->_label = $label;
    }
    public function setDescription($description) {
        $this->_description = $description;
    }
    public function setClientId($clientId) {
        $this->_clientId = $clientId;
    }
    public function setCode($code) {
        $this->_code = $code;
    }
    
    public function setCreated($created) {
        $this->_created = $created;
    }
    
    public function setCreatedBy($createdBy) {
        $this->_createdBy = $createdBy;
    }
    
    public function setUpdatedBy($updatedBy) {
        $this->_updatedBy = $updatedBy;
    }    
    
    public function setUpdated($updated) {
        $this->_updated = $updated;
    }
    
    //getters
    
    public function getId() {
        return $this->_id;
    }

    public function getOperationDate() {
        return $this->_operationDate;
    }
    
    public function getNumber() {
        return $this->_number;
    }
    
    public function getLabel() {
        return $this->_label;
    }
    
    public function getDescription() {
        return $this->_description;
    }
    
    public function getClientId() {
        return $this->_clientId;
    }
    
    public function getCode() {
        return $this->_code;
    }
    
    public function getCreated() {
        return $this->_created;
    }
    
    public function getCreatedBy() {
        return $this->_createdBy;
    }
    
    public function getUpdated() {
        return $this->_updated;
    }
    
    public function getUpdatedBy() {
        return $this->_updatedBy;
    }
}

