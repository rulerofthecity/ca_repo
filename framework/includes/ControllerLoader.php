<?php 
	
	require_once("../framework/config.php");

	class ControllerLoader{
		private static $CONTROLLER_DIR = CONTROLLER_DIR;
		private static $URL_MAP = array();
		
		public static function loadControllers(){
			
			self::$URL_MAP = XMLParser::parseConfigFile();
			if(isset(self::$URL_MAP)){
				
				$rootControllerDir = self::$CONTROLLER_DIR;
				$currentDir = $rootControllerDir;
				self::goToRootDir();
				self::goToControllerDir();
				foreach(array_values(self::$URL_MAP) as $configArr){
					$controller = $configArr["controller"];
					self::accessDirs($currentDir,$controller);
				}
				
				self::goToRootDir();
				self::goToFrameworkDir();
			}
		}
		
		private static function goToRootDir(){
			//echo SITE_ROOT;
			while(getcwd() != SITE_ROOT){
				chdir("..");
			}
		}
		
		private static function goToControllerDir(){
			chdir("src");
			chdir("controllers");
		}
		private static function goToFrameworkDir(){
			chdir("framework");
		}
		
		private static function accessDirs($currentDir, $controller){
			if($handle = opendir($currentDir)){
				
				while($filename = readdir($handle)){
					
					if( !($filename == ".") && !($filename == "..") ){
						if(is_dir($filename)){
							chdir($filename);
							$currentDir .= DS. $filename;
							self::accessDirs($currentDir, $controller);
							chdir("..");
						}
						else{
							if($filename == $controller.".php" ){
								$controllerFullName = getcwd() . DS . $filename;
								require_once($controllerFullName);
							}
						}	
					}
				}
			}
		}
		
		public static function getURLMAP(){
			return self::$URL_MAP;
		}
	}

?>