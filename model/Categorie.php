<?php
class Categorie{

	//attributes
	private $_id;
	private $_nomAR;
	private $_nomFR;
	private $_longueur;
	private $_largeur;
	private $_hauteur;
	private $_diametre;
	private $_forme;
	private $_couleur;
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
	public function setNomAR($nomAR){
		$this->_nomAR = $nomAR;
   	}

	public function setNomFR($nomFR){
		$this->_nomFR = $nomFR;
   	}

	public function setLongueur($longueur){
		$this->_longueur = $longueur;
   	}

	public function setLargeur($largeur){
		$this->_largeur = $largeur;
   	}

	public function setHauteur($hauteur){
		$this->_hauteur = $hauteur;
   	}

	public function setDiametre($diametre){
		$this->_diametre = $diametre;
   	}

	public function setForme($forme){
		$this->_forme = $forme;
   	}

	public function setCouleur($couleur){
		$this->_couleur = $couleur;
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
	public function nomAR(){
		return $this->_nomAR;
   	}

	public function nomFR(){
		return $this->_nomFR;
   	}

	public function longueur(){
		return $this->_longueur;
   	}

	public function largeur(){
		return $this->_largeur;
   	}

	public function hauteur(){
		return $this->_hauteur;
   	}

	public function diametre(){
		return $this->_diametre;
   	}

	public function forme(){
		return $this->_forme;
   	}

	public function couleur(){
		return $this->_couleur;
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