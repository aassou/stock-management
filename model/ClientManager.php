<?php

/**
 * Class ClientManager
 */
class ClientManager {

	/**
	 * @var PDO
	 */
	private $_db;

	/**
	 * ClientManager constructor.
	 * @param $db
	 */
	public function __construct($db) {
    	$this->_db = $db;
	}

	/**
	 * @param Client client
	 */
	public function add(Client $client) {
    	$query = $this->_db->prepare('INSERT INTO t_client (
		name, address, phone, created, createdBy)
		VALUES (:name, :address, :phone, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':name', $client->getName());
		$query->bindValue(':address', $client->getAddress());
		$query->bindValue(':phone', $client->getPhone());
		$query->bindValue(':created', $client->getCreated());
		$query->bindValue(':createdBy', $client->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param Client client
	 */
	public function update(Client $client) {
    	$query = $this->_db->prepare('UPDATE t_client SET 
		name=:name, address=:address, phone=:phone, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $client->getId());
		$query->bindValue(':name', $client->getName());
		$query->bindValue(':address', $client->getAddress());
		$query->bindValue(':phone', $client->getPhone());
		$query->bindValue(':updated', $client->getUpdated());
		$query->bindValue(':updatedBy', $client->getUpdatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$query = $this->_db->prepare('DELETE FROM t_client WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 * @return Client
	 */
	public function getOneById($id) {
    	$query = $this->_db->prepare('SELECT * FROM t_client WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();

		return new Client($data);
	}

	/**
	 * @return array
	 */
	public function getAll() {
		$clients = array();
		$query = $this->_db->query('SELECT * FROM t_client ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$clients[] = new Client($data);
		}

		$query->closeCursor();

		return $clients;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$clients = array();
		$query = $this->_db->query('SELECT * FROM t_client ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$clients[] = new Client($data);

		}

		$query->closeCursor();

		return $clients;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS clientsNumber FROM t_client');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['clientsNumber'];
	}

	/**
	 * @return mixed
	 */
	public function getLastId() {
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_client ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data['last_id'] ?? 0;
	}

    /**
     * @return mixed
     */
    public function getNumberWeek(){
        $query = $this->_db->query("
            SELECT COUNT(*) AS numberWeek 
            FROM t_client
            WHERE created BETWEEN SUBDATE(CURDATE(),7) AND CURDATE()
        ");

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $data['numberWeek'];
    }
}
