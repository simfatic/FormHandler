<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';


use FormGuide\Handlx\FormHandler;
try
{
	$pp = new FormHandler(); 

	$pp->validate(function($validator)
	{
		$validator->field('name')->isRequired();
		$validator->field('email')->isEmail()->isRequired();

	})->requireCaptcha()
	->configMailer(function($mailer)
	{
		$mailer->setFrom('someone@form.guide','Form',false);
		
	})->sendEmailTo('someone@gmail.com');


	echo $pp->process($_POST);
}
catch(Exception $e)
{
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}