<?php
class FactureDetails{

	//attributes
	private $_id;
	private $_designation;
	private $_quantite;
	private $_prixUnitaire;
	private $_idFacture;
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
	public function setDesignation($designation){
		$this->_designation = $designation;
   	}

	public function setQuantite($quantite){
		$this->_quantite = $quantite;
   	}

	public function setPrixUnitaire($prixUnitaire){
		$this->_prixUnitaire = $prixUnitaire;
   	}

	public function setIdFacture($idFacture){
		$this->_idFacture = $idFacture;
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
	public function designation(){
		return $this->_designation;
   	}

	public function quantite(){
		return $this->_quantite;
   	}

	public function prixUnitaire(){
		return $this->_prixUnitaire;
   	}

	public function idFacture(){
		return $this->_idFacture;
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