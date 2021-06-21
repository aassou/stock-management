<?php

/**
 * Class SaleManager
 */
class SaleManager {

	/**
	 * @var PDO
	 */
	private $_db;

	/**
	 * SaleManager constructor.
	 * @param $db
	 */
	public function __construct($db) {
    	$this->_db = $db;
	}

	/**
	 * @param Sale Sale
	 */
	public function add(Sale $Sale) {
    	$query = $this->_db->prepare('INSERT INTO t_sale (
		operationDate, number, label, description, clientId, code, created, createdBy)
		VALUES (:operationDate, :number, :label, :description, :clientId, :code, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':operationDate', $Sale->getOperationDate());
		$query->bindValue(':number', $Sale->getNumber());
		$query->bindValue(':label', $Sale->getLabel());
		$query->bindValue(':description', $Sale->getDescription());
		$query->bindValue(':clientId', $Sale->getClientId());
        $query->bindValue(':code', $Sale->getCode());
		$query->bindValue(':created', $Sale->getCreated());
		$query->bindValue(':createdBy', $Sale->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param Sale Sale
	 */
	public function update(Sale $Sale) {
    	$query = $this->_db->prepare('UPDATE t_sale SET 
		operationDate=:operationDate, number=:number, label=:label, description=:description, clientId=:clientId, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $Sale->getId());
		$query->bindValue(':operationDate', $Sale->getOperationDate());
		$query->bindValue(':number', $Sale->getNumber());
		$query->bindValue(':label', $Sale->getLabel());
		$query->bindValue(':description', $Sale->getDescription());
		$query->bindValue(':clientId', $Sale->getClientId());
		$query->bindValue(':updated', $Sale->getUpdated());
		$query->bindValue(':updatedBy', $Sale->getUpdatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$query = $this->_db->prepare('DELETE FROM t_sale WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 * @return Sale
	 */
	public function getOneById($id) {
    	$query = $this->_db->prepare('SELECT * FROM t_sale WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();

		return new Sale($data);
	}

	/**
	 * @return array
	 */
	public function getAll() {
		$Sales = array();
		$query = $this->_db->query('SELECT * FROM t_sale ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$Sales[] = new Sale($data);
		}

		$query->closeCursor();

		return $Sales;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$Sales = array();
		$query = $this->_db->query('SELECT * FROM t_sale ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$Sales[] = new Sale($data);

		}

		$query->closeCursor();

		return $Sales;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS SalesNumber FROM t_sale');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['SalesNumber'];
	}

	/**
	 * @return mixed
	 */
	public function getLastId() {
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_sale ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data['last_id'] ?? 0;
	}
}
