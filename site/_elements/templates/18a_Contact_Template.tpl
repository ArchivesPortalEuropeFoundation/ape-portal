<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
        <style>
            .tipSelect {
                padding-right: 40px!important;
            }
        </style>
	</head>
	<body>
[[$header]]

<section class="standard">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                [[$breadcrumbs]]
                <div class="content">
                    <h1>[[*heroTitle:notempty=`[[*heroTitle]]`:default=`[[*pagetitle]]`]]</h1>
                    [[*heroText]]
                </div>
                <div class="ctaBlockPink">
                    <div class="content">
                        [[*contactHelpText]]
                        <a class="button blue border toggleHelp">[[*contactHelpButton]]</a>
                    </div>
                </div>
                <div class="contactSocial">
			        <h5>[[!%asi.title_follow_us? &topic=`default` &namespace=`asi`]]:</h5>
			        [[$socialLinks]]
		        </div>
            </div>
            <div class="col-md-7">
                <div class="contactBlock">
                    <h3 class="mb20">[[!%asi.title_send_us_your_enquiry? &topic=`default` &namespace=`asi`]]</h3>
                    [[!FormIt?
                        &hooks=`reCaptchaV3,spam,email,FormItSaveForm,redirect`
                        &emailTpl=`allFormMessage`
                        &emailUseFieldForSubject=`1`
                        &emailTo=`[[++contact_email]]`
[[-                     &emailFrom=`[[++contact_email]]` ]]
                        &formName=`Contact Us`
                        &formFields=`name,email,subject,message`
                        &fieldNames=`name==Full name,email==Email address,subject==Topic,message==Message`
                        &validate=`name:required,subject:required,email:email:required,:message:required:confirmHSL:blank`
                        &redirectTo=`24`
                        &submitVar=`contactForm`
                        &validationErrorMessage=`[[!%asi.form_validation_error? &topic=`forms` &namespace=`asi`]]`
                    ]]
                    [[!+fi.error.captcha:isnotempty=`<h5 style="color: #c92828;margin-bottom: 10px;">[[+fi.error.captcha]]</h5>`]]
                    [[!+fi.validation_error_message:isnotempty=`<h5 style="color: #c92828;margin-bottom: 10px;">[[+fi.validation_error_message]]</h5>`]]
                    <form class="standard" action="[[~[[*id]]]]" method="post">
                        <div class="conf_email hidden">
                            <input type="text" name="confirmHSL" class="confirmField" >
                        </div>
                        <p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!%asi.form_required_fields_empty_err_msg? &topic=`forms` &namespace=`asi`]]</p>
                        <p class="fieldLabel">[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*</p>
                        <div class="inputWrapper required">
                            <input type="text" name="name" placeholder="[[!%asi.input_ph_full_name? &topic=`input` &namespace=`asi`]]" value="[[+fi.name]]">
                            <span class="errorMessage">[[!%asi.form_full_name_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                        </div>
                        <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
                        <div class="inputWrapper required">
                            <input type="text" name="email" placeholder="[[!%asi.input_ph_email_address? &topic=`input` &namespace=`asi`]]" value="[[+fi.email]]">
                            <span class="errorMessage">[[!%asi.form_email_address_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                        </div>
                        <p class="fieldLabel">[[!%asi.label_topic? &topic=`label` &namespace=`asi`]]*</p>
                        <div class="selectWrapper required">
                            <select name="subject">
                                <option value="">[[!%asi.input_please_choose? &topic=`input` &namespace=`asi`]]</option>
                                [[getImageList?
                                  &tvname=`contactTopics`
                                  &tpl=`contactTopicsTpl`
                                ]]
                            </select>
                            <span class="errorMessage">[[!%asi.form_topic_choose_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                        </div>
                        <p class="fieldLabel">[[!%asi.label_your_message? &topic=`label` &namespace=`asi`]]*</p>
                        <div class="inputWrapper required">
                            <textarea class="tall" name="message" placeholder="[[!%asi.input_ph_your_message? &topic=`input` &namespace=`asi`]]">[[+fi.message]]</textarea>
                            <span class="errorMessage">[[!%asi.form_message_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                        </div>
                        [[- Justin - Commented out Translation option until phase 2
                        <div class="checkbox">
                            <input type="checkbox" name="translate" value="1">
                            <span>[[!%asi.label_translate_to? &topic=`label` &namespace=`asi`]]:</span>
                            <div class="tipSelect">
                                <select class="selectDropdown form-control">
                                    <option value="eng">[[!%asi.eng? &topic=`language` &namespace=`asi`]]</option>
                                    <option value="fra">[[!%asi.fra? &topic=`language` &namespace=`asi`]]</option>
                                    <option value="ger">[[!%asi.ger? &topic=`language` &namespace=`asi`]]</option>
                                    <option value="spa">[[!%asi.spa? &topic=`language` &namespace=`asi`]]</option>
                                </select>
                                [[++contact_translate_tooltip:notempty=`
        						<div class="tipIcon" data-tooltip-content="#contactTranslateTooltip">
    	    						<i class="far fa-question-circle"></i>
    		    				</div>
    		    				`]]
                            </div>
                        </div>
                        ]]
                        <input type="submit" name="contactForm" value="[[!%asi.action_send_message? &topic=`actions` &namespace=`asi`]]">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

	</body>
</html>
