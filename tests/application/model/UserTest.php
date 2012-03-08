<?php

class UserTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		
	}

	public function testGetAllUsers()
	{
		$userModel = new Application_Model_User();
		$users = $userModel->getAllUsers();
		$this->assertEquals(3, 3);
		$this->assertEquals(1, $users[0]->id);
		$this->assertEquals('juan', $users[0]->name);
		$this->assertEquals(2, $users[1]->id);
		$this->assertEquals('paco', $users[1]->name);
		$this->assertEquals(3, $users[2]->id);
		$this->assertEquals('pedro', $users[2]->name);
	}
}