[[!++recaptcha_publish_key:isnotempty=`
<script src="https://www.google.com/recaptcha/api.js?render=[[++recaptcha_publish_key]]"></script>
<script>
	function gRecap() {
		grecaptcha.ready(function () {
			grecaptcha.execute("[[++recaptcha_publish_key]]").then(function (token) {
				var forms = document.getElementsByTagName('form');
				for (var i = 0; i < forms.length; i++) {

					// Don't add recaptcha to forms that do want it
					if (forms[i].classList.contains('noRecap')) {
						continue;
					}

					let extTok = document.getElementById("tok_" + i);

					if (typeof extTok !== "undefined" && extTok !== null) {
						extTok.remove();
					}

					var x = document.createElement('input');
					x.type = 'hidden';
					x.name = 'recaptcha_token';
					x.value = token;
					x.id = 'tok_' + i;
					forms[i].appendChild(x);
				}
			});
		});
	}

	gRecap();
	setInterval(function () {
		gRecap();
	}, 90 * 1000);

</script>
`]]

<script>
	var js_locale = "en-GB";
</script>

<script src="/assets/production.min.js?v=[[+now:default=`now`:strtotime]]"></script>

<script>
	$('#cookieBanner a.cookieReject').click(function(e) {
		e.preventDefault();
		setCookie("cookiesAccept", 0, 1);
		$('#cookieBanner').hide();
	});
	$('#cookieBanner a.cookieAccept').click(function (e) {
		e.preventDefault();
		setCookie("cookiesAccept", 1, 31);
		$('#cookieBanner').hide();
	});
	CookiesAccepted();
</script>