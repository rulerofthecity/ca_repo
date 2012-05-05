<?php
class Controller3{

	public function __construct(){
	}
	public function begin(){
		echo "Inside begin function of " . basename(__FILE__);
	}


}

$controller3 = new Controller3();
?>