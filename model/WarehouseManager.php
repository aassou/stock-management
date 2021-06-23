<?php

/**
 * Class WarehouseManager
 */
class WarehouseManager {

	/**
	 * @var PDO
	 */
	private $_db;

	/**
	 * WarehouseManager constructor.
	 * @param $db
	 */
	public function __construct($db) {
    	$this->_db = $db;
	}

	/**
	 * @param Warehouse warehouse
	 */
	public function add(Warehouse $warehouse) {
    	$query = $this->_db->prepare('INSERT INTO t_warehouse (
		productId, quantity, created, createdBy)
		VALUES (:productId, :quantity, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':productId', $warehouse->getProductId());
		$query->bindValue(':quantity', $warehouse->getQuantity());
		$query->bindValue(':created', $warehouse->getCreated());
		$query->bindValue(':createdBy', $warehouse->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param Warehouse warehouse
	 */
	public function update(Warehouse $warehouse) {
    	$query = $this->_db->prepare('UPDATE t_warehouse SET 
		productId=:productId, quantity=:quantity, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $warehouse->getId());
		$query->bindValue(':productId', $warehouse->getProductId());
		$query->bindValue(':quantity', $warehouse->getQuantity());
		$query->bindValue(':updated', $warehouse->getUpdated());
		$query->bindValue(':updatedBy', $warehouse->getUpdatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$query = $this->_db->prepare('DELETE FROM t_warehouse WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 * @return Warehouse
	 */
	public function getOneById($id) {
    	$query = $this->_db->prepare('SELECT * FROM t_warehouse WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();

		return new Warehouse($data);
	}

	/**
	 * @return array
	 */
	public function getAll() {
		$warehouses = array();
		$query = $this->_db->query('SELECT * FROM t_warehouse ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$warehouses[] = new Warehouse($data);
		}

		$query->closeCursor();

		return $warehouses;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$warehouses = array();
		$query = $this->_db->query('SELECT * FROM t_warehouse ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$warehouses[] = new Warehouse($data);

		}

		$query->closeCursor();

		return $warehouses;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS warehousesNumber FROM t_warehouse');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['warehousesNumber'];
	}

	/**
	 * @return mixed
	 */
	public function getLastId() {
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_warehouse ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data['last_id'] ?? 0;
	}
}
