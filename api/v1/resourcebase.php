<?php
	header('Content-type: application/json');
	include_once("constants.php");

	global $response;
	$response = array();
	
	function writeToLog($msg, $arr){
		file_put_contents("log", date("Y-m-d H:i") . " [$msg] " . $arr . PHP_EOL, FILE_APPEND);
	}

	function queryDB($q){
		$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
		
		// Check connection
		if ($conn->connect_error) {
			$conn->close();
			writeToLog("ERROR_DB", "");
			return null;
		}
		$result = $conn->query($q);		
		$conn->close();	
		return $result;
	}
	
	function sendResponse(){
		global $response;
		$encoded = json_encode($response);
		writeToLog("RESPONSE", $encoded);
		echo json_encode($encoded);
	}
	
	function readBody(){
		$body = file_get_contents('php://input');
		$json = json_decode($body, true);
		writeToLog("REQUEST", $body);
		return $json;
	}
	
	function checkHeaders(){
		global $response;
		if (!function_exists('getallheaders')) 
		{ 
			function getallheaders() 
			{ 
				while (@ob_end_flush());
				$headers = ''; 
				foreach ($_SERVER as $name => $value) 
				{ 
					if (substr($name, 0, 5) == 'HTTP_') 
					{ 
						$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
					} 
				} 
				return $headers; 
			} 
		}
	
		foreach (getallheaders() as $name => $value) {
			writeToLog("$name", "$value");
			$response[$name] = $value;
			if (strcasecmp($name, "Content-type") == 0 and strcasecmp($value, "application/json") == 0){
				return true;
			}
		}
		return false;
		//return true;
	}
?>