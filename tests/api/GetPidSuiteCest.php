<?php
use \ApiTester;

class GetPidSuiteCest
{
    public function _before(ApiTester $I)
    {
		//stub
    }

    public function _after(ApiTester $I)
    {
		//stub
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
		//stub
    }
	
	public function getPidNormal(ApiTester $I)
	{
		$I = new ApiTester($scenario);
		$I->wantTo('get new pid for a user');
		$I->haveHttpHeader(' Content-Type', 'application/json');
		$I->sendPOST('http://localhost/api/v1/action/GetPid.php', json_encode(array('action' => 'GetPid')));
		$I->seeResponseCodeIs(200);
		$I->seeResponseIsJson();
		$I->seeResponseContains("pid");
	}
	
	public function getPidGet(ApiTester $I)
	{
		$I = new ApiTester($scenario);
		$I->wantTo('get new pid for a user');
		$I->haveHttpHeader(' Content-Type', 'application/json');
		$I->sendGET('http://localhost/api/v1/action/GetPid.php');
		$I->seeResponseCodeIs(200);
		$I->seeResponseIsJson();
		$I->seeResponseContainsJson(array('action' => 'GetPid'));
	}
	
	public function getPidBadHeader(ApiTester $I)
	{
		$I = new ApiTester($scenario);
		$I->wantTo('get new pid for a user');
		$I->haveHttpHeader(' Content-Type', 'xxyyzz');
		$I->sendPOST('http://localhost/api/v1/action/GetPid.php', json_encode(array('action' => 'GetPid')));
		$I->seeResponseCodeIs(400);
		$I->seeResponseIsJson();
	}
	
	public function getPidNoAction(ApiTester $I)
	{
		$I = new ApiTester($scenario);
		$I->wantTo('get new pid for a user');
		$I->haveHttpHeader(' Content-Type', 'application/json');
		$I->sendPOST('http://localhost/api/v1/action/GetPid.php');
		$I->seeResponseCodeIs(400);
		$I->seeResponseIsJson();
	}
	
	public function getPidPut(ApiTester $I)
	{
		$I = new ApiTester($scenario);
		$I->wantTo('get new pid for a user');
		$I->haveHttpHeader(' Content-Type', 'application/json');
		$I->sendPUT('http://localhost/api/v1/action/GetPid.php');
		$I->seeResponseCodeIs(403);
		$I->seeResponseIsJson();
	}
}
