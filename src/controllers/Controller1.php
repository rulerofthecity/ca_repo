<?php
	class Controller1{
		
		public function __construct(){
		}
		public function begin(){
			echo "Inside begin function of " . basename(__FILE__);
		}
		
		
	}

	$controller1 = new Controller1();
?>