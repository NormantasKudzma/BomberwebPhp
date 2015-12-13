<?php
	include_once('../resourcebase.php');
	$resource = "action";
	
	writeToLog("METHOD", $_SERVER['REQUEST_METHOD']);
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = array('Bomb', 'CreateRoom', 'Die', 'EnterRoom', 'Explode', 'GameEnd', 'GameStart', 
										'GameState', 'GetPid', 'LeaveRoom', 'Move', 'UpdatePlayers', 'UpdateRooms');
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