<?php

/**
 * Class Provider
 */
class Provider {

    private $_id;
	private $_name;
	private $_address;
	private $_phone;
	private $_created;
    private $_createdBy;
    private $_updated;
    private $_updatedBy;

    /**
     * Provider constructor.
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

    public function setName($name) {
        $this->_name = $name;
    }
    public function setAddress($address) {
        $this->_address = $address;
    }
    public function setPhone($phone) {
        $this->_phone = $phone;
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

    public function getName() {
        return $this->_name;
    }
    
    public function getAddress() {
        return $this->_address;
    }
    
    public function getPhone() {
        return $this->_phone;
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

