<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

[[$innerHero]]

<section class="standard">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="content">
                    [[*apiContent]]
                </div>
            </div>
            <div class="col-md-6">
                <div class="apiBlock">
                    [[*apiAccount]]
                    [[*apiAccountButton:calltoactiontv=`ctaTVButtonBlueTpl`]]
                </div>
                <div class="apiBlock">
                    [[*apiGetKey]]
                    <form class="standard">
                        <p class="fieldLabel">[[!%asi.website_url_use_api? &topic=`default` &namespace=`asi`]]</p>
                        <div class="inputWrapper">
                            <input type="text" name="url" placeholder="[[!%asi.input_ph_website_url? &topic=`input` &namespace=`asi`]]">
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="agreeTerms" value="Yes">
                            <span>[[!%asi.i_agree_to_terms_use? &topic=`default` &namespace=`asi`]]</span>
                        </div>
                        <input type="submit" class="disabled" value="[[!%asi.action_get_api_key? &topic=`actions` &namespace=`asi`]]">
                    </form>
                </div>
                <div class="apiBlock">
                    [[*apiShowKey]]
                    <h2 class="apiKey">API-KEY-APE-123-456-789</h2>
                    <a class="button blue large copyAPI">[[!%asi.action_copy_to_clipboard? &topic=`actions` &namespace=`asi`]]</a>
                    <p class="copied"><i class="fas fa-check"></i> [[!%asi.response_copied? &topic=`default` &namespace=`asi`]]</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="noBottomMargin">
    <div class="container">
        <div class="content text-center">
            [[*faqsTitle:notempty=`<h2>[[*faqsTitle]]</h2>`]]
            [[*faqsText]]
        </div>
        <div class="row">
            [[getImageList?
              &tvname=`faqs`
              &tpl=`faqsTpl`
            ]]
        </div>
</section>

[[*latestNewsShow:is=`yes`:then=`[[$blogSlider]]`]]

[[$siblingButtons]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

[[$blogSliderScript]]`

	</body>
</html>