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
	
	public function testLogin()
	{
		$this->open("http://autoload");

		// Fill
		$this->type("dom=document.forms['login_form'].usuario", 'juan');
		$this->type("dom=document.forms['login_form'].password", 'juan');
		
		// Submit
		$this->click("xpath=//form[@id='login_form']/input[@type='submit']");
		$this->waitForPageToLoad(30000); // 30 second default
		
		// Verify 
		$this->assertTextPresent('Lista de usuarios');
		$this->assertTextNotPresent('Nombre o contraseña no válida');
	}
}