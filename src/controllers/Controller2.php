<?php
class Controller2{

	public function __construct(){
	}
	public function begin(){
		echo "Inside begin function of " . basename(__FILE__);
	}


}

$controller2 = new Controller2();
?>