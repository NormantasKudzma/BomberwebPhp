<?php
	include_once('../resourcebase.php');
	$resource = "UpdateRooms";
	
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
					$response["response"] = "failure";
					http_response_code(400);
				}
				else {
					$q = "SELECT ".GAMEROOMS.".id, ".GAMEROOMS.".name FROM ".GAMEROOMS." WHERE ".GAMEROOMS.".state='READY'";
					$result = queryDB($q);
					if ($result != null && $result->num_rows > 0){
						$i = 0;
						while($row = $result->fetch_assoc()) {
							$response["$i"] = array(
								"id"=>$row['id'],
								"name"=>$row['name']
							);
							$i++;
						}
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