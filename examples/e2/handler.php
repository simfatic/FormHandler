<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';

use FormGuide\Handlx\FormHandler;

$pp = new FormHandler();

$pp->validate(function($validator)
{
	$validator->field('name1')->isRequired();
	$validator->field('email')->isEmail()->isRequired();

})->sendEmailTo('someone@gmail.com');


echo $pp->process($_POST);