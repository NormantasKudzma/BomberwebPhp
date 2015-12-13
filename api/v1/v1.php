<?php
	include_once('resourcebase.php');
	$resource = "v1";
	
	writeToLog("METHOD", $_SERVER['REQUEST_METHOD']);
	switch ($_SERVER['REQUEST_METHOD']){
		case 'GET':{
			$response['action'] = 'actions';
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