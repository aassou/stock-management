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
	 * @param Sale sale
	 */
	public function add(Sale $sale) {
    	$query = $this->_db->prepare('INSERT INTO t_sale (
		quantity, price, discount, total, description, created, createdBy)
		VALUES (:quantity, :price, :discount, :total, :description, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':quantity', $sale->getQuantity());
		$query->bindValue(':price', $sale->getPrice());
		$query->bindValue(':discount', $sale->getDiscount());
		$query->bindValue(':total', $sale->getTotal());
		$query->bindValue(':description', $sale->getDescription());
		$query->bindValue(':created', $sale->getCreated());
		$query->bindValue(':createdBy', $sale->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param Sale sale
	 */
	public function update(Sale $sale) {
    	$query = $this->_db->prepare('UPDATE t_sale SET 
		quantity=:quantity, price=:price, discount=:discount, total=:total, description=:description, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $sale->getId());
		$query->bindValue(':quantity', $sale->getQuantity());
		$query->bindValue(':price', $sale->getPrice());
		$query->bindValue(':discount', $sale->getDiscount());
		$query->bindValue(':total', $sale->getTotal());
		$query->bindValue(':description', $sale->getDescription());
		$query->bindValue(':updated', $sale->getUpdated());
		$query->bindValue(':updatedBy', $sale->getUpdatedBy());
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
		$sales = array();
		$query = $this->_db->query('SELECT * FROM t_sale ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$sales[] = new Sale($data);
		}

		$query->closeCursor();

		return $sales;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$sales = array();
		$query = $this->_db->query('SELECT * FROM t_sale ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$sales[] = new Sale($data);

		}

		$query->closeCursor();

		return $sales;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS salesNumber FROM t_sale');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['salesNumber'];
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
