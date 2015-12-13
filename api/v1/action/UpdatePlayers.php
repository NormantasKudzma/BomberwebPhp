<?php
	include_once('../resourcebase.php');
	$resource = "UpdatePlayers";
	
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
					$q = "SELECT ". PLAYERS .".x,". PLAYERS .".y,". PLAYERS .".id FROM ". PLAYERS ." WHERE ". PLAYERS .".gameroom='{$json['gameRoom']}'";
					$result = queryDB($q);
					$pids = array();
					if ($result != null && $result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							array_push($pids, $row['id']);
							$response[$row['id']] = array(
								"x"=>$row['x'], 
								"y"=>$row['y']
							);
						}
						$response["pids"] = $pids;
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