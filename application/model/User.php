<?php

class Application_Model_User
{
	public function getUser($id)
	{
		$query = "SELECT id, name, role, email, married, childNum, jobDesc FROM user WHERE id = '" . Library_Qframe_Manage_InputManager::cleanQueryParam($id, Library_Qframe_Manage_InputManager::INTEGER) . "'";
		
		$result = Library_Qframe_Manage_DBManager::getInstance()->query($query);
		
		$user = false;
		
		while($userData = $result->fetch_assoc())
		{
			$user = new Application_Model_User_Item($userData);
		}
		
		return $user;
	}
	
	public function getUserByEmail($email)
	{
		$query = "SELECT id, name, role, email, married, childNum, jobDesc FROM user WHERE email = '" . Library_Qframe_Manage_InputManager::cleanQueryParam($email, Library_Qframe_Manage_InputManager::STRING) . "'";
		
		$result = Library_Qframe_Manage_DBManager::getInstance()->query($query);
	
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
	
		$result = Library_Qframe_Manage_DBManager::getInstance()->query($query);
	
		$users = array();
	
		while($userData = $result->fetch_assoc())
		{
			$users[] = new Application_Model_User_Item($userData);
		}
	
		return $users;
	}
	
	public function getSpecificUsers($startIndex, $numElements)
	{
		$query = "SELECT id, name, role, email, married, childNum, jobDesc FROM user LIMIT ".$startIndex.",".$numElements;
		
		$result = Library_Qframe_Manage_DBManager::getInstance()->query($query);
		
		$users = array();
		
		while($userData = $result->fetch_assoc())
		{
			$users[] = new Application_Model_User_Item($userData);
		}
		
		return $users;
	}
	
	public function getNumUsers()
	{
		$query = "SELECT COUNT(id) num_users FROM user";
		
		$result = Library_Qframe_Manage_DBManager::getInstance()->query($query);
		
		$numUsers = 0;
		
		while($data = $result->fetch_assoc())
		{
			$numUsers = $data["num_users"];
		}
		
		return $numUsers;
	}
	
	public function loginUser($name, $pass)
	{
		$query = "SELECT id, name, role, email, married, childNum, jobDesc FROM user WHERE name = '" . Library_Qframe_Manage_InputManager::cleanQueryParam($name, Library_Qframe_Manage_InputManager::STRING) . "' AND ".
															  		   			 		  "pass = '" . Library_Qframe_Encrypt_Encrypter::passwordEncrypt(Library_Qframe_Manage_InputManager::cleanQueryParam($pass, Library_Qframe_Manage_InputManager::STRING)) . "'";
		
		$result = Library_Qframe_Manage_DBManager::getInstance()->query($query);
		
		$user = false;
		
		while($userData = $result->fetch_assoc())
		{
			$user = new Application_Model_User_Item($userData);
		}
		
		return $user;
	}
	
	public function insertUser(Application_Model_User_Item $user)
	{
		$query = "INSERT INTO user(name, pass, role, email, married, childNum, jobDesc) VALUES ('".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getName(), Library_Qframe_Manage_InputManager::STRING)."',".
																					  		   "'".Library_Qframe_Encrypt_Encrypter::passwordEncrypt(Library_Qframe_Manage_InputManager::cleanQueryParam($user->getPassword(), Library_Qframe_Manage_InputManager::STRING))."',".
																					  		   "'".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getRole(), Library_Qframe_Manage_InputManager::STRING)."',".
																					  		   "'".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getEmail(), Library_Qframe_Manage_InputManager::STRING)."',".
																							   "'".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getMarried(), Library_Qframe_Manage_InputManager::INTEGER)."',".
																							   "'".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getChildNum(), Library_Qframe_Manage_InputManager::INTEGER)."',".
																					  		   "'".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getJobDesc(), Library_Qframe_Manage_InputManager::STRING)."')";
		
		return Library_Qframe_Manage_DBManager::getInstance()->query($query);
	}
	
	public function updateUser(Application_Model_User_Item $user)
	{
		$query = "UPDATE user SET name = '".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getName(), Library_Qframe_Manage_InputManager::STRING)."',".
								 "pass = '".Library_Qframe_Encrypt_Encrypter::passwordEncrypt(Library_Qframe_Manage_InputManager::cleanQueryParam($user->getPassword(), Library_Qframe_Manage_InputManager::STRING))."',".
								 "role = '".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getRole(), Library_Qframe_Manage_InputManager::STRING)."',".
								 "email = '".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getEmail(), Library_Qframe_Manage_InputManager::STRING)."',".
								 "married = '".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getMarried(), Library_Qframe_Manage_InputManager::INTEGER)."',".
								 "childNum = '".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getChildNum(), Library_Qframe_Manage_InputManager::INTEGER)."',".
								 "jobDesc = '".Library_Qframe_Manage_InputManager::cleanQueryParam($user->getJobDesc(), Library_Qframe_Manage_InputManager::STRING)."' ".
						 	  "WHERE id = '" . Library_Qframe_Manage_InputManager::cleanQueryParam($user->getId(), Library_Qframe_Manage_InputManager::INTEGER) . "'";
		
		return Library_Qframe_Manage_DBManager::getInstance()->query($query);
	}
	
	public function deleteUser($id)
	{
		$query = "DELETE FROM user WHERE id = '" . Library_Qframe_Manage_InputManager::cleanQueryParam($id, Library_Qframe_Manage_InputManager::INTEGER) . "'";
		
		return Library_Qframe_Manage_DBManager::getInstance()->query($query);
	}
	
}