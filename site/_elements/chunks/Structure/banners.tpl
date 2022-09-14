<div id="cookieBanner" style="display:none;" onload="checkCookie()">
    <div class="container">
	    <p>[[++cookie_banner_text]] <a href="[[~[[++cookie_banner_link]]]]">[[!%asi.title_cookie_policy? &topic=`default` &namespace=`asi`]]</a>. <a class="button blackPink border cookieAccept">[[!%asi.action_accept? &topic=`actions` &namespace=`asi`]]</a> <a class="button blackPink border cookieReject">[[!%asi.action_reject? &topic=`actions` &namespace=`asi`]]</a></p>
	</div>
</div>

[[*id:inarray=`[[++promo_banner_exclude]]`:then=``:else=`
	[[++promo_banner_text:notempty=`
		<div class="promoBanner" id="[[++promo_banner_text:md5]]" style="display: none;">
			<div class="container">
				<h5>[[++promo_banner_text]] <a href="[[~[[++promo_banner_link]]]]">[[!%asi.action_more? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-right ml"></i></a></h5>
				<span class="closeIcon"><i class="fas fa-times"></i></span>
			</div>
		</div>	
	`]]
`]]