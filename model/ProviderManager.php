<?php

/**
 * Class ProviderManager
 */
class ProviderManager {

	/**
	 * @var PDO
	 */
	private $_db;

	/**
	 * ProviderManager constructor.
	 * @param $db
	 */
	public function __construct($db) {
    	$this->_db = $db;
	}

	/**
	 * @param Provider provider
	 */
	public function add(Provider $provider) {
    	$query = $this->_db->prepare('INSERT INTO t_provider (
		name, address, phone, created, createdBy)
		VALUES (:name, :address, :phone, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':name', $provider->getName());
		$query->bindValue(':address', $provider->getAddress());
		$query->bindValue(':phone', $provider->getPhone());
		$query->bindValue(':created', $provider->getCreated());
		$query->bindValue(':createdBy', $provider->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param Provider provider
	 */
	public function update(Provider $provider) {
    	$query = $this->_db->prepare('UPDATE t_provider SET 
		name=:name, address=:address, phone=:phone, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $provider->getId());
		$query->bindValue(':name', $provider->getName());
		$query->bindValue(':address', $provider->getAddress());
		$query->bindValue(':phone', $provider->getPhone());
		$query->bindValue(':updated', $provider->getUpdated());
		$query->bindValue(':updatedBy', $provider->getUpdatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$query = $this->_db->prepare('DELETE FROM t_provider WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 * @return Provider
	 */
	public function getOneById($id) {
    	$query = $this->_db->prepare('SELECT * FROM t_provider WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();

		return new Provider($data);
	}

	/**
	 * @return array
	 */
	public function getAll() {
		$providers = array();
		$query = $this->_db->query('SELECT * FROM t_provider ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$providers[] = new Provider($data);
		}

		$query->closeCursor();

		return $providers;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$providers = array();
		$query = $this->_db->query('SELECT * FROM t_provider ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$providers[] = new Provider($data);

		}

		$query->closeCursor();

		return $providers;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS providersNumber FROM t_provider');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['providersNumber'];
	}

	/**
	 * @return mixed
	 */
	public function getLastId() {
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_provider ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data['last_id'] ?? 0;
	}
}
