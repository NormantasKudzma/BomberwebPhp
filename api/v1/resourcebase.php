<?php
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
		header('Content-type: application/json');
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
		foreach (getallheaders() as $name => $value) {
			writeToLog("$name", "$value");
			if (strcasecmp($name, "Content-type") == 0 and strcasecmp($value, "application/json") == 0){
				return true;
			}
		}
		return false;
	}
?>