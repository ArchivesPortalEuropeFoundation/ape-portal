[[*extraSnippets]]<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

<section id="innerHero">
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[*heroTitle:notempty=`[[*heroTitle]]`:default=`[[*pagetitle]]`]]</h1>
            [[*heroText]]
            [[*heroShowPublished:is=`yes`:then=`<span class="date">[[*publishedon:strtotime:date=`%d-%m-%Y`]]</span>`]]
        </div>
        <div class="buttons">
            <a class="button blue visible-xs toggleSlideUp" href="#optionsSlideUp"><i class="fas fa-cogs"></i></a>
           [[- <a class="button blue hidden-xs" href="#bookmarkPopup" data-toggle="modal"><i class="fas fa-bookmark"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
            <a class="button blue hidden-xs" href="#suggestionPopup" data-toggle="modal"><i class="fas fa-pencil"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
            <a class="button blue aLink hidden-xs" href="#contactInstitution"><i class="fas fa-comment"></i> [[!%asi.action_contact_institution? &topic=`actions` &namespace=`asi`]]</a>
            <div class="buttonDropdown">
                <a class="button blue"><i class="fas fa-share-alt"></i><span class="hidden-xs"> [[!%asi.tools_share? &topic=`default` &namespace=`asi`]]</span></a>
                <div class="inner">
                    <a href="[[++sharing_facebook]]" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
                    <a href="[[++sharing_twitter]]" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                    <a href="[[++sharing_linkedin]]" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
                    <a href="[[++site_url]][[~[[*id]]]]" class="copyUrl"><i class="fas fa-link"></i> <span>[[!%asi.tools_copy_link? &topic=`default` &namespace=`asi`]]</span></a>
                </div>
            </div>
            [[-<div class="buttonDropdown">
                <a class="button blue"><i class="fas fa-download"></i><span class="hidden-xs"> [[!%asi.tools_download_link? &topic=`default` &namespace=`asi`]]</span></a>
                <div class="inner">
                    <a><i class="fas fa-file-download"></i> [[!%asi.action_download_pdf? &topic=`actions` &namespace=`asi`]]</a>
                    <a><i class="fas fa-file-export"></i> [[!%asi.tools_export? &topic=`default` &namespace=`asi`]]</a>
                    <a href="#" onclick="window.print();"><i class="fas fa-print"></i> [[!%asi.tools_print? &topic=`default` &namespace=`asi`]]</a>
                </div>
            </div>]]
        </div>
    </div>
</section>

<section class="noTopMargin">
    <div class="container">
        [[*docTopContent:notempty=`
        <div class="content text-center">
            [[*docTopContent]]
        </div>
        `]]
        [[getImageList?
          &tvname=`docGallery`
          &tpl=`docGalleryTpl`
          &toPlaceholder=`docGallery`
        ]]
        [[+docGallery:notempty=`
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="galleryContainer">
                    <span class="galleryCounter">0/0</span>
                    <div id="documentGallerySlider">
                        [[+docGallery]]
                        <!--<div class="slide">
                            <img class="image" id="zoom_99" data-zoom-image="uploads/test-images/zoom_test.jpg" src="uploads/test-images/zoom_test.jpg">
                        </div>-->
                    </div>
                    <div id="documentCaptionSlider">
                        [[getImageList?
                          &tvname=`docGallery`
                          &tpl=`docGalleryInfoTpl`
                        ]]
                        <!--<div class="slide">
                            <div class="caption">
                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                            </div>
                            <div class="icons">
                                
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
            <!--div id="zoomContainer"></div-->
        </div>
        `:default=`<div class="mb30"></div>`]]
        [[*docTopContent:notempty=`
        <div class="content text-center">
            [[*docBottomContent]]
            [[*docContentButton:calltoactiontv=`ctaTVButtonPinkTpl`]]
        </div>
        `]]
    </div>
</section>

<section class="standard">
    <div class="container">
        <a class="anchor" id="rateContent"></a>
        <h2 class="iconTitle"><i class="fas fa-thumbs-up"></i> [[!%asi.action_rate_this_content? &topic=`actions` &namespace=`asi`]]</h2>
                
[[!FormIt?
   &hooks=`reCaptchaV3,email,FormItSaveForm`
   &emailTpl=`allFormMessage`
   &emailSubject=`Content Rating (Topics|Highlights) - [[*pagetitle]]`
   &emailTo=`[[++contact_email]]`
   &emailFrom=`[[++contact_email]]`
   &formName=`Content Rating (Topics|Highlights) - [[*pagetitle]]`
   &formFields=`rating,feedback`
   &fieldNames=`rating==Rating,feedback==Feedback (if any)`
   &successMessage=`[[!%asi.form_rating_success_msg? &topic=`forms` &namespace=`asi`]]`
   &submitVar=`sendRating`
   &validate=`confirmHSL:blank`
]]
[[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
        [[!+fi.successMessage:notempty=`<h5>[[+fi.successMessage]]</h5>`:default=`
        [[++rate_content_text]]
        <div class="row">
            <div class="col-md-7">    
                <form class="standard mt20" id="rateForm" action="[[!requestURI]]#rateContent" method="post">
                    <input type="hidden" name="emailTitle" value="Content (Topics|Highlights) has been rated">
                    <input type="text" name="confirmHSL" class="confirmField" value="">
                    <div class="rating">
                        <input type="radio" name="rating" value="Good" class="good">
                        <input type="radio" name="rating" value="Neutral" class="neutral">
                        <input type="radio" name="rating" value="Bad" class="bad">
                    </div>
                    <div class="hiddenContent">
                        <div class="title"><strong>[[!%asi.action_add_feedback? &topic=`actions` &namespace=`asi`]]</strong> <i class="far fa-angle-down"></i></div>
                        <div class="inner">
                            <div class="inputWrapper">
                                <textarea name="feedback" placeholder="[[!%asi.input_your_feedback? &topic=`input` &namespace=`asi`]]"></textarea>
                            </div>
                        </div>
                    </div>
                    <input class="disabled" type="submit" name="sendRating" value="[[!%asi.action_send_rating? &topic=`actions` &namespace=`asi`]]">
                </form>
            </div>
        </div>
        `]]
    </div>
</section>

<section class="standard">
    <div class="container">
        <a class="anchor" id="contactInstitution"></a>
        <h2 class="iconTitle"><i class="fas fa-comment"></i> [[!%asi.action_contact_this_institution? &topic=`actions` &namespace=`asi`]]</h2>
        [[++contact_institution_text]]
        <div class="row">
            <div class="col-md-7">
                
[[!FormIt?
   &hooks=`reCaptchaV3,email,FormItSaveForm,redirect`
   &emailTpl=`allFormMessage`
   &emailSubject=`Contact Form (Topics|Highlights) - [[*pagetitle]]`
   &emailTo=`[[++contact_email]]`
   &emailFrom=`[[++contact_email]]`
   &formName=`Contact Form (Topics|Highlights) - [[*pagetitle]]`
   &formFields=`name,email,message`
   &fieldNames=`name==Full name,email==Email address,message==Message`
   &redirectTo=`24`
   &submitVar=`contactInstitution`
   &validate=`confirmHSL:blank`
]]                
                [[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
                <form class="standard mt20" action="[[!requestURI]]" method="post">
                    <input type="hidden" name="emailTitle" value="A new message from the APE website">
                    <input type="text" name="confirmHSL" class="confirmField" value="">
                    <p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!%asi.form_required_fields_empty_err_msg? &topic=`forms` &namespace=`asi`]]</p>
                    <p class="fieldLabel">[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*</p>
                    <div class="inputWrapper required">
                        <input type="text" name="name" placeholder="[[!%asi.input_ph_full_name? &topic=`label` &namespace=`asi`]]">
                        <span class="errorMessage">[[!%asi.form_full_name_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                    </div>
                     <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
                    <div class="inputWrapper required">
                        <input type="text" name="email" placeholder="[[!%asi.input_ph_email_address? &topic=`input` &namespace=`asi`]]">
                        <span class="errorMessage">[[!%asi.form_email_address_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                    </div>
                    <p class="fieldLabel">[[!%asi.label_your_message? &topic=`label` &namespace=`asi`]]*</p>
                    <div class="inputWrapper required">
                        <textarea class="tall" name="message" placeholder="[[!%asi.input_ph_your_message? &topic=`input` &namespace=`asi`]]"></textarea>
                        <span class="errorMessage">[[!%asi.form_message_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                    </div>
                   [[- <div class="checkbox">
                        <input type="checkbox" name="translate" value="1">
                        <span>[[!%asi.label_translate_to? &topic=`label` &namespace=`asi`]]:</span>
                        <div class="tipSelect">
                            <div class="selectDropdown">
                                <div class="title">[[!%asi.eng? &topic=`language` &namespace=`asi`]]</div>
    							<div class="inner">
    								<a href="#">[[!%asi.fra? &topic=`language` &namespace=`asi`]]</a>
    								<a href="#">[[!%asi.ger? &topic=`language` &namespace=`asi`]]</a>
    								<a href="#">[[!%asi.spa? &topic=`language` &namespace=`asi`]]</a>
    							</div>
                            </div>
                            [[++contact_translate_tooltip:notempty=`
    						<div class="tipIcon" data-tooltip-content="#contactTranslateTooltip">
	    						<i class="far fa-question-circle"></i>
		    				</div>
		    				`]]
                        </div>
                    </div>]]
                    <input type="submit" name="contactInstitution" value="[[!%asi.action_send_message? &topic=`actions` &namespace=`asi`]]">
                </form>
            </div>
        </div>
    </div>
</section>

<section class="standard reducedBottomSM">
    <div class="container">
        <div class="content text-center">
            <h2>[[!*fdTitle:default=`[[%asi.more_highlights? &topic=`default` &namespace=`asi`]]`]]</h2>
        </div>
		<div id="otherDocsSlider" class="linkBlockSlider inactive">
    	    [[pdoResources?
    	      [[*fdSource:is=`featured`:then=`&parents=`36``]]
    		  [[*fdSource:is=`topics`:then=`&parents=`37``]]
    		  [[*fdSource:is=`both`:then=`&parents=`36,37``]]
    		  &tpl=`linkBlockSlider60Tpl`
    		  &limit=`3`
    		  [[*fdOverride:notempty=`
    		  &resources=`[[*fdOverride]]`
    		  `:default=`
    		  &resources=`-[[*id]]`
    		  `]]
    		  &sortby=`{"publishedon":"DESC"}`
    		  &includeTVs=`heroTitle,refImage60,refText,refType`
    		  &processTVs=`refImage60`
    		]]			
		</div>
    </div>
</section>									
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$bookmarkPopup]]

[[$suggestionPopup]]

<div id="optionsSlideUp" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
   [[- <a class="toggleSlideUp" data-toggle="modal" href="#bookmarkPopup"><i class="fas fa-bookmark yellow"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
    <a class="toggleSlideUp" data-toggle="modal" href="#suggestionPopup"><i class="fas fa-pencil blue"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
    <a class="aLink toggleSlideUp" href="#contactInstitution"><i class="fas fa-comment pink"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
</div>

[[$scripts]]
[[!+ms.successMessage]]

<script src="https://cdn.jsdelivr.net/gh/igorlino/elevatezoom-plus@1.2.3/src/jquery.ez-plus.js"></script>
<script>
    $("#zoom_99").ezPlus({
      scrollZoom: true,
      zoomWindowPosition: '#zoomContainer'
    });
    $(".switchModals").click(function(e){
      $("#bookmarkPopup").modal('hide');
      setTimeout(function(){
        $("#bookmarkAddedPopup").modal('show');
      }, 800);
      e.preventDefault();
    });
</script>

	</body>
</html>
