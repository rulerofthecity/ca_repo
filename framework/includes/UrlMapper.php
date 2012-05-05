<?php
	require_once("XMLParser.php");
	require_once("ControllerLoader.php");

	class UrlMapper{
		
		private $urlMap = array();
		
		public function __construct(){
			$this->urlMap = ControllerLoader::getURLMAP();
			if(isset($this->urlMap)){
			}
		}
		
		public function getController($action){
			$controller = "";
			if($this->mappingExist($action)){
				$controllerMap = $this->urlMap[$action];
				$controller = $controllerMap["controller"]; 
			}
			else{
				die("Page not found");
				
			}
			return $controller;
		}
		
		private function mappingExist($action) {
		  // We don't care about the value, we just want to know if the key exists
		  // Will return true or false
		  return array_key_exists($action, $this->urlMap);
		}		
		
	}	

?>