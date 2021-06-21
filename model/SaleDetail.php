<?php

/**
 * Class SaleDetail
 */
class SaleDetail {

    private $_id;
	private $_productId;
	private $_quantity;
	private $_price;
	private $_description;
	private $_codeSale;
	private $_created;
    private $_createdBy;
    private $_updated;
    private $_updatedBy;

    /**
     * SaleDetail constructor.
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

    public function setProductId($productId) {
        $this->_productId = $productId;
    }

    public function setQuantity($quantity) {
        $this->_quantity = $quantity;
    }

    public function setPrice($price) {
        $this->_price = $price;
    }

    public function setDescription($description) {
        $this->_description = $description;
    }

    public function setCodeSale($codeSale) {
        $this->_codeSale = $codeSale;
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

    public function getProductId() {
        return $this->_productId;
    }
    
    public function getQuantity() {
        return $this->_quantity;
    }
    
    public function getPrice() {
        return $this->_price;
    }
    
    public function getDescription() {
        return $this->_description;
    }

    public function getCodeSale() {
        return $this->_codeSale;
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

