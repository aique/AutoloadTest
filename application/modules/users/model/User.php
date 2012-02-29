<?php

class Application_Modules_Users_Model_User
{
	public function getAllUsers()
	{
		$querySQL = "SELECT * FROM user";
		
		$result = Library_Manage_DBManager::getAppManage()->getDb()->query($querySQL);
		
		$users = array();
		
		while($userData = $result->fetch_assoc())
		{
			$users[] = new Application_Modules_Users_Model_User_Item($userData);
		}
		
		return $users;
	}
}