<?php

class Library_Qframe_Encrypt_PasswordEncrypter
{
	const STEP_FIRST = '*ANT@ant';
	const STEP_SECOND = '@MED/med#*';
	const STEP_THIRD = 'PO/*st@*/';
	
	public static function encrypt($password)
	{
		$password_0 = substr($password, 0, 1);
		$password_1 = substr($password, 1);
			
		return md5(self::STEP_FIRST.$password_0.self::STEP_SECOND.$password_1.self::STEP_THIRD);
	}
}