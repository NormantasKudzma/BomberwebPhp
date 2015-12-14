<?php
	$I = new ApiTester($scenario);
	$I->wantTo('get new pid for a user');
	$I->haveHttpHeader(' Content-Type', 'application/json');
	$I->sendPOST('http://localhost/api/v1/action/GetPid.php');
	$I->seeResponseCodeIs(400);
	$I->seeResponseIsJson();
?>