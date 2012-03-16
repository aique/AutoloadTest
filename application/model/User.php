<?php

class Application_Model_User
{
	public function getUser($id)
	{
		$query = "SELECT id, name, role, email, married, childNum, jobDesc FROM user WHERE id = '" . mysql_real_escape_string($id) . "'";
		
		$result = Library_Manage_DBManager::getInstance()->query($query);
		
		$user = false;
		
		while($userData = $result->fetch_assoc())
		{
			$user = new Application_Model_User_Item($userData);
		}
		
		return $user;
	}
	
	public function getAllUsers()
	{
		$query = "SELECT id, name, role, email, married, childNum, jobDesc FROM user";
		
		$result = Library_Manage_DBManager::getInstance()->query($query);
		
		$users = array();
		
		while($userData = $result->fetch_assoc())
		{
			$users[] = new Application_Model_User_Item($userData);
		}
		
		return $users;
	}
	
	public function loginUser($name, $pass)
	{
		$query = "SELECT id, name, role, email, married, childNum, jobDesc FROM user WHERE name = '" . mysql_real_escape_string($name) . "' AND ".
															  		   			 		  "pass = '" . Library_Encrypt_PasswordEncrypter::encrypt(mysql_real_escape_string($pass)) . "'";
		
		$result = Library_Manage_DBManager::getInstance()->query($query);
		
		$user = false;
		
		while($userData = $result->fetch_assoc())
		{
			$user = new Application_Model_User_Item($userData);
		}
		
		return $user;
	}
	
	public function insertUser(Application_Model_User_Item $user)
	{
		$query = "INSERT INTO user(name, pass, role, email, married, childNum, jobDesc) VALUES ('".mysql_real_escape_string($user->getName())."',".
																					  		   "'".Library_Encrypt_PasswordEncrypter::encrypt(mysql_real_escape_string($user->getPassword()))."',".
																					  		   "'".mysql_real_escape_string($user->getRole())."',".
																					  		   "'".mysql_real_escape_string($user->getEmail())."',".
																							   "'".mysql_real_escape_string($user->getMarried())."',".
																							   "'".mysql_real_escape_string($user->getChildNum())."',".
																					  		   "'".mysql_real_escape_string($user->getJobDesc())."')";
		
		return Library_Manage_DBManager::getInstance()->query($query);
	}
	
	public function updateUser(Application_Model_User_Item $user)
	{
		$query = "UPDATE user SET name = '".mysql_real_escape_string($user->getName())."',".
								 "pass = '".Library_Encrypt_PasswordEncrypter::encrypt(mysql_real_escape_string($user->getPassword()))."',".
								 "role = '".mysql_real_escape_string($user->getRole())."',".
								 "email = '".mysql_real_escape_string($user->getEmail())."',".
								 "married = '".mysql_real_escape_string($user->getMarried())."',".
								 "childNum = '".mysql_real_escape_string($user->getChildNum())."',".
								 "jobDesc = '".mysql_real_escape_string($user->getJobDesc())."' ".
						 	  "WHERE id = '" . mysql_real_escape_string($user->getId()) . "'";
		
		return Library_Manage_DBManager::getInstance()->query($query);
	}
	
	public function deleteUser($id)
	{
		$query = "DELETE FROM user WHERE id = '" . mysql_real_escape_string($id) . "'";
		
		return Library_Manage_DBManager::getInstance()->query($query);
	}
	
}