<?php
class FactureDetailsManager{

	//attributes
	private $_db;

	//le constructeur
    public function __construct($db){
        $this->_db = $db;
    }

	//BAISC CRUD OPERATIONS
	public function add(FactureDetails $factureDetails){
    	$query = $this->_db->prepare(
    	'INSERT INTO t_facturedetails (
		designation, quantite, prixUnitaire, idFacture, idProduit, created, createdBy)
		VALUES (:designation, :quantite, :prixUnitaire, :idFacture, :idProduit, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':designation', $factureDetails->designation());
		$query->bindValue(':quantite', $factureDetails->quantite());
		$query->bindValue(':prixUnitaire', $factureDetails->prixUnitaire());
		$query->bindValue(':idFacture', $factureDetails->idFacture());
        $query->bindValue(':idProduit', $factureDetails->idProduit());
		$query->bindValue(':created', $factureDetails->created());
		$query->bindValue(':createdBy', $factureDetails->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(FactureDetails $factureDetails){
    	$query = $this->_db->prepare(' UPDATE t_facturedetails SET 
		quantite=:quantite, prixUnitaire=:prixUnitaire, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $factureDetails->id());
		$query->bindValue(':quantite', $factureDetails->quantite());
		$query->bindValue(':prixUnitaire', $factureDetails->prixUnitaire());
		$query->bindValue(':updated', $factureDetails->updated());
		$query->bindValue(':updatedBy', $factureDetails->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
    	$query = $this->_db->prepare(' DELETE FROM t_facturedetails
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}
    
    public function deleteFacture($idFacture){
        $query = $this->_db->prepare('DELETE FROM t_facturedetails WHERE idFacture=:idFacture')
        or die(print_r($this->_db->errorInfo()));;
        $query->bindValue(':idFacture', $idFacture);
        $query->execute();
        $query->closeCursor();
    }

	public function getFactureDetailsById($id){
    	$query = $this->_db->prepare(' SELECT * FROM t_facturedetails
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new FactureDetails($data);
	}

	public function getFactureDetails(){
		$factureDetailss = array();
		$query = $this->_db->query('SELECT * FROM t_facturedetails
		ORDER BY id DESC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$factureDetailss[] = new FactureDetails($data);
		}
		$query->closeCursor();
		return $factureDetailss;
	}

	public function getFactureDetailsByLimits($begin, $end){
		$factureDetailss = array();
		$query = $this->_db->query('SELECT * FROM t_facturedetails
		ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$factureDetailss[] = new FactureDetails($data);
		}
		$query->closeCursor();
		return $factureDetailss;
	}

	public function getLastId(){
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_facturedetails
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}
    
    // New Methods
    
    public function getNombreArticleFactureByIdFacture($idFacture){
        $query = $this->_db->prepare('SELECT COUNT(*) AS nombreArticle FROM t_facturedetails 
        WHERE idFacture=:idFacture')
        or die(print_r($this->_db->errorInfo()));;
        $query->bindValue(':idFacture', $idFacture);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['nombreArticle'];
    }
    
    public function getTotalFactureByIdFacture($idFacture){
        $query = $this->_db->prepare('SELECT SUM(prixUnitaire*quantite) AS totalFacture FROM t_facturedetails 
        WHERE idFacture=:idFacture')
        or die(print_r($this->_db->errorInfo()));;
        $query->bindValue(':idFacture', $idFacture);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['totalFacture'];
    }
    
    public function getFacturesDetailByIdFacture($idFacture){
        $facturesDetails = array();
        $query = $this->_db->prepare('SELECT * FROM t_facturedetails WHERE idFacture=:idFacture
        ORDER BY id DESC');
        $query->bindValue(':idFacture', $idFacture);
        $query->execute();
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $facturesDetails[] = new FactureDetails($data);
        }
        $query->closeCursor();
        return $facturesDetails;
    }

}