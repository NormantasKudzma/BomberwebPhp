<?php
	include_once('../resourcebase.php');
	$resource = "Bomb";
	
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = $resource;
			$response['gameRoom'] = 'id';
			$response['pid'] = 'playerid';
			$response['x'] = 'xpos';
			$response['y'] = 'ypos';
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
					$q = "INSERT INTO " . BOMBS . "(id, pid, x, y) VALUES ('{$json['gameRoom']}', '{$json['pid']}', '{$json['x']}', '{$json['y']}')";
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