<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';


use FormGuide\Handlx\FormHandler;

$pp = new FormHandler(); 

$pp->validate(function($validator)
{
	$validator->field('name')->isRequired();
	$validator->field('email')->isEmail()->isRequired();

})->configMailer(function($mailer)
{
	$mailer->setFrom('someone@form.guide','Form',false);
	
})->sendEmailTo('prasanthmj@gmail.com');


echo $pp->process($_POST);