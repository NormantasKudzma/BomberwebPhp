<?php
	include_once('../resourcebase.php');
	$resource = "GameState";
	
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = $resource;
			$response['gameRoom'] = 'id';
			$response["response"] = "success";
			http_response_code(200);
			break;
		}
		case 'POST':{
			if (checkHeaders() === true){
				$json = readBody();
				if (!isset($json['action']) or $json['action'] !== $resource) {
					$response["response"] = "failure";
					http_response_code(400);
				}
				else {
					$q = "SELECT ". GAMEROOMS .".state FROM ". GAMEROOMS ." WHERE ". GAMEROOMS .".id='{$json['gameRoom']}'";
					$result = queryDB($q);
					if ($result != null && $result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$response["state"] = $row["state"];
					}
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
		case 'PUT':{
			$response["response"] = "failure";
			http_response_code(403);
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