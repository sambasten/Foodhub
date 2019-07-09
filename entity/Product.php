<?php
/*
 * Shopping Product OOP
 *
 */
 
 class Product{
 	    /**
     * @var int|null 
     */
    private $id;

    /**
     * @var string 
     */
    private $name;

    /**
     * @var float
     */
    private $price;
      /**
     * @var string
     */
    private $imageUrl;


    
	
	function __construct(?int $id, string $imageUrl, string $name, float $price) {
        $this->id = $id;
        $this->image= $imageUrl; 
        $this->name = $name;
        $this->price = $price;
        
    }

	public static function getProducts():?array{
		$arr = array();
		$conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryProd = 'SELECT * FROM products ORDER by id ASC';   
        $statement = $dbConnection->query($queryProd);
        while($row = $statement->fetch_assoc()){
            $arr[] = new Product($row['id'], $row['image'], $row['name'],$row['price']);
        }
        return $arr;
	}

	public static function getById($id): ?Product {
		$conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryProd = 'SELECT * FROM products  where id ='. $id;
        $statement = $dbConnection->query($queryProd);
        while($row = $statement->fetch_assoc()){
            return new Product($row['id'], $row['image'], $row['name'],$row['price']);
        }
        return null;
	}
	
	function getId(): ?int {
        return $this->id;
    }

    function getName(): string {
        return $this->name;
    }
    

    function getPrice(): float {
        return $this->price;
    }
    
    function getImage(): string {
        return $this->image;
    }

    function setId(int $id): void {
        $this->id = $id;
    }

    function setName(string $name): void {
        $this->name = $name;
    }
    
    function setPrice(float $price): void {
        $this->price = $price;
    }

}
 ?>