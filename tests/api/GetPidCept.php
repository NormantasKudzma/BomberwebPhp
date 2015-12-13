<?php 
$I = new ApiTester($scenario);
$I->wantTo('get new pid for a user');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendPOST('/action/GetPid.php', json_encode(array('action' => 'GetPid')));
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(["response" => "success"]);
$I->grabDataFromJsonResponse("pid");
?>