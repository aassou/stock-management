<?php

/**
 * Class PurchaseManager
 */
class PurchaseManager {

	/**
	 * @var PDO
	 */
	private $_db;

	/**
	 * PurchaseManager constructor.
	 * @param $db
	 */
	public function __construct($db) {
    	$this->_db = $db;
	}

	/**
	 * @param Purchase purchase
	 */
	public function add(Purchase $purchase) {
    	$query = $this->_db->prepare('INSERT INTO t_purchase (
		operationDate, number, label, description, clientId, code, created, createdBy)
		VALUES (:operationDate, :number, :label, :description, :clientId, :code, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':operationDate', $purchase->getOperationDate());
		$query->bindValue(':number', $purchase->getNumber());
		$query->bindValue(':label', $purchase->getLabel());
		$query->bindValue(':description', $purchase->getDescription());
		$query->bindValue(':clientId', $purchase->getClientId());
		$query->bindValue(':code', $purchase->getCode());
		$query->bindValue(':created', $purchase->getCreated());
		$query->bindValue(':createdBy', $purchase->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param Purchase purchase
	 */
	public function update(Purchase $purchase) {
    	$query = $this->_db->prepare('UPDATE t_purchase SET 
		operationDate=:operationDate, number=:number, label=:label, description=:description, clientId=:clientId, code=:code, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $purchase->getId());
		$query->bindValue(':operationDate', $purchase->getOperationDate());
		$query->bindValue(':number', $purchase->getNumber());
		$query->bindValue(':label', $purchase->getLabel());
		$query->bindValue(':description', $purchase->getDescription());
		$query->bindValue(':clientId', $purchase->getClientId());
		$query->bindValue(':code', $purchase->getCode());
		$query->bindValue(':updated', $purchase->getUpdated());
		$query->bindValue(':updatedBy', $purchase->getUpdatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$query = $this->_db->prepare('DELETE FROM t_purchase WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 * @return Purchase
	 */
	public function getOneById($id) {
    	$query = $this->_db->prepare('SELECT * FROM t_purchase WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();

		return new Purchase($data);
	}

    /**
     * @param $code
     * @return Purchase
     */
    public function getOneByCode($code) {
        $query = $this->_db->prepare('SELECT * FROM t_purchase WHERE code=:code')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':code', $code);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return new Purchase($data);
    }

	/**
	 * @return array
	 */
	public function getAll() {
		$purchases = array();
		$query = $this->_db->query('SELECT * FROM t_purchase ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$purchases[] = new Purchase($data);
		}

		$query->closeCursor();

		return $purchases;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$purchases = array();
		$query = $this->_db->query('SELECT * FROM t_purchase ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$purchases[] = new Purchase($data);

		}

		$query->closeCursor();

		return $purchases;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS purchasesNumber FROM t_purchase');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['purchasesNumber'];
	}

	/**
	 * @return mixed
	 */
	public function getLastId() {
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_purchase ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data['last_id'] ?? 0;
	}

    /**
     * @return mixed
     */
    public function getPurchaseNumberPerWeek(){
        $query = $this->_db->query('
            SELECT COUNT(id) AS purchaseNumber 
            FROM t_purchase 
            WHERE operationDate BETWEEN SUBDATE(CURDATE(),7) AND CURDATE()
        ');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $data['purchaseNumber'];
    }
}

