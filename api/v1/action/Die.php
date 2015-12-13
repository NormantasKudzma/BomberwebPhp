<?php
	include_once('../resourcebase.php');
	$resource = "Die";
	
	$response["response"] = "unimplemented";
	http_response_code(404);
	
	sendResponse();
?>