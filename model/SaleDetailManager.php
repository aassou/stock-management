<?php

/**
 * Class SaleDetailManager
 */
class SaleDetailManager {

	/**
	 * @var PDO
	 */
	private $_db;

	/**
	 * SaleDetailManager constructor.
	 * @param $db
	 */
	public function __construct($db) {
    	$this->_db = $db;
	}

	/**
	 * @param SaleDetail SaleDetail
	 */
	public function add(SaleDetail $SaleDetail) {
    	$query = $this->_db->prepare('INSERT INTO t_saledetail (
		productId, quantity, price, description, codeSale, created, createdBy)
		VALUES (:productId, :quantity, :price, :description, :codeSale, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':productId', $SaleDetail->getProductId());
		$query->bindValue(':quantity', $SaleDetail->getQuantity());
		$query->bindValue(':price', $SaleDetail->getPrice());
		$query->bindValue(':description', $SaleDetail->getDescription());
        $query->bindValue(':codeSale', $SaleDetail->getCodeSale());
		$query->bindValue(':created', $SaleDetail->getCreated());
		$query->bindValue(':createdBy', $SaleDetail->getCreatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param SaleDetail SaleDetail
	 */
	public function update(SaleDetail $SaleDetail) {
    	$query = $this->_db->prepare('UPDATE t_saledetail SET 
		productId=:productId, quantity=:quantity, price=:price, description=:description, updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $SaleDetail->getId());
		$query->bindValue(':productId', $SaleDetail->getProductId());
		$query->bindValue(':quantity', $SaleDetail->getQuantity());
		$query->bindValue(':price', $SaleDetail->getPrice());
		$query->bindValue(':description', $SaleDetail->getDescription());
		$query->bindValue(':updated', $SaleDetail->getUpdated());
		$query->bindValue(':updatedBy', $SaleDetail->getUpdatedBy());
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 */
	public function delete($id) {
		$query = $this->_db->prepare('DELETE FROM t_saledetail WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	/**
	 * @param $id
	 * @return SaleDetail
	 */
	public function getOneById($id) {
    	$query = $this->_db->prepare('SELECT * FROM t_saledetail WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();

		return new SaleDetail($data);
	}

    /**
     * @param $codeSale
     * @return array
     */
    public function getAllByCode($codeSale) {
        $salesDetails = [];
        $query = $this->_db->prepare('SELECT * FROM t_saledetail WHERE codeSale=:codeSale')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':codeSale', $codeSale);
        $query->execute();

        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $salesDetails[] = new SaleDetail($data);
        }

        $query->closeCursor();

        return $salesDetails;
    }

	/**
	 * @return array
	 */
	public function getAll() {
        $SaleDetails = array();
		$query = $this->_db->query('SELECT * FROM t_saledetail ORDER BY id ASC');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$SaleDetails[] = new SaleDetail($data);
		}

		$query->closeCursor();

		return $SaleDetails;
	}

	/**
	 * @param $begin
	 * @param $end
	 * @return array
	 */
	public function getAllByLimits($begin, $end) {
    	$SaleDetails = array();
		$query = $this->_db->query('SELECT * FROM t_saledetail ORDER BY id DESC LIMIT $begin, $end');

		while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
			$SaleDetails[] = new SaleDetail($data);

		}

		$query->closeCursor();

		return $SaleDetails;
	}

	/**
	 * @return mixed
	 */
	public function getAllNumber() {
    	$query = $this->_db->query('SELECT COUNT(*) AS SaleDetailsNumber FROM t_saledetail');
    	$data = $query->fetch(PDO::FETCH_ASSOC);
    
		return $data['SaleDetailsNumber'];
	}

	/**
	 * @return mixed
	 */
	public function getLastId() {
    	$query = $this->_db->query(' SELECT id AS last_id FROM t_saledetail ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data['last_id'] ?? 0;
	}

    /**
     * @param $codeSale
     * @return mixed
     */
    public function getTotalAmountByCode($codeSale) {
        $query = $this->_db->prepare("
            SELECT SUM(price * quantity) AS totalAmountPurchases 
            FROM t_saledetail
            WHERE codeSale=:codeSale
        ");
        $query->bindValue(':codeSale', $codeSale);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data["totalAmountPurchases"];
    }
}
