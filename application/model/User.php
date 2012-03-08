<?php

class Application_Model_User
{
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
		$query = "SELECT id, name, role, email FROM user WHERE pass = '" . mysql_escape_string($pass) . "'";
		
		$result = Library_Manage_DBManager::getDbManager()->query($query);
		
		$user = false;
		
		while($userData = $result->fetch_assoc())
		{
			$user = new Application_Model_User_Item($userData);
		}
		
		return $user;
	}
}