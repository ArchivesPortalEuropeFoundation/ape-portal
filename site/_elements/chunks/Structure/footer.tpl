<footer>
    <div class="container">
		<div class="contactSocial">
			<p>[[!%asi.title_follow_us? &topic=`default` &namespace=`asi`]]:</p>
			[[$socialLinks]]
		</div>
		[[++footer_text_1]]
		<div class="logos">
			[[++footer_logo_1:isnot=`/uploads/`:then=`<a href="https://ec.europa.eu/cip/ict-psp/index_en.htm" target="_blank"><img class="logo" src="[[++footer_logo_1]]"></a>`]]
			[[++footer_logo_2:isnot=`/uploads/`:then=`<a href="https://ec.europa.eu/info/index_en" target="_blank"><img class="logo" src="[[++footer_logo_2]]"></a>`]]
			[[++footer_logo_3:isnot=`/uploads/`:then=`<a href="https://www.europeana.eu/en" target="_blank"><img class="logo" src="[[++footer_logo_3]]"></a>`]]
            [[++footer_logo_4:isnot=`/uploads/`:then=`<img class="logo" src="[[++footer_logo_4]]">`]]
        </div>
		[[++footer_text_2]]
		[[pdoResources?
		  &parents=`0`
		  &resources=`[[++footer_links]]`
		  &tpl=`footerLinksTpl`
		  &sortby=`{"menuindex":"ASC"}`
		]]
		Re-design by <a href="https://www.gelstudios.co.uk" target="_blank">GEL Studios</a>
	</div>
	<div class="col-xs-12 text-center" style="padding:30px 0 20px;">
        <div id="google_translate_element"></div>
        <script type="text/javascript">function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');}</script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>      
    </div>  
</footer>
[[$helpSlidein]]
