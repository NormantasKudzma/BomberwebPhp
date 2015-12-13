<?php
	include_once('../resourcebase.php');
	$resource = "CreateRoom";
	
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = $resource;
			$response['gameRoom'] = 'id';
			$response['name'] = 'name';
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
					$q = "INSERT INTO ". GAMEROOMS ."(id,state,name) VALUES ('{$json['gameRoom']}', 'READY', '{$json['gameRoom']}')";
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