<?php

require_once("../framework/config.php");

class XMLParser{
		
	private static $FILE = CONFIG;
	
	public static function parseConfigFile(){
		
		$xml = simplexml_load_file(self::$FILE);
		$mapping = array(); 
		
		$i = 0;
		
		$actions = $xml->action;
		
		foreach($actions as $action){
			$attributes = $action->attributes();
			//we append "" to implictly convert the return value of $attributes["value"] into a string
			//Doing this fixed the problem of Illegal offset type error while setting the array at the end of foreach loop
			$value = $attributes["value"] . "";   
			$controller =  $action->controller . "";
			$sView = $action->successView . "";
			$fView = $action->failureView . "";
			
			$cAndV = array();
			$cAndV["controller"] = $controller;
			$cAndV["sView"] = $sView;
			$cAndV["fView"] = $fView;
			$val = $value;
			$mapping[$val] = $cAndV;
		}
		return $mapping;
		
	}
	
	public static function getMappings(){
		$doc = new DOMDocument();
		//xml file to be parsed
		$doc->load(self::$FILE);
		//get all tags with tag name as 'action'
		$actions = $doc->getElementsByTagName("action");
		
		//for each action retrieved from xml file
		foreach($actions as $action){	
			//get the action name
			$value = $action->getAttribute("value");
			//get the controller name

			
			$controller = $action->childNodes->item(1)->nodeValue;
			//get the success view name
			$successView = $action->childNodes->item(2)->nodeValue;
			//get the failure view name
			$FailureView = $action->childNodes->item(3)->nodeValue;
			
			$cAndv = array();
			if(!array_key_exists($value,self::$ACTION_CONTROLLER_VIEW_MAP)){
				//add controller, success view and failure view info into an single array
				$cAndv["controller"] = $controller;
				$cAndv["sView"] = $successView;
				$cAndv["fView"] = $FailureView; 
				//set the array to corresponding view
				self::$ACTION_CONTROLLER_VIEW_MAP[$value] = $cAndv;
			}			
		}
		return self::$ACTION_CONTROLLER_VIEW_MAP;
	}	
	
}

?>