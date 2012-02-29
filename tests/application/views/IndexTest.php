<?php

class IndexTest extends PHPUnit_Extensions_SeleniumTestCase
{
	protected function setUp()
	{
		$this->setBrowser("*firefox");
		$this->setBrowserUrl("http://localhost/autoload_test/public/index.php");
	}

	public function testTitle()
	{
		$this->open("http://localhost/autoload_test/public/index.php");
		$this->assertTitle("Autoload Test");
	}
}