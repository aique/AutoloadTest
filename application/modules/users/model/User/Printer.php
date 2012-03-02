<?php

class Application_Modules_Users_Model_User_Printer
{
	public static function printHTMLFormat(Application_Modules_Users_Model_User_Item $user)
	{
		return '<li><a href="#">'.$user->name.'</a> ['.$user->id.']</li>';
	}
}