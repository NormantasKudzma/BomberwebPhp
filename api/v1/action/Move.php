<?php
	include_once('../resourcebase.php');
	$resource = "Move";
	
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = $resource;
			$response['pid'] = 'playerid';
			$response['x'] = 'xpos';
			$response['y'] = 'ypos';
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
					$q = "UPDATE ". PLAYERS ." SET ". PLAYERS .".x='{$json['x']}',". PLAYERS .".y='{$json['y']}' WHERE ". PLAYERS .".id='{$json['pid']}'";
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