<?php
	include_once('../resourcebase.php');
	$resource = "GameStart";
	
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = $resource;
			$response["response"] = "success";
			http_response_code(200);
			break;
		}
		case 'POST':{
			$response["response"] = "failure";
			http_response_code(403);
			break;
		}
		case 'PUT':{
			if (checkHeaders() === true){
				$json = readBody();
				if (!isset($json['action']) or $json['action'] !== $resource) {
					$response["response"] = "failure";
					http_response_code(400);
				}
				else {
					$q = "UPDATE ". GAMEROOMS ." SET ". GAMEROOMS .".state='STARTED' WHERE ". GAMEROOMS .".id='{$json['gameRoom']}'";
					queryDB($q);
					$response["response"] = "success";
					http_response_code(200);
				}
			}
			else {
				$response["response"] = "failure";
				http_response_code(400);
			}
			break;
		}
		default:{
			$response["response"] = "failure";
			http_response_code(403);
			break;
		}
	}
	
	sendResponse();
?>