<?php

class Application_Model_User_Printer
{
	public static function printHTML(Application_Model_User_Item $user)
	{
		return '<li><a href="#">'.$user->name.'</a> ['.$user->id.']</li>';
	}
}