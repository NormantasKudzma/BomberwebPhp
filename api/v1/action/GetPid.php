<?php
	include_once('../resourcebase.php');
	$resource = "GetPid";
	
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = $resource;
			$response["response"] = "success";
			http_response_code(200);
			break;
		}
		case 'POST':{
			if (checkHeaders() === true){
				$json = readBody();
				if (!isset($json['action']) or $json['action'] !== $resource) {
					$response["response"] = "failure1";
					http_response_code(400);
				}
				else {
					$pid = rand(1, 214748364);
					// HARDCODED PID FOR TESTING!!!
					//$pid = 666666;
					$q = "INSERT INTO " . PLAYERS . "(id, gameroom, x, y) VALUES ('$pid', '1', '1', '1')";
					queryDB($q);
					$response["pid"] = $pid;
					$response["response"] = "success";
					http_response_code(200);
				}
			}
			else {
				$response["response"] = "failure2";
				http_response_code(400);
			}
			break;
		}
		case 'PUT':{
			$response["response"] = "failure3";
			http_response_code(403);
			break;
		}
		default:{
			$response["response"] = "failure4";
			http_response_code(403);
			break;
		}
	}
	
	sendResponse();
?>