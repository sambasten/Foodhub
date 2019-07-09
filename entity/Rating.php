<?php
/*
 * Shopping Rating OOP
 *
 */
 
 class Rating{
 	    /**
     * @var int|null 
     */
    private $id;

    /**
     * @var int 
     */
    private $product_id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var int
     */
    private $rate;    
	
	function __construct(?int $id, int $product_id, int $user_id, int $rate) {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->user_id = $user_id; 
        $this->rate = $rate; 
    }

	public static function getById($id): ?Rating {
		$conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryProd = 'SELECT * FROM rating  where id ='. $id;
        $statement = $dbConnection->query($queryProd);
        while($row = $statement->fetch_assoc()){
            return new Rating($row['id'], $row['product_id'], $row['user_id'], $row['rate']);
        }
        return null;
	}

    public function add(): bool {
        $conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryProd = 'INSERT INTO Rating(product_id, user_id, rate) VALUES ('.$this->product_id.', '.$this->user_id.', '.$this->rate.')';
        return $dbConnection->query($queryProd) ? true: false;
    }

    public static function getByProductId($productId): ?Rating {
        $conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryProd = 'SELECT * FROM rating  where product_id ='. $productId;
        $statement = $dbConnection->query($queryProd);
        while($row = $statement->fetch_assoc()){
            return new Rating($row['id'], $row['product_id'], $row['user_id'], $row['rate']);
        }
        return null;
    }

    public static function getByProductIdAndUserId($productId, $userId): ?Rating {
        $conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryProd = 'SELECT * FROM rating  where product_id ='. $productId.' and  user_id = '.$userId;
        $statement = $dbConnection->query($queryProd);
        while($row = $statement->fetch_assoc()){
            return new Rating($row['id'], $row['product_id'], $row['user_id'], $row['rate']);
        }
        return null;
    }
    

    public static function getAverageRating($productId): ?float{
        $conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryRate = "SELECT AVG(rate) as Avgrate FROM rating WHERE product_id=" .$productId;
        $statement = $dbConnection->query($queryRate);
        while($result = $statement->fetch_assoc()){
            return $result["Avgrate"];
        }
    }
	function getId(): ?int {
        return $this->id;
    }

    function getProduct_id(): int {
        return $this->product_id;
    }
    

    function getUser_id(): int {
        return $this->user_id;
    }

    function getRate(): int {
        return $this->rate;
    }

    function setId(int $id): void {
        $this->id = $id;
    }

    function setProduct_id(int $product_id): void {
        $this->product_id = $product_id;
    }
    
    function setUser_id(int $user_id): void {
        $this->user_id = $user_id;
    }

    function setRate(int $rate): void {
        $this->rate = $rate;
    }

}
 ?>