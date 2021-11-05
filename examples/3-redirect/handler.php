<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';


use Simfatic\FormHandler\FormHandler;
try
{
	$pp = new FormHandler(); 

	$pp->validate(function($validator)
	{
		$validator->field('name')->isRequired();
		$validator->field('email')->isEmail()->isRequired();

	})->attachFiles(['image'])
	->sendEmailTo('someone@gmail.com');

	$res = json_decode($pp->process($_POST));
	if($res->result == 'success')
	{
		header('Location: thankyou.html');
		exit();
	}
	else
	{
		print_r($res);
	}

}
catch(Exception $e)
{
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}