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
	public function add(Sale $sale) {
    	$query = $this->_db->prepare('INSERT INTO t_sale (
		operationDate, number, label, description, clientId, code, created, createdBy)
		VALUES (:operationDate, :number, :label, :description, :clientId, :code, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':operationDate', $sale->getOperationDate());
		$query->bindValue(':number', $sale->getNumber());
		$query->bindValue(':label', $sale->getLabel());
		$query->bindValue(':description', $sale->getDescription());
		$query->bindValue(':clientId', $sale->getClientId());
        $query->bindValue(':code', $sale->getCode());
		$query->bindValue(':created', $sale->getCreated());
		$query->bindValue(':createdBy', $sale->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param Sale Sale
	 */
	public function update(Sale $sale) {
    	$query = $this->_db->prepare('UPDATE t_sale SET 
		operationDate=:operationDate, number=:number, label=:label, description=:description, clientId=:clientId, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $sale->getId());
		$query->bindValue(':operationDate', $sale->getOperationDate());
		$query->bindValue(':number', $sale->getNumber());
		$query->bindValue(':label', $sale->getLabel());
		$query->bindValue(':description', $sale->getDescription());
		$query->bindValue(':clientId', $sale->getClientId());
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
     * @param $code
     * @return Sale
     */
    public function getOneByCode($code) {
        $query = $this->_db->prepare('SELECT * FROM t_sale WHERE code=:code')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':code', $code);
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

    /**
     * @return mixed
     */
    public function getSaleNumberPerWeek(){
        $query = $this->_db->query('
            SELECT COUNT(id) AS saleNumber 
            FROM t_sale 
            WHERE operationDate BETWEEN SUBDATE(CURDATE(),7) AND CURDATE()
        ');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $data['saleNumber'];
    }
}
