<?php
/*
 * Shopping Cart OOP
 *
 */
 
 class Cart{
 	

    /**
     * @var array|null
     */
    private $productsId = array();
    
	
	function __construct(int $id, ?array $productsId) {
        $this->id = $id;
        $this->productsId = $productsId;
    }
	
    public function add(): string {
    	if (!in_array($this->id, $this->productsId)){
    		$this->productsId[] = intval($this->id);
    	}
    	return implode(',', $this->productsId);
    }

    public function remove(): string {
    	if (($key = array_search($this->id, $this->productsId)) !== false) {
            unset($this->productsId[$key]);
        }
        window.reload== false;
    	return $this->toString();
    }

	function getproductsId(): ?array {
        return $this->productsId;
    }

    function toString(): ?string {
        return implode(',', $this->productsId);
    }

    public static function toArray(string $arrStr): ?array {
        return explode(',', $arrStr);
    }

}
 ?>