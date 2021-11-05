<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';


use Simfatic\FormHandler\FormHandler;

$pp = new FormHandler(); 

$pp->validate(function($validator)
{
	$validator->field('name')->isRequired();
	$validator->field('email')->isEmail()->isRequired();

})->configMailer(function($mailer)
{
	$mailer->setFrom('someone@yourwebsite.com','Form',false);
	
	/*
	Example: using a custom SMTP Server
	
	$mailer->isSMTP();                                    // Send using SMTP
    $mailer->Host       = 'smtp.example.com';             // Set the SMTP server to send through
    $mailer->SMTPAuth   = true;                           // Enable SMTP authentication
    $mailer->Username   = 'user@example.com';             // SMTP username
    $mailer->Password   = 'secret';                       // SMTP password
    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mailer->Port       = 587;   
	*/  
	
	/*
	Example: adding Cc
	$mail->addCC('cc@example.com');
	*/
	
})->sendEmailTo('someone@gmail.com');


echo $pp->process($_POST);