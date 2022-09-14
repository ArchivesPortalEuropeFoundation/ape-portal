<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

<section class="halfTopMargin">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                [[$breadcrumbs]]
                <div class="content checkmarkUL">
                    [[*createAccountLeft]]
                    [[*createAccountButton:calltoactiontv=`ctaTVButtonPinkTpl`]]
                </div>
            </div>
            <div class="col-md-7">
                
[[!Register?
  &activationResourceId=`127`
  &activationEmailTpl=`loginRegisterEmailTpl`
  &generatePassword=`1`
  &usergroups=`Registered User`
  &usernameField=`email`
  &submitVar=`createAccount`
  &submittedResourceId=`137`
]]                
                
                <form class="standard signup" action="[[~[[*id]]]]" method="post">
                    [[*createAccountRight]]
                    <p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!%asi.form_required_fields_empty_err_msg? &topic=`forms` &namespace=`asi`]]</p>
                    <div class="registerMessage">[[+error.message]]</div>
                    <p class="fieldLabel">[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*</p>
                    <div class="inputWrapper required">
                        <input type="text" name="fullname" placeholder="[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*">
                        <span class="errorMessage">[[!%asi.form_full_name_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                    </div>
                    <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
                    <div class="inputWrapper required">
                        <input type="text" name="email" placeholder="[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*">
                        <span class="errorMessage">[[!%asi.form_email_address_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                    </div>
                    <input type="hidden" name="password"value="123456">
                    <input type="hidden" name="new_user"value="yes">
                    <input type="hidden" name="userpref_language"value="">
                    <input type="hidden" name="userpref_newsletter"value="">
                    <input type="hidden" name="userpref_materials"value="">
                    <input type="hidden" name="userpref_updates"value="">
                    <input type="hidden" name="userpref_delete"value="">
                    <div class="checkbox">
                        <input type="checkbox" name="agreeTerms" value="yes"><span>[[!%asi.input_sign_up_agree_terms? &topic=`input` &namespace=`asi`]]</span>
                    </div>
                    <input type="submit" name="createAccount" value="[[!%asi.action_create_account? &topic=`actions` &namespace=`asi`]]" class="blue disabled">
                </form>
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