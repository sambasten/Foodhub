<?php
class User{
    /**
     * @var int|null 
     */
    private $id;

    /**
     * @var string 
     */
    private $username;

    /**
     * @var string
     */
    private $password;
    
    /**
     * @var float 
     */
    public $balance;

    function __construct(?int $id, string $username, string $password, float $balance) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->balance = $balance; 
    }
    
    public static function getUserById($id): ?User{
        $conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryUser = ('SELECT  *  FROM user where id = '.$id);
        $result = $dbConnection->query($queryUser);
        while($row  = $result->fetch_assoc()){
            return new User($row['id'], $row['username'], $row['password'], $row['balance']);
        }
        return NULL;
    }

    public static function getUserByUsernameANDPassword($username, $password): ?User{
        $conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryUser = ('SELECT * FROM user where username = "'.$username.'" and password = "'.$password.'"');
        //echo $queryUser; exit;
        $result = $dbConnection->query($queryUser);
        //create array to hold the user data
        while($row  = $result->fetch_assoc()){
            return new User($row['id'], $row['username'], $row['password'], $row['balance']);
        }
        echo NULL;
    }

    public function updateUserBalance(): bool{

        $conn = new dbConn();
        $dbConnection = $conn->getConnection();
        $queryUser =  ('UPDATE user SET balance = '. $this->balance.' WHERE id = ' .$this->id);
        $result = $dbConnection->query($queryUser);
        return $result == true;
    }

    function getId(): ?int {
        return $this->id;
    }

    function getUsername(): string {
        return $this->username;
    }
    
    function getPassword(): string {
        return $this->password;
    }

    function getBalance(): float {
        return $this->balance;
    }

    function setId(int $id): void {
        $this->id = $id;
    }

    function setUsername(string $username): void {
        $this->username = $username;
    }

    function setPassword(string $password): void {
        $this->password = $password;
    }
    
    function setBalance(float $balance): void {
        $this->balance = $balance;
    }

}
?>