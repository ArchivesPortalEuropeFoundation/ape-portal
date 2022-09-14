[[!FormIt?
&hooks=`spam,reCaptchaV3,FormItSaveForm,email`
&formName=`Holding Page Interest Form`
&formFields`name,email,phone,message`
&emailTpl=`holding_email`
&emailHtml=`1`
&emailTo=`[[++contact_email]]`
&emailSubject=`Holding form from [[++site_name]] website`
&validate=`name:required,phone:required,email:email:required,message:required,confirmHSL:blank`
&name.vTextRequired=`Please enter your name.`
&phone.vTextRequired=`Please enter a contact telephone number.`
&email.vTextRequired=`Please enter a valid email address.`
&message.vTextRequired=`Please enter your message.`
&successMessage=`<h1>Thank you</h1><p>We have successfully received your email, and we will be in contact shortly.</p><style>form {display:none !important;}</style>`
]][[!+fi.successMessage:toPlaceholder=`validationMessage`]]<!DOCTYPE html>
<html lang="[[!++cultureKey]]" class="holding">
<head>
	[[$site_scripts]]
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1 text-center">
			[[!+validationMessage:isnotempty=`[[!+validationMessage]]`:default=`<h1>Coming Soon...</h1><p>This website is currently under development by <a href="http://www.gelstudios.co.uk/" title="GEL Studios Ltd - We build amazing websites">GEL Studios</a>.</p>`]]
		</div>
		[[!+validationMessage:isnotempty=``:default=`<div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-12 text-center">
			<form action="[[~[[*id]]]]" method="post">
				<input type="text" name="confirmHSL" value="[[!+fi.confirmHSL]]" hidden />

				<div class="icon name">
					<input type="text" name="name" value="[[!+fi.name]]" placeholder="[[!%asi.input_ph_full_name? &topic=`label` &namespace=`asi`]]"/>
					[[!+fi.error.name]]
				</div>
				<div class="icon email">
					<input type="text" name="email" value="[[!+fi.email]]" placeholder="Email"/>
					[[!+fi.error.email]]
				</div>
				<div class="icon phone">
					<input type="text" name="phone" value="[[!+fi.phone]]" placeholder="Phone"/>
					[[!+fi.error.phone]]
				</div>
				<div class="icon message">
					<textarea name="message" placeholder="How can we help?">[[!+fi.message]]</textarea>
					[[!+fi.error.message]]
				</div>
				<input type="submit" value="Contact Us" />
				[[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
			</form>
		</div>`]]
	</div>
</div>

[[!++recaptcha_publish_key:isnotempty=`<script src="https://www.google.com/recaptcha/api.js?render=[[++recaptcha_publish_key]]"></script>
<script>
	grecaptcha.ready(function() {
		grecaptcha.execute('[[++recaptcha_publish_key]]').then(function(token) {
			var forms = document.getElementsByTagName('form');

			for(var i = 0; i < forms.length; i++){
				var x = document.createElement('input');
				x.type = 'hidden';
				x.name = 'recaptcha_token';
				x.value = token;
				forms[i].appendChild(x);
			}
		});
	});
</script>`]]
</body>
</html>
