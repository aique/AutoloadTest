<?php

class Application_Model_User
{
	public function getUser($id)
	{
		$query = "SELECT id, name, role, email FROM user WHERE id = '" . mysql_real_escape_string($id) . "'";
		
		$result = Library_Manage_DBManager::getDbManager()->query($query);
		
		$user = false;
		
		while($userData = $result->fetch_assoc())
		{
			$user = new Application_Model_User_Item($userData);
		}
		
		return $user;
	}
	
	public function getAllUsers()
	{
		$query = "SELECT id, name, role, email FROM user";
		
		$result = Library_Manage_DBManager::getDbManager()->query($query);
		
		$users = array();
		
		while($userData = $result->fetch_assoc())
		{
			$users[] = new Application_Model_User_Item($userData);
		}
		
		return $users;
	}
	
	public function loginUser($name, $pass)
	{
		$query = "SELECT id, name, role, email FROM user WHERE name = '".mysql_real_escape_string($name)."' AND
															   pass = '" . mysql_real_escape_string($pass) . "'";
		
		$result = Library_Manage_DBManager::getDbManager()->query($query);
		
		$user = false;
		
		while($userData = $result->fetch_assoc())
		{
			$user = new Application_Model_User_Item($userData);
		}
		
		return $user;
	}
	
	public function insertUser(Application_Model_User_Item $user)
	{
		$query = "INSERT INTO user(name, pass, role, email) VALUES ('".mysql_real_escape_string($user->getName())."',
																	'".mysql_real_escape_string($user->getPassword())."',
																	'".mysql_real_escape_string($user->getRole())."',
																	'".mysql_real_escape_string($user->getEmail())."')";
		
		return Library_Manage_DBManager::getDbManager()->query($query);
		
	}
	
	public function deleteUser($id)
	{
		$query = "DELETE FROM user WHERE id = '" . mysql_real_escape_string($id) . "'";
		
		return Library_Manage_DBManager::getDbManager()->query($query);
	}
	
}