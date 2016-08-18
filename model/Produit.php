<?php
class Produit{

	//attributes
	private $_id;
	private $_dimension1;
    private $_dimension2;
	private $_diametre;
	private $_forme;
	private $_prixAchat;
	private $_prixVente;
	private $_prixVenteMin;
	private $_quantite;
	private $_poids;
	private $_code;
	private $_idCategorie;
	private $_created;
	private $_createdBy;
	private $_updated;
	private $_updatedBy;

	//le constructeur
    public function __construct($data){
        $this->hydrate($data);
    }
    
    //la focntion hydrate sert à attribuer les valeurs en utilisant les setters d\'une façon dynamique!
    public function hydrate($data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

	//setters
	public function setId($id){
    	$this->_id = $id;
    }
	
	public function setDimension1($dimension1){
		$this->_dimension1 = $dimension1;
   	}
    
    public function setDimension2($dimension2){
        $this->_dimension2 = $dimension2;
    }
    

	public function setDiametre($diametre){
		$this->_diametre = $diametre;
   	}

	public function setForme($forme){
		$this->_forme = $forme;
   	}

	public function setPrixAchat($prixAchat){
		$this->_prixAchat = $prixAchat;
   	}

	public function setPrixVente($prixVente){
		$this->_prixVente = $prixVente;
   	}

	public function setPrixVenteMin($prixVenteMin){
		$this->_prixVenteMin = $prixVenteMin;
   	}

	public function setQuantite($quantite){
		$this->_quantite = $quantite;
   	}

	public function setPoids($poids){
		$this->_poids = $poids;
   	}

	public function setCode($code){
		$this->_code = $code;
   	}

	public function setIdCategorie($idCategorie){
		$this->_idCategorie = $idCategorie;
   	}

	public function setCreated($created){
        $this->_created = $created;
    }

	public function setCreatedBy($createdBy){
        $this->_createdBy = $createdBy;
    }

	public function setUpdated($updated){
        $this->_updated = $updated;
    }

	public function setUpdatedBy($updatedBy){
        $this->_updatedBy = $updatedBy;
    }

	//getters
	public function id(){
    	return $this->_id;
    }
	
	public function dimension1(){
		return $this->_dimension1;
   	}
    
    public function dimension2(){
        return $this->_dimension2;
    }

	public function diametre(){
		return $this->_diametre;
   	}

	public function forme(){
		return $this->_forme;
   	}

	public function prixAchat(){
		return $this->_prixAchat;
   	}

	public function prixVente(){
		return $this->_prixVente;
   	}

	public function prixVenteMin(){
		return $this->_prixVenteMin;
   	}

	public function quantite(){
		return $this->_quantite;
   	}

	public function poids(){
		return $this->_poids;
   	}

	public function code(){
		return $this->_code;
   	}

	public function idCategorie(){
		return $this->_idCategorie;
   	}

	public function created(){
        return $this->_created;
    }

	public function createdBy(){
        return $this->_createdBy;
    }

	public function updated(){
        return $this->_updated;
    }

	public function updatedBy(){
        return $this->_updatedBy;
    }

}