<?php

class Application_Modules_Users_Model_User
{
	public function getAllUsers()
	{
		$query = "SELECT * FROM user";
		
		$result = Library_Manage_DBManager::getDbManager()->query($query);
		
		$users = array();
		
		while($userData = $result->fetch_assoc())
		{
			$users[] = new Application_Modules_Users_Model_User_Item($userData);
		}
		
		return $users;
	}
}