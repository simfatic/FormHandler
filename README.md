# A simple PHP form handler 
This package can be used to create simple PHP scripts that handles a form submission. At the moment, this PHP form handler validates, handles captcha, emails form submissions, and handles file attachments

### Simple usage
```php
use Simfatic\FormHandler\FormHandler;

$fh = new FormHandler(); 

$fh->validate(function($validator)
{
	$validator->field('name')->isRequired();
	$validator->field('email')->isEmail()->isRequired();

})->sendEmailTo('someone@website.com');


echo $fh->process($_POST);
```
Form validations are done using [Simfatic\Boar](https://github.com/simfatic/boar). So any of the customizations can go in the validate callback.



## Customizing the mailer
The FormHandler uses PHPMailer. The options can be customized like this:

```php
use Simfatic\FormHandler\FormHandler;

$fh = new FormHandler(); 

$fh->validate(function($validator)
{
	$validator->field('name')->isRequired();
	$validator->field('email')->isEmail()->isRequired();

})->configMailer(function($mailer)
{
	$mailer->setFrom('someone@yourwebsite.com','Form',false);
	
	$mailer->isSMTP();                                    // Send using SMTP
    $mailer->Host       = 'smtp.example.com';             // Set the SMTP server to send through
    $mailer->SMTPAuth   = true;                           // Enable SMTP authentication
    $mailer->Username   = 'user@example.com';             // SMTP username
    $mailer->Password   = 'secret';                       // SMTP password
    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mailer->Port       = 587;   
	
	/*
	Example: adding Cc
	$mail->addCC('cc@example.com');
	*/
	
})->sendEmailTo('someone@gmail.com');


echo $fh->process($_POST);
```

## File attachments

call attachFiles passing the name of the file upload fields.

```php
$fh = new FormHandler(); 

$fh->validate(function($validator)
{
    $validator->field('name')->isRequired();
    $validator->field('email')->isEmail()->isRequired();

})->attachFiles(['image'])
->sendEmailTo('someone@gmail.com');
```

## ReCaptcha v2 
In order to show the "I am not a robot" checkbox, create a div in your form like so:
```html
<div class="g-recaptcha" data-sitekey="xxxxxxxxxxx"></div>
```
Then update the handler:
```php
use Simfatic\FormHandler\FormHandler;

$pp = new FormHandler(); 

$pp->validate(function($validator)
{
	$validator->field('name')->isRequired();
	$validator->field('email')->isEmail()->isRequired();
})
->requireReCaptcha(function($recaptcha)
{
	$recaptcha->initSecretKey('xxxxxx');
})
->configMailer(function($mailer)
{
	$mailer->setFrom('someone@form.guide','Form',false);
})
->sendEmailTo('someone@gmail.com');


echo $pp->process($_POST);
```

See a complete example in the [examples folder](examples/4-recaptcha/README.md)

## Client side handling
You can directly provide the link to your custom handler.php in the action attribute of the form.  

Another alternative is to use Javascript to process the response from the form.
The response from the process() function is JSON. Here is an example. This example uses jQuery.

```javascript
$(function()
{
	$('#contact_form').submit(function(e)
	{
		e.preventDefault();
		$.post( 'handler.php', $('form#contact_form').serialize(), 
		    function(data) 
		      {
                if(data.result == 'success')
                {
                    $('form#contact_form').hide();
                    $('#success_message').show();
                }
                else
                {
                    $('#error_message').append('<ul></ul>')
                    jQuery.each(data.errors,function(key,val)
                    {
                        $('#error_message ul').append('<li>'+key+':'+val+'</li>');
                    });
                    $('#error_message').show();
                    
                }
		        
		      },'json');
	});
});
```