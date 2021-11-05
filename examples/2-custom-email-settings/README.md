
# Email Customization Example

FormHandler uses [PHPMailer](https://packagist.org/packages/phpmailer/phpmailer) internally for emailing. 
You can customize the options of PHPMailer. 
For example, in order to use a custom SMTP connection for sending emails, use code like this:
```php
$pp = new FormHandler(); 

$pp->validate(function($validator)
{
	$validator->field('name')->isRequired();
	$validator->field('email')->isEmail()->isRequired();

})->configMailer(function($mailer)
{
    //Set your email address as From address.
    //The email won't get delivered if From address is wrong
    $mailer->setFrom('someone@yourwebsite.com','Form',false);
    
	//Example: using a custom SMTP Server
	
	$mailer->isSMTP();                                    // Send using SMTP
    $mailer->Host       = 'email-smtp.us-west-2.amazonaws.com';             // Set the SMTP server to send through
    //Example: AWS SES. (https://docs.aws.amazon.com/ses/latest/DeveloperGuide/send-using-smtp-php.html)
    $mailer->SMTPAuth   = true;                           // Enable SMTP authentication
    $mailer->Username   = 'user@example.com';             // SMTP username
    $mailer->Password   = 'secret';                       // SMTP password
    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mailer->Port       = 587;   
	
	//Example: adding Cc
	$mail->addCC('cc@example.com');
	
})->sendEmailTo('someone@gmail.com');
```
