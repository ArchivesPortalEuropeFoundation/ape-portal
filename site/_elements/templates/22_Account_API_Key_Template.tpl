<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$headerAccountTemp]]

<section id="innerHero"[[*heroAlign:is=`left`:then=` class="left"`]]>
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[*heroTitle:default=`[[*pagetitle]]`]]</h1>
            [[*heroText]]
        </div>
    </div>
</section>

<section class="standard">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="content">
                    [[#14.tv.apiContent]]
                </div>
            </div>
            <div class="col-md-6">
                <div class="apiBlock">
                    [[#14.tv.apiGetKey]]
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
                    [[#14.tv.apiShowKey]]
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
            [[#14.tv.faqsTitle:notempty=`<h2>[[#14.tv.faqsTitle]]</h2>`]]
            [[#14.tv.faqsText]]
        </div>
        <div class="row">
            [[getImageList?
              &docid=`14`
              &tvname=`faqs`
              &tpl=`faqsTpl`
            ]]
        </div>
</section>
	
[[$siblingButtons]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

	</body>
</html>