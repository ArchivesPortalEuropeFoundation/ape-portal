<div id="welcomePopup" class="modal fade">
    <div class="modal-dialog full">
        <div class="modal-content standard">
			<div class="row greyHeader">
			    <div class="col-sm-7 col-md-5 col-lg-6">
			        <div class="content">
			            <h2>Welcome [[!getUserFirstName]]!</h2>
						[[!welcome_text]]
			        </div>
			    </div>
			    <div class="col-sm-5 col-md-7 col-lg-6">
			        <ul class="nav-tabs buttons mb0">
                		<li class="active"><a href="#tabTerms" data-toggle="tab"><span class="hidden-xs hidden-sm">01. [[!%asi.tab_ape_t_c_acceptance_lg? &topic=`default` &namespace=`asi`]]</span><span class="hidden-md hidden-lg">[[!%asi.tab_ape_t_c_acceptance_sm? &topic=`default` &namespace=`asi`]]</span></a></li>
                		<li class="next disabled"><a href="#tabSettings" data-toggle="tab"><span class="hidden-xs hidden-sm">02. [[!%asi.tab_settings_preferences_lg? &topic=`default` &namespace=`asi`]]</span><span class="hidden-md hidden-lg">[[!%asi.tab_settings_preferences_sm? &topic=`default` &namespace=`asi`]]</span></a></li>
    	            </ul>
			    </div>
			</div>
			<div class="tab-content">
			    <div class="tab-pane fade active in" id="tabTerms">
        			<h4>[[!%asi.title_please_agree_to_ape_t_c? &topic=`default` &namespace=`asi`]]</h4>
        			<div class="termsContainer">
        			    <div class="content">
            			    [[++welcome_terms]]
        			    </div>
        			</div>
        			<form class="standard clearfix">
        			    <a class="button blue nextTab disabled" href="#tabSettings" data-toggle="tab">[[!%asi.action_next? &topic=`actions` &namespace=`asi`]]</a>
        			    <div class="checkbox large">
        			        <input type="checkbox" name="welcomeTerms" value="yes">
        			        <span>[[!%asi.label_i_agree_to_t_c? &topic=`label` &namespace=`asi`]]</span>
        			    </div>
        			</form>
			    </div>
			    <div class="tab-pane fade" id="tabSettings">
			        
[[!UpdateProfile?
  &postHooks=`changePasswordHook`
  &allowedExtendedFields=`userpref_newsletter,userpref_materials,userpref_updates,userpref_language,new_user`
  &placeholderPrefix=`up.`
  &submitVar=`saveProfile`
]]
			        
			        <form class="standard" action="[[~[[*id]]]]" method="post">
			            <div class="content">
    			            [[++welcome_settings]]
			            </div>
        			    <div class="row">
        			        <div class="col-sm-4">
        			            <div class="checkbox pref">
        			                <input type="hidden" name="userpref_newsletter" value="">
        			                <input type="checkbox" name="userpref_newsletter" value="yes"><span>[[!%asi.label_newsletter? &topic=`communications` &namespace=`asi`]]</span>
                                    <p>[[++account_settings_newsletter]]</p>
        			            </div>
        			        </div>
        			        <div class="col-sm-4">
        			            <div class="checkbox pref">
        			                <input type="hidden" name="userpref_materials" value="">
        			                <input type="checkbox" name="userpref_materials" value="yes"><span>[[!%asi.label_researcher_materials? &topic=`communications` &namespace=`asi`]]</span>
                                    <p>[[++account_settings_research]]</p>
        			            </div>
        			        </div>
        			        <div class="col-sm-4">
        			            <div class="checkbox pref">
        			                <input type="hidden" name="userpref_updates" value="">
        			                <input type="checkbox" name="userpref_updates" value="yes"><span>[[!%asi.label_updates_to_saved_content? &topic=`communications` &namespace=`asi`]]</span>
                                    <p>[[++account_settings_content]]</p>
        			            </div>
        			        </div>
                        </div>
			            <hr>
			            <div class="content mb20">
    			            <h4>[[!%asi.title_choose_a_secure_pwd? &topic=`default` &namespace=`asi`]]</h4>
    			            [[++welcome_password]]
			            </div>
			            <div class="row">
			                <div class="col-sm-6">
			                    <p class="fieldLabel">[[!%asi.label_new_password? &topic=`label` &namespace=`asi`]]*</p>
			                    <div class="inputWrapper required">
			                        <input type="password" id="newPassword" name="new_password" placeholder="[[!%asi.input_ph_new_password? &topic=`input` &namespace=`asi`]]">
			                        <span class="errorMessage">[[!%asi.input_new_pwd_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			                        <span class="errorMessageMatch">[[!%asi.input_pwd_not_match_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			                        <span class="errorMessageInvalid">[[!%asi.input_pwd_not_meet_req_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			                    </div>
			                </div>
			                <div class="col-sm-6">
			                    <p class="fieldLabel">[[!%asi.label_confirm_new_password? &topic=`label` &namespace=`asi`]]*</p>
			                    <div class="inputWrapper required">
			                        <input type="password" id="confirmPassword" name="confirm_password" placeholder="[[!%asi.input_ph_confirm_new_password? &topic=`input` &namespace=`asi`]]">
			                        <span class="errorMessage">[[!%asi.input_pwd_must_confirm_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			                        <span class="errorMessageMatch">[[!%asi.input_pwd_not_match_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			                    </div>
			                </div>
			            </div>
			            <hr class="mt10">
			            <div class="row">
			                <div class="col-sm-6">
        			            <div class="content mb20">
        			                <h4>[[!%asi.title_q_preferred_lang? &topic=`default` &namespace=`asi`]]</h4>
        			            </div>
        			            <p class="fieldLabel">[[!%asi.label_lang_preference? &topic=`label` &namespace=`asi`]]</p>
        			            <div class="selectWrapper required">
                                    <select name="userpref_language">
                                        <option value="">[[!%asi.input_please_choose? &topic=`input` &namespace=`asi`]]</option>
                                        <option value="English">[[!%asi.eng? &topic=`language` &namespace=`asi`]]</option>
                                        <option value="French">[[!%asi.fra? &topic=`language` &namespace=`asi`]]</option>
                                        <option value="German">[[!%asi.ger? &topic=`language` &namespace=`asi`]]</option>
                                    </select>
                                    <span class="errorMessage">[[!%asi.input_choose_preferred_lang? &topic=`forms` &namespace=`asi`]]</span>
                                </div>
			                </div>
			                <div class="col-sm-6">
			                    <input type="hidden" name="new_user" value="no">
			                    <input type="submit" class="blue toAccount" name="saveProfile" value="[[!%asi.action_save_go_to_account? &topic=`actions` &namespace=`asi`]]">
			                </div>
			            </div>
			        </form>
			    </div>
			</div>
		</div>
	</div>
</div>