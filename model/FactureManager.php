<?php
class FactureManager{

	//attributes
	private $_db;

	//le constructeur
    public function __construct($db){
        $this->_db = $db;
    }

	//BAISC CRUD OPERATIONS
	public function add(Facture $facture){
    	$query = $this->_db->prepare(' INSERT INTO t_facture (
		date, idClient, numero, code, created, createdBy)
		VALUES (:date, :idClient, :numero, :code, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':date', $facture->date());
		$query->bindValue(':idClient', $facture->idClient());
		$query->bindValue(':numero', $facture->numero());
        $query->bindValue(':code', $facture->code());
		$query->bindValue(':created', $facture->created());
		$query->bindValue(':createdBy', $facture->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Facture $facture){
    	$query = $this->_db->prepare('UPDATE t_facture SET 
		date=:date, idClient=:idClient, numero=:numero, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $facture->id());
		$query->bindValue(':date', $facture->date());
		$query->bindValue(':idClient', $facture->idClient());
		$query->bindValue(':numero', $facture->numero());
		$query->bindValue(':updated', $facture->updated());
		$query->bindValue(':updatedBy', $facture->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
    	$query = $this->_db->prepare(' DELETE FROM t_facture
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getFactureById($id){
    	$query = $this->_db->prepare(' SELECT * FROM t_facture
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Facture($data);
	}

    public function getFactureByCode($code){
        $query = $this->_db->prepare(
        'SELECT * FROM t_facture
        WHERE code=:code')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':code', $code);
        $query->execute();      
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new Facture($data);
    }

	public function getFactures(){
		$factures = array();
		$query = $this->_db->query('SELECT * FROM t_facture
		ORDER BY id DESC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$factures[] = new Facture($data);
		}
		$query->closeCursor();
		return $factures;
	}

	public function getFacturesByLimits($begin, $end){
		$factures = array();
		$query = $this->_db->query('SELECT * FROM t_facture
		ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$factures[] = new Facture($data);
		}
		$query->closeCursor();
		return $factures;
	}

	public function getLastId(){
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_facture
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}