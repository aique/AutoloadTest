<?php

class UserTest extends PHPUnit_Framework_TestCase
{
	public function testGetAllUsers()
	{
		$userModel = new Application_Model_User();
		
		$users = $userModel->getAllUsers();
		
		$this->assertEquals(4, count($users));
		
		$this->assertEquals(1, $users[0]->id);
		$this->assertEquals('juan', $users[0]->name);
		$this->assertEquals('admin', $users[0]->role);
		$this->assertEquals(0, $users[0]->married);
		$this->assertEquals(0, $users[0]->childNum);
		$this->assertEquals("Administrador", $users[0]->jobDesc);
		
		$this->assertEquals(2, $users[1]->id);
		$this->assertEquals('paco', $users[1]->name);
		$this->assertEquals('guest', $users[1]->role);
		$this->assertEquals('paco@gmail.com', $users[1]->email);
		$this->assertEquals(1, $users[1]->married);
		$this->assertEquals(2, $users[1]->childNum);
		$this->assertEquals("Mecánico", $users[1]->jobDesc);
		
		$this->assertEquals(3, $users[2]->id);
		$this->assertEquals('ana', $users[2]->name);
		$this->assertEquals('guest', $users[2]->role);
		$this->assertEquals('ana@mail.com', $users[2]->email);
		$this->assertEquals(0, $users[2]->married);
		$this->assertEquals(0, $users[2]->childNum);
		$this->assertEquals("Administrativa", $users[2]->jobDesc);
		
		$this->assertEquals(4, $users[3]->id);
		$this->assertEquals('maria', $users[3]->name);
		$this->assertEquals('admin', $users[3]->role);
		$this->assertEquals('maria.perez@mail.com', $users[3]->email);
		$this->assertEquals(1, $users[3]->married);
		$this->assertEquals(2, $users[3]->childNum);
		$this->assertEquals("Administradora", $users[3]->jobDesc);
	}
	
	public function testInsertUser()
	{
		$userModel = new Application_Model_User();
		
		$user = new Application_Model_User_Item(array("name" => "pedro",
													  "password" => "pedro",
													  "role" => "guest",
													  "email" => "pedro.salinas@mail.com",
													  "married" => "0",
													  "childNum" => "1",
													  "jobDesc" => "Fontanero"));
		
		$this->assertTrue($userModel->insertUser($user));
		
		$users = $userModel->getAllUsers();
		
		$this->assertEquals(5, count($users));
		
		$userModel = new Application_Model_User();
		
		$user = $userModel->getUserByEmail('pedro.salinas@mail.com');
		
		$this->assertEquals('pedro', $user->name);
		$this->assertEquals('guest', $user->role);
		$this->assertEquals('pedro.salinas@mail.com', $user->email);
		$this->assertEquals(0, $user->married);
		$this->assertEquals(1, $user->childNum);
		$this->assertEquals("Fontanero", $user->jobDesc);
	}
	
	public function testUpdateUser()
	{
		$userModel = new Application_Model_User();
		
		$user = new Application_Model_User_Item(array("id" => $userModel->getUserByEmail('pedro.salinas@mail.com')->getId(),
													  "name" => "felipe",
													  "password" => "pedro",
													  "role" => "guest",
													  "email" => "felipe.salinas@mail.com",
													  "married" => "1",
													  "childNum" => "0",
													  "jobDesc" => "Profesor"));
		
		$userModel->updateUser($user);
		
		$user = $userModel->getUserByEmail('felipe.salinas@mail.com');
		
		$this->assertEquals('felipe', $user->name);
		$this->assertEquals('guest', $user->role);
		$this->assertEquals('felipe.salinas@mail.com', $user->email);
		$this->assertEquals(1, $user->married);
		$this->assertEquals(0, $user->childNum);
		$this->assertEquals("Profesor", $user->jobDesc);
	}
	
	public function testDeleteUser()
	{
		$userModel = new Application_Model_User();
		
		$this->assertTrue($userModel->deleteUser($userModel->getUserByEmail('pedro.salinas@mail.com')->getId()));
		
		$users = $userModel->getAllUsers();
		
		$this->assertEquals(4, count($users));
	}
}