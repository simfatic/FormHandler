<?php

use PHPUnit\Framework\TestCase;

use Simfatic\FormHandler\FormHandler;

class FormValidationTest extends TestCase
{
	public function testValidatorInit()
	{
		$fh =FormHandler::create()->validate(function($validator)
		{
			$validator->fields(['email','name'])->areRequired();
		});
		$res = $fh->process([]);
		$res = json_decode($res);
		
		$this->assertEquals($res->result,'validation_failed');
		$this->assertNotEmpty($res->errors->email);
		$this->assertNotEmpty($res->errors->name);
	}

	public function testValidatorSuccess()
	{
		$fh =FormHandler::create()->validate(function($validator)
		{
			$validator->fields(['email','name'])->areRequired();
		});
		$res = $fh->process(['name'=>'Some name', 'email'=>'an@email.com']);
		$res = json_decode($res);
		
		$this->assertEquals($res->result,'success');
		//$this->assertEmpty($res->errors);
	}

	public function testCaptcha()
	{
		$fh =FormHandler::create()->requireCaptcha();
		$res = $fh->process(['name'=>'Someone']);
		$res = json_decode($res);
		
		$this->assertNotEquals($res->result,'success');
	}

	
}