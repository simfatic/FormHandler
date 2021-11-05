
# Re-captcha example

Go to: https://www.google.com/recaptcha/admin/
Create a new re-captcha. 
Specify the domains where the captcha will be used.

Get the site key and the secret key.

In the form.html code, search for 
```html
<div class="g-recaptcha" data-sitekey="xxxxxxxxxxx"></div>
```
paste the site key in the data-sitekey attribute

Open handler.php and search for `initSecretKey` copy your secret key to initSecretKey function.

Make more customizations in the handler.php file (your email address, "From" address etc )

Upload and test the form
