<?php

/**
 * Class PurchaseDetailManager
 */
class PurchaseDetailManager {

	/**
	 * @var PDO
	 */
	private $_db;

	/**
	 * PurchaseDetailManager constructor.
	 * @param $db
	 */
	public function __construct($db) {
    	$this->_db = $db;
	}

	/**
	 * @param PurchaseDetail purchaseDetail
	 */
	public function add(PurchaseDetail $purchaseDetail) {
    	$query = $this->_db->prepare('INSERT INTO t_purchasedetail (
		productId, quantity, price, description, codePurchase, created, createdBy)
		VALUES (:productId, :quantity, :price, :description, :codePurchase, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':productId', $purchaseDetail->getProductId());
		$query->bindValue(':quantity', $purchaseDetail->getQuantity());
		$query->bindValue(':price', $purchaseDetail->getPrice());
		$query->bindValue(':description', $purchaseDetail->getDescription());
		$query->bindValue(':codePurchase', $purchaseDetail->getCodePurchase());
		$query->bindValue(':created', $purchaseDetail->getCreated());
		$query->bindValue(':createdBy', $purchaseDetail->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param PurchaseDetail purchaseDetail
	 */
	public function update(PurchaseDetail $purchaseDetail) {
    	$query = $this->_db->prepare('UPDATE t_purchasedetail SET 
		productId=:productId, quantity=:quantity, price=:price, description=:description, codePurchase=:codePurchase, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $purchaseDetail->getId());
		$query->bindValue(':productId', $purchaseDetail->getProductId());
		$query->bindValue(':quantity', $purchaseDetail->getQuantity());
		$query->bindValue(':price', $purchaseDetail->getPrice());
		$query->bindValue(':description', $purchaseDetail->getDescription());
		$query->bindValue(':codePurchase', $purchaseDetail->getCodePurchase());
		$query->bindValue(':updated', $purchaseDetail->getUpdated());
		$query->bindValue(':updatedBy', $purchaseDetail->getUpdatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$query = $this->_db->prepare('DELETE FROM t_purchasedetail WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 * @return PurchaseDetail
	 */
	public function getOneById($id) {
    	$query = $this->_db->prepare('SELECT * FROM t_purchasedetail WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();

		return new PurchaseDetail($data);
	}

    /**
     * @param $codePurchase
     * @return array
     */
    public function getAllByCode($codePurchase) {
        $puchaseDetails = [];
        $query = $this->_db->prepare('SELECT * FROM t_purchasedetail WHERE codePurchase=:codePurchase')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':codePurchase', $codePurchase);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $puchaseDetails[] = new PurchaseDetail($data);
        }

        $query->closeCursor();

        return $puchaseDetails;
    }

	/**
	 * @return array
	 */
	public function getAll() {
		$purchaseDetails = array();
		$query = $this->_db->query('SELECT * FROM t_purchasedetail ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$purchaseDetails[] = new PurchaseDetail($data);
		}

		$query->closeCursor();

		return $purchaseDetails;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$purchaseDetails = array();
		$query = $this->_db->query('SELECT * FROM t_purchasedetail ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$purchaseDetails[] = new PurchaseDetail($data);

		}

		$query->closeCursor();

		return $purchaseDetails;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS purchaseDetailsNumber FROM t_purchasedetail');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['purchaseDetailsNumber'];
	}

	/**
	 * @return mixed
	 */
	public function getLastId() {
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_purchasedetail ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data['last_id'] ?? 0;
	}

    /**
     * @return mixed
     */
	public function getTotalAmount() {
        $query = $this->_db->query("
            SELECT SUM(price * quantity) AS totalAmountPurchases 
            FROM t_purchasedetail
        ");

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data["totalAmountPurchases"];
    }

    /**
     * @param $codePurchase
     * @return mixed
     */
    public function getTotalAmountByCode($codePurchase) {
        $query = $this->_db->prepare("
            SELECT SUM(price * quantity) AS totalAmountPurchases 
            FROM t_purchasedetail
            WHERE codePurchase=:codePurchase
        ");
        $query->bindValue(':codePurchase', $codePurchase);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data["totalAmountPurchases"];
    }
}
