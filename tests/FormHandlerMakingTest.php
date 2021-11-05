<?php

use PHPUnit\Framework\TestCase;

use Simfatic\FormHandler\FormHandler;

class FormHandlerMakingTest extends TestCase
{

    public function testEmailInit()
    {
    	$email = 'abc@asjlklkj.com';
    	$fh =FormHandler::create()->sendEmailTo($email);
    	
        $this->assertEquals($email, $fh->getRecipients()[0]);
    }

 	public function testEmailInitMulti()
    {
    	$email1 = 'abc@asjlklkj.com';
    	$email2 = 'abadasdc@asjlklasdskj.com';

    	$fh =FormHandler::create()->sendEmailTo([$email1,$email2]);
    	
        $this->assertEquals($email1, $fh->getRecipients()[0]);
    }

    public function testEmailInitMultiRepeat()
    {
    	$email1 = 'abc@asjlklkj.com';
    	$email2 = 'abadasdc@asjlklasdskj.com';

    	$email3 = 'abad23asdc@asjlklasdskj.com';
    	$email4 = 'abad1122asdc@asjlklasdskj.com';

    	$fh =FormHandler::create()->sendEmailTo([$email1,$email2]);

    	$fh->sendEmailTo([$email3,$email4]);
    	
        $this->assertEquals($email1, $fh->getRecipients()[0]);
        
        $this->assertEquals($email3, $fh->getRecipients()[2]);
    } 

    

}