<?php
	$I = new ApiTester($scenario);
	$I->wantTo('get new pid for a user');
	$I->haveHttpHeader("Content-Type", "application/json");
	$I->sendGET('http://localhost/api/v1/action/GetPid.php');
	$I->seeResponseCodeIs(200);
	$I->seeResponseIsJson();
	$I->seeResponseContainsJson(array("action" => "GetPid"));
?>