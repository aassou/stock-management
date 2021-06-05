<?php

/**
 * Class Sale
 */
class Sale {

    private $_id;
	private $_quantity;
	private $_price;
	private $_discount;
	private $_total;
	private $_description;
	private $_created;
    private $_createdBy;
    private $_updated;
    private $_updatedBy;

    /**
     * Sale constructor.
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

    public function setQuantity($quantity) {
        $this->_quantity = $quantity;
    }
    public function setPrice($price) {
        $this->_price = $price;
    }
    public function setDiscount($discount) {
        $this->_discount = $discount;
    }
    public function setTotal($total) {
        $this->_total = $total;
    }
    public function setDescription($description) {
        $this->_description = $description;
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

    public function getQuantity() {
        return $this->_quantity;
    }
    
    public function getPrice() {
        return $this->_price;
    }
    
    public function getDiscount() {
        return $this->_discount;
    }
    
    public function getTotal() {
        return $this->_total;
    }
    
    public function getDescription() {
        return $this->_description;
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

