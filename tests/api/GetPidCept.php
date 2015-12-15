<?php
	$I = new ApiTester($scenario);
	$I->wantTo('get new pid for a user');
	$I->setHeader("Content-Type", "application/json");
	$I->sendPOST('http://localhost/api/v1/action/GetPid.php', json_encode(array('action' => 'GetPid')));
	$I->seeResponseCodeIs(200);
	$I->seeResponseIsJson();
	$I->seeResponseContains("pid");
?>