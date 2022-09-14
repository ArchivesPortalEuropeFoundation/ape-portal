<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$headerAccountTemp]]

[[$innerHero]]

<style>
    form.standard.pref input.disabled {background-color: #AAA; cursor: not-allowed;}
    form.standard.pref .form_help_note {margin-top: 6px;}
    form.standard.pref .form_help_note a {text-decoration: underline;}
    form.standard.pref p.formError {display: block;}
    form.standard.pref p.formError span.error {position: static;}
</style>
	
<section class="halfBottomMargin">
    <div class="container">
        <ul class="nav-tabs buttons difM mb0">
    		<li class="active"><a href="#tab1" data-toggle="tab"><span class="hidden-xs">[[!%asi.settings_and_preferences? &topic=`default` &namespace=`asi`]]</span><span class="visible-xs">[[!%asi.helper_settings? &topic=`default` &namespace=`asi`]]</span></a></li>
    		<li><a href="#tab2" data-toggle="tab"><span class="hidden-xs">[[!%asi.change_password? &topic=`default` &namespace=`asi`]]</span><span class="visible-xs">[[!%asi.password? &topic=`default` &namespace=`asi`]]</span></a></a></li>
    	</ul>
    </div>
</section>

<div class="tab-content">
    
    <div class="tab-pane fade active in" id="tab1">
        <section class="standard">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        
[[!UpdateProfile?
  &postHooks=`updateLanguage`
  &allowedExtendedFields=`userpref_language,userpref_delete`
  &placeholderPrefix=`u1.`
  &reloadOnSuccess=`0`
  &successMsgPlaceholder=`u1.successMessage`
  &submitVar=`updateOne`
  &validate=`
  fullname:required,
  userpref_language:required`
]]
                        <form class="standard pref" action="[[~[[*id]]]]" method="post">
                            <h3>[[!%asi.form_title_personal_details? &topic=`forms` &namespace=`asi`]]</h3>
                            <p class="fieldLabel">[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*</p>
                            [[!+u1.error.fullname:neq=``:then=`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+u1.error.fullname]]</p>`]]
                            <div class="inputWrapper required">
                                <input type="text" name="fullname" value="[[+u1.fullname]]">
                            </div>
                            <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
                            [[!+u1.error.email:neq=``:then=`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+u1.error.email]]</p>`]]
                            <div class="inputWrapper">
                                <input data-alert="username_change" type="text" name="" value="[[+u1.email]]" disabled class="disabled">
                                <div class="content"><p class="form_help_note">[[!%asi.contact_admin_to_change_pwd? &topic=`default` &namespace=`asi`]]</p></div>
                            </div>
                            <p class="fieldLabel">[[!%asi.label_lang_preference? &topic=`label` &namespace=`asi`]]</p>
                            [[!+u1.error.userpref_language:neq=``:then=`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+u1.error.userpref_language]]</p>`]]
                            <div class="selectWrapper required">
                                <select name="userpref_language">
                                    <option value="">[[!%asi.input_please_choose? &topic=`input` &namespace=`asi`]]</option>
                                    <option value="English"[[!+u1.userpref_language:is=`English`:then=` selected`]]>[[!%asi.eng? &topic=`language` &namespace=`asi`]]</option>
                                    <option value="French"[[!+u1.userpref_language:is=`French`:then=` selected`]]>[[!%asi.fra? &topic=`language` &namespace=`asi`]]</option>
                                    <option value="German"[[!+u1.userpref_language:is=`German`:then=` selected`]]>[[!%asi.ger? &topic=`language` &namespace=`asi`]]</option>
                                </select>
                            </div>
                            <h3 class="mt60">[[!%asi.title_removing_from_collection? &topic=`default` &namespace=`asi`]]</h3>
                            <p>[[!%asi.label_confirm_before_removing_collection? &topic=`label` &namespace=`asi`]]</p>
                            [[!+u1.error.userpref_delete:neq=``:then=`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+u1.error.confirm]]</p>`]]
                            <div class="checkbox">
                                <input type="radio" name="userpref_delete" value="yes"[[!+u1.userpref_delete:eq=`yes`:then=` checked`]]><span>[[!%asi.label_yes? &topic=`label` &namespace=`asi`]]</span>
                                <input type="radio" name="userpref_delete" value="no" class="ml"[[!+u1.userpref_delete:neq=`yes`:then=` checked`]]><span>[[!%asi.label_no? &topic=`label` &namespace=`asi`]]</span>
                            </div>
                            <input type="submit" name="updateOne" value="[[!%asi.action_save_changes? &topic=`actions` &namespace=`asi`]]" class="blue mt10">
                            [[!+u1.successMessage:neq=``:then=`<span class="saved"><i class="fas fa-check mr"></i> [[!%asi.form_successfully_updated_success_msg? &topic=`forms` &namespace=`asi`]]</span>`]]
                        </form>
                    </div>
                    <div class="col-md-6">
                        
[[!UpdateProfile?
  &postHooks=`updateMailchimp`
  &allowedExtendedFields=`userpref_newsletter,userpref_materials,userpref_updates`
  &placeholderPrefix=`u2.`
  &reloadOnSuccess=`0`
  &successMsgPlaceholder=`u2.successMessage`
  &submitVar=`updateTwo`
]]
                        <div class="updprof-error">[[+u2.error.message]]</div>
                        <form class="standard notif" action="[[~[[*id]]]]" method="post">
                            <h4>[[!%asi.title_notification_preferences? &topic=`communications` &namespace=`asi`]]</h4>
                            <p>[[!%asi.confirm_receive_emails? &topic=`communications` &namespace=`asi`]]:</p>
                            <div class="checkbox">
                                <input type="hidden" name="userpref_newsletter" value="">
                                <input type="checkbox" name="userpref_newsletter" value="yes"[[!+u2.userpref_newsletter:is=`yes`:then=` checked`]]><span>[[!%asi.label_newsletter? &topic=`communications` &namespace=`asi`]]</span>
                                <p>[[++account_settings_newsletter]]</p>
                            </div>
                            <div class="checkbox">
                                <input type="hidden" name="userpref_materials" value="">
                                <input type="checkbox" name="userpref_materials" value="yes"[[!+u2.userpref_materials:is=`yes`:then=` checked`]]><span>[[!%asi.label_researcher_materials? &topic=`communications` &namespace=`asi`]]</span>
                                <p>[[++account_settings_research]]</p>
                            </div>
                            <div class="checkbox">
                                <input type="hidden" name="userpref_updates" value="">
                                <input type="checkbox" name="userpref_updates" value="yes"[[!+u2.userpref_updates:is=`yes`:then=` checked`]]><span>[[!%asi.label_updates_to_saved_content? &topic=`communications` &namespace=`asi`]]</span>
                                <p>[[++account_settings_content]]</p>
                            </div>
                            <input type="submit" name="updateTwo" value="Update" class="blue mt20">
                            [[!+u2.successMessage:neq=``:then=`<span class="saved"><i class="fas fa-check mr"></i> [[!%asi.form_successfully_updated_success_msg? &topic=`forms` &namespace=`asi`]]</span>`]]
                        </form>
                        <a class="deleteAccount" href="#deleteAccountPopup" data-toggle="modal"><i class="fas fa-user-slash"></i> [[!%asi.action_delete_my_action? &topic=`actions` &namespace=`asi`]]</a>
                    </div>
                </div>
            </div>
        </section>
    </div>        
    
    <div class="tab-pane fade" id="tab2">
        <section class="standard">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        [[!ChangePassword?
                        &submitVar=`change-password`
                        &placeholderPrefix=`cp.`
                        &validateOldPassword=`1`
                        &validate=`nospam:blank`
                        &reloadOnSuccess=`0`
                        ]]
                        [[!+cp.error_message:neq=``:then=`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+cp.error_message]]</p>`]]
                        <form class="standard pref" action="[[~[[*id]]]]#tab2" method="post">
                            <input type="hidden" name="nospam" value="" />
                            <p class="fieldLabel">[[!%asi.label_current_password? &topic=`label` &namespace=`asi`]]*</p>
                            [[!+cp.error.password_old:neq=``:then=`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+cp.error.password_old]]</p>`]]
                            <div class="inputWrapper required">
                                <input type="password" name="password_old" placeholder="[[!%asi.input_ph_current_password? &topic=`input` &namespace=`asi`]]">
                            </div>
                            <div class="mb30">
                                [[++welcome_password]]
                            </div>
                            <p class="fieldLabel">[[!%asi.label_new_password? &topic=`label` &namespace=`asi`]]*</p>
                            [[!+cp.error.password_new:neq=``:then=`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+cp.error.password_new]]</p>`]]
                            <div class="inputWrapper required">
                                <input type="password" name="password_new" placeholder="[[!%asi.input_ph_new_password? &topic=`input` &namespace=`asi`]]">
                            </div>
                            <p class="fieldLabel">[[!%asi.label_confirm_new_password? &topic=`label` &namespace=`asi`]]*</p>
                            [[!+cp.error.password_new_confirm:neq=``:then`<p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!+cp.error.password_new_confirm]]</p>`]]
                            <div class="inputWrapper required">
                                <input type="password" name="password_new_confirm" placeholder="[[!%asi.input_ph_confirm_new_password? &topic=`input` &namespace=`asi`]]">
                            </div>
                            <input type="submit" value="[[!%asi.action_change_password? &topic=`actions` &namespace=`asi`]]" name="change-password" class="blue mt10">
                            [[!+cp.successMessage:neq=``:then=`<span class="saved"><i class="fas fa-check mr"></i> [[!%asi.msg_successfully_changed? &topic=`default` &namespace=`asi`]]</span>`]]
                        </form>
                    </div>
                </div>
            </div>
        </section>
</div>
		
[[$siblingButtons]]		
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$deleteAccountPopup]]

[[$scripts]]

<script>
    
    $('i.editIcon, i.confirm, i.cancel').click(function() {
       $(this).parents('.item').find('.editField').toggleClass('open');
    });
    
    $(".switchModals").click(function(e){
      $("#deleteAccountPopup").modal('hide');
      setTimeout(function(){
        $("#accountDeletedPopup").modal('show');
      }, 800);
      e.preventDefault();
    });

    $(document).ready(function(){
        var hash = window.location.hash.substr(1);

        console.log(hash);
        if(hash == "tab2") {
            console.log('opening tab 2...');
            $('a[href="#tab2"]').tab('show');
        }
    });
    
</script>

	</body>
</html>