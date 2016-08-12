<?php
class ClientManager{

	//attributes
	private $_db;

	//le constructeur
    public function __construct($db){
        $this->_db = $db;
    }

	//BAISC CRUD OPERATIONS
	public function add(Client $client){
    	$query = $this->_db->prepare(' INSERT INTO t_client (
		code, matricule, nom, cin, ville, telephone, created, createdBy)
		VALUES (:code, :matricule, :nom, :cin, :ville, :telephone, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':code', $client->code());
		$query->bindValue(':matricule', $client->matricule());
		$query->bindValue(':nom', $client->nom());
		$query->bindValue(':cin', $client->cin());
		$query->bindValue(':ville', $client->ville());
		$query->bindValue(':telephone', $client->telephone());
		$query->bindValue(':created', $client->created());
		$query->bindValue(':createdBy', $client->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Client $client){
    	$query = $this->_db->prepare(' UPDATE t_client SET 
		code=:code, matricule=:matricule, nom=:nom, cin=:cin, ville=:ville, telephone=:telephone, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $client->id());
		$query->bindValue(':code', $client->code());
		$query->bindValue(':matricule', $client->matricule());
		$query->bindValue(':nom', $client->nom());
		$query->bindValue(':cin', $client->cin());
		$query->bindValue(':ville', $client->ville());
		$query->bindValue(':telephone', $client->telephone());
		$query->bindValue(':updated', $client->updated());
		$query->bindValue(':updatedBy', $client->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
    	$query = $this->_db->prepare(' DELETE FROM t_client
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getClientById($id){
    	$query = $this->_db->prepare(' SELECT * FROM t_client
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Client($data);
	}

	public function getClients(){
		$clients = array();
		$query = $this->_db->query('SELECT * FROM t_client
		ORDER BY id DESC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$clients[] = new Client($data);
		}
		$query->closeCursor();
		return $clients;
	}

	public function getClientsByLimits($begin, $end){
		$clients = array();
		$query = $this->_db->query('SELECT * FROM t_client
		ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$clients[] = new Client($data);
		}
		$query->closeCursor();
		return $clients;
	}

	public function getLastId(){
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_client
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

    public function getClientsNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS clientsNumber FROM t_client');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['clientsNumber'];
    }

}