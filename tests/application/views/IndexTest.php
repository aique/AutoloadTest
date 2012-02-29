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
}