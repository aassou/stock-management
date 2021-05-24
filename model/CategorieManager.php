<?php
class CategorieManager{

	//attributes
	private $_db;

	//le constructeur
    public function __construct($db){
        $this->_db = $db;
    }

	//BAISC CRUD OPERATIONS
	public function add(Categorie $categorie){
    	$query = $this->_db->prepare(' INSERT INTO t_categorie (
		nomAR, nomFR, longueur, largeur, hauteur, diametre, forme, couleur, created, createdBy)
		VALUES (:nomAR, :nomFR, :longueur, :largeur, :hauteur, :diametre, :forme, :couleur, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':nomAR', $categorie->nomAR());
		$query->bindValue(':nomFR', $categorie->nomFR());
		$query->bindValue(':longueur', $categorie->longueur());
		$query->bindValue(':largeur', $categorie->largeur());
		$query->bindValue(':hauteur', $categorie->hauteur());
		$query->bindValue(':diametre', $categorie->diametre());
		$query->bindValue(':forme', $categorie->forme());
		$query->bindValue(':couleur', $categorie->couleur());
		$query->bindValue(':created', $categorie->created());
		$query->bindValue(':createdBy', $categorie->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Categorie $categorie){
    	$query = $this->_db->prepare(' UPDATE t_categorie SET 
		nomAR=:nomAR, nomFR=:nomFR, longueur=:longueur, largeur=:largeur, hauteur=:hauteur, diametre=:diametre, forme=:forme, couleur=:couleur, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $categorie->id());
		$query->bindValue(':nomAR', $categorie->nomAR());
		$query->bindValue(':nomFR', $categorie->nomFR());
		$query->bindValue(':longueur', $categorie->longueur());
		$query->bindValue(':largeur', $categorie->largeur());
		$query->bindValue(':hauteur', $categorie->hauteur());
		$query->bindValue(':diametre', $categorie->diametre());
		$query->bindValue(':forme', $categorie->forme());
		$query->bindValue(':couleur', $categorie->couleur());
		$query->bindValue(':updated', $categorie->updated());
		$query->bindValue(':updatedBy', $categorie->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
    	$query = $this->_db->prepare(' DELETE FROM t_categorie
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getCategorieById($id){
    	$query = $this->_db->prepare(' SELECT * FROM t_categorie
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Categorie($data);
	}

	public function getCategories(){
		$categories = array();
		$query = $this->_db->query('SELECT * FROM t_categorie
		ORDER BY nomFR ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$categories[] = new Categorie($data);
		}
		$query->closeCursor();
		return $categories;
	}

	public function getCategoriesByLimits($begin, $end){
		$categories = array();
		$query = $this->_db->query('SELECT * FROM t_categorie
		ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$categories[] = new Categorie($data);
		}
		$query->closeCursor();
		return $categories;
	}

	public function getLastId(){
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_categorie
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}
    
    public function getCategoriesNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS categoriesNumber FROM t_categorie');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $categoriesNumber = $data['categoriesNumber'];
        return $categoriesNumber;
    }

}