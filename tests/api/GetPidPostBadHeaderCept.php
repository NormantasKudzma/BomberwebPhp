<?php
	$I = new ApiTester($scenario);
	$I->wantTo('get new pid for a user');
	$I->haveHttpHeader(' Content-Type', 'xxyyzz');
	$I->sendPOST('http://localhost/api/v1/action/GetPid.php', json_encode(array('action' => 'GetPid')));
	$I->seeResponseCodeIs(400);
	$I->seeResponseIsJson();
?>