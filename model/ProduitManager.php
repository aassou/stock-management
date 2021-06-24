<?php
class ProduitManager{

	//attributes
	private $_db;

	//le constructeur
    public function __construct($db){
        $this->_db = $db;
    }

	//BAISC CRUD OPERATIONS
	public function add(Produit $produit){
    	$query = $this->_db->prepare('INSERT INTO t_produit (
		prixAchat, prixVente, prixVenteMin, quantite, code, idCategorie, created, createdBy)
		VALUES (:prixAchat, :prixVente, :prixVenteMin, :quantite, :code, :idCategorie, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':prixAchat', $produit->prixAchat());
		$query->bindValue(':prixVente', $produit->prixVente());
		$query->bindValue(':prixVenteMin', $produit->prixVenteMin());
		$query->bindValue(':quantite', $produit->quantite());
		$query->bindValue(':code', $produit->code());
		$query->bindValue(':idCategorie', $produit->idCategorie());
		$query->bindValue(':created', $produit->created());
		$query->bindValue(':createdBy', $produit->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Produit $produit){
    	$query = $this->_db->prepare(' UPDATE t_produit SET 
		prixAchat=:prixAchat, prixVente=:prixVente, prixVenteMin=:prixVenteMin, quantite=:quantite, code=:code, idCategorie=:idCategorie, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $produit->id());
		$query->bindValue(':prixAchat', $produit->prixAchat());
		$query->bindValue(':prixVente', $produit->prixVente());
		$query->bindValue(':prixVenteMin', $produit->prixVenteMin());
		$query->bindValue(':quantite', $produit->quantite());
		$query->bindValue(':code', $produit->code());
		$query->bindValue(':idCategorie', $produit->idCategorie());
		$query->bindValue(':updated', $produit->updated());
		$query->bindValue(':updatedBy', $produit->updatedBy());
		$query->execute();
		$query->closeCursor();
	}

    public function updateQuantite($idProduit, $quantite){
        $query = $this->_db->prepare(
        'UPDATE t_produit SET 
        quantite=:quantite, updated=:updated, updatedBy=:updatedBy
        WHERE id=:id')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $idProduit);
        $query->bindValue(':quantite', $quantite);
        $query->bindValue(':updated', date('Y-m-d h:i:s'));
        $query->bindValue(':updatedBy', $_SESSION['userstock']->login());
        $query->execute();
        $query->closeCursor();
    }

	public function delete($id){
    	$query = $this->_db->prepare(
    	'DELETE FROM t_produit
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}
    
    public function deleteByIdCategorie($idCategorie){
        $query = $this->_db->prepare('DELETE FROM t_produit
        WHERE idCategorie=:idCategorie')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':idCategorie', $idCategorie);
        $query->execute();
        $query->closeCursor();
    }

	public function getProduitById($id){
    	$query = $this->_db->prepare(' SELECT * FROM t_produit
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Produit($data);
	}
    
    public function getProduitNumberById($id){
        $query = $this->_db->prepare(
        'SELECT COUNT(*) AS nombreProduit FROM t_produit
        WHERE id=:id')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $id);
        $query->execute();      
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['nombreProduit'];
    }

    /**
     * @return array
     */
	public function getProduits(){
		$produits = [];
		$query = $this->_db->query('SELECT * FROM t_produit');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$produits[] = new Produit($data);
		}

		$query->closeCursor();

		return $produits;
	}
    
    public function getProduitsByIdCategorie($idCategorie){
        $produits = array();
        $query = $this->_db->prepare(
        'SELECT * FROM t_produit
        WHERE idCategorie=:idCategorie
        ORDER BY code');
        $query->bindValue(':idCategorie', $idCategorie);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $produits[] = new Produit($data);
        }

        $query->closeCursor();

        return $produits;
    }

	public function getProduitsByLimits($begin, $end){
		$produits = array();
		$query = $this->_db->query('SELECT * FROM t_produit
		ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$produits[] = new Produit($data);
		}
		$query->closeCursor();
		return $produits;
	}

	public function getLastId(){
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_produit
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

    /**
     * @param $productId
     * @param $quantity
     */
	public function updateProductQuantity($productId, $quantity) {
	    $query = $this->_db->prepare('UPDATE t_produit SET quantite = quantite + :quantity
            WHERE id = :productId
        ');
	    $query->bindValue(':productId', $productId);
	    $query->bindValue(':quantity', $quantity);
	    $query->execute();
	    $query->closeCursor();
    }

    /**
     * @return array
     */
    public function getMinimumStockProducts() {
	    $products = [];
        $query = $this->_db->query('SELECT * FROM t_produit WHERE quantite <= 10');

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $products [] = new Produit($data);
        }

        return $products;
    }

}