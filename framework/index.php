<?php
	require_once("includes/FrameworkUtility.php");
	require_once("includes/UrlMapper.php");
	
	ControllerLoader::loadControllers();
	
	$requestUri = $_SERVER['REQUEST_URI'];
	$queryString = $_SERVER['QUERY_STRING'];
	
	$action = FrameworkUtility::getAction($requestUri);
	$queryStringArray = FrameworkUtility::parseQueryString($queryString);
	
	$controller = "";
	if(isset($action)){
		$urlMapper = new UrlMapper();
		$controller = $urlMapper->getController($action, $queryStringArray);
	}
	else{
		//Page not found
	}
	
	$objName = lcfirst($controller);
	$objName = new $controller();
	$objName->begin();
	
?>