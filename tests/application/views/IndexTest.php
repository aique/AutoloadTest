<?php

class IndexTest extends PHPUnit_Extensions_SeleniumTestCase
{
	protected function setUp()
	{
		$this->setBrowser("*firefox");
		$this->setBrowserUrl("http://autoload");
	}

	public function testTitle()
	{
		$this->open("http://autoload");
		$this->assertTitle("Autoload Test");
	}
	
	public function testInsertUser()
	{
		$this->open("http://autoload");

		// Fill
		$this->type("dom=document.forms['login_form'].usuario", 'juan');
		$this->type("dom=document.forms['login_form'].password", 'juan');
		
		// Submit
		$this->click("xpath=//input[@type='submit']");
		
		$this->waitForPageToLoad(30000); // 30 second default
		
		// Verify 
		$this->assertTextPresent('Lista de usuarios');
		
		$this->open("http://autoload/cms/user/insert");
		
		// Fill
		$this->type("dom=document.forms['insert_form'].name", 'alejandro');
		$this->type("dom=document.forms['insert_form'].password", 'alejandro');
		$this->type("dom=document.forms['insert_form'].pass_conf", 'alejandro');
		$this->type("dom=document.forms['insert_form'].email", 'alex@mail.com');
		$this->click("xpath=//input[@id='married']");
		$this->click("xpath=//input[@id='childNum5']");
		$this->type("dom=document.forms['insert_form'].jobDesc", 'Electricista');
		
		// Submit
		$this->click("xpath=//input[@type='submit']");
		
		$this->waitForPageToLoad(30000); // 30 second default
		
		$this->open("http://autoload/cms/user/list/page/3");
		
		$this->waitForPageToLoad(30000); // 30 second default
		
		$this->assertTextPresent('alejandro');
		
		$userModel = new Application_Model_User();
		
		$user = $userModel->getUserByEmail('alex@mail.com');
		
		$this->click("xpath=//a[@id='delete_action_".$user->getId()."']");
		
		$this->open("http://autoload/cms/user/list/page/3");
		
		$this->assertTextPresent('ana');
		$this->assertTextPresent('maria');
		$this->assertTextNotPresent('alejandro');
	}
}