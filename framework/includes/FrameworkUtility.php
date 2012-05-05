<?php

class FrameworkUtility{
	
	public static function redirect($location = NULL){
		if($location != NULL){
			header("Location: $location");
		}
		exit;
	}
	
	public static function getAction($requestUri){
		if(!empty($requestUri)){
			$requestUriArray = explode("?",$requestUri);
			$requestUriArray = explode("/", $requestUriArray[0]);
			$uri = array_pop($requestUriArray);
			return $uri;
		}
		else{
			return "";
		}
	}
	
	function parseQueryString($query_string) {
		$op = array();
		if(!empty($query_string)){
			$pairs = explode("&", $query_string);
			foreach ($pairs as $pair) {
				list($k, $v) = array_map("urldecode", explode("=", $pair));
				$op[$k] = $v;
			}
			return $op;
		}
		else{
			return "";
		}
	}
	
}

?>