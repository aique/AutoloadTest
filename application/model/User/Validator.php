<?php

class Application_Model_User_Validator
{
	public static function validateUserId($id)
	{
		return preg_match('/^[1-9][0-9]*$/', $id);
	}
}