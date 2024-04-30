<div id="suggestionPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    [[++make_suggestion_text]]
			    <div class="tipTitle">
			        <div class="tipIcon" data-tooltip-content="#suggestionTooltip">
						<i class="far fa-question-circle"></i>
					</div>
					<p><strong>[[!%asi.title_what_would_you_like_to_do? &topic=`default` &namespace=`asi`]]</strong></p>
			    </div>
			    <div class="buttons" id="setRecipient">
			        <a class="button whiteBlue border toggle active" id="toTopic">[[!%asi.action_assign_to_topic? &topic=`actions` &namespace=`asi`]]</a>
				    <a class="button whiteBlue border toggle" id="toTranslation">[[!%asi.action_suggest_translation? &topic=`actions` &namespace=`asi`]]</a>
				    <a class="button whiteBlue border toggle" id="toConnect">[[!%asi.action_connect_to_another_resource? &topic=`actions` &namespace=`asi`]]</a>
				    <a class="button whiteBlue border toggle" id="toOther">[[!%asi.action_other? &topic=`actions` &namespace=`asi`]]</a>
			    </div>
			</div>

			[[!FormIt?
			&hooks=`reCaptchaV3,FormItSaveForm,email`
			&emailTpl=`allFormMessage`
			&emailSubject=`Make a Suggestion`
			&emailUseFieldForSubject=`1`
			&emailTo=`[[!+result_type:is=``:then=`[[!+suggestion_form_explore_to]]`:else=`[[!+suggestion_form_detail_page_to]]`]]`
			&emailCC=`[[!+result_type:is=``:then=`[[!+suggestion_form_explore_cc]]`:else=`[[!+suggestion_form_detail_page_cc]]`]]`
			&emailBCC=`[[!+result_type:is=``:then=`[[!+suggestion_form_explore_bcc]]`:else=`[[!+suggestion_form_detail_page_cc]]`]]`
[[-         &emailFrom=`[[++contact_email]]` ]]
			&formName=`Make a Suggestion ([[!+result_type:is=``:then=`[[!+result_type_explore]]`:else=`[[!+result_type]]`]])`
			&formFields=`name,email,suggestion,recipient,resulttype,repositoryCode,recordid,clevelid,unitid,resourceid`
			&fieldNames=`name==Full name,email==Email address,suggestion==Suggestion,recipient==Recipient,repositoryCode=RepositoryCode,resulttype=Result Type,recordid=Record ID,unitid=UnitId,clevelid=CLevelId,resourceid=Resource Id`
			&submitVar=`makeSuggestion`
			&successMessagePlaceholder=`ms.successMessage`
			&successMessage=`<script>$("#suggestionMadePopup").modal('show');</script>`
			&validate=`suggestion:allowTags:allowSpecialChars,confirmHSL:blank`
			&validationErrorMessage=`[[!%asi.form_validation_error? &topic=`forms` &namespace=`asi`]]`
			]] 			
			[[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
			[[!+fi.validation_error_message:isnotempty=`<h5 style="color: #c92828;margin-bottom: 10px;">[[+fi.validation_error_message]]</h5>`]]
			<form class="standard" action="[[!+suggestion_request_uri]]" method="post" enctype="multipart/form-data">
				<input type="hidden" name="subject" value="[[++site_env:isequalto=`PROD`:then=``:else=`([[++site_env]]) `]]Make a Suggestion ([[!+result_type:is=``:then=`[[!+result_type_explore]]`:else=`[[!+result_type]]`]]): [[!+result_name:is=``:then=`[[!*pagetitle:striptags]]`:else=`[[!+result_name:striptags]]`]]"/>
                <input type="hidden" name="emailTitle" value="A suggestion has been made">
				<input type="hidden" name="resulttype" value="[[!+result_type:is=``:then=`[[!+result_type_explore]]`:else=`[[!+result_type]]`]]"/>
				<input type="hidden" name="recordid" value="[[!+result_record_id]]"/>
				<input type="hidden" name="clevelid" value="[[!+result_clevelid]]"/>
				<input type="hidden" name="unitid" value="[[!+result_unitid]]"/>
				<input type="hidden" name="repositoryCode" value="[[!+institution.repositoryCode]]"/>
				<input type="hidden" name="institutionLink" value="[[++site_url]]institution/aicode/[[!+institution.repositoryCode]]">
				<input type="hidden" name="resourceid" value="[[*id]]"/>
				<input type="text" name="confirmHSL" class="confirmField" value="">
			    <p class="fieldLabel">[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*</p>
			    <div class="inputWrapper required">
			        <input type="text" name="name" placeholder="[[!%asi.input_ph_full_name? &topic=`input` &namespace=`asi`]]" value="[[+user.fullname]]">
			        <span class="errorMessage">[[!%asi.form_full_name_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			    </div>
			    <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
			    <div class="inputWrapper required">
			        <input type="text" name="email" placeholder="[[!%asi.input_ph_email_address? &topic=`input` &namespace=`asi`]]" value="[[+user.email]]">
			        <span class="errorMessage">[[!%asi.form_email_address_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			    </div>
			    <p class="fieldLabel">[[!%asi.label_please_provide_details_on_your_suggestion? &topic=`label` &namespace=`asi`]]*</p>
			    <div class="inputWrapper requiredQuill">
			        <div id="suggestionMessage">Re. Ref: [[+search_result.reference_value]]
						[[+search_result.url]]

					</div>
			        <textarea name="suggestion" class="hidden"></textarea>
			        <span class="errorMessage">[[!%asi.form_a_suggestion_is_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			    </div>
			    <div class="uploadWrapper">
			        <label for="suggestionFile"><i class="fas fa-upload"></i> [[!%asi.label_upload_file? &topic=`label` &namespace=`asi`]] <span class="valid">(PDF, DOC or JPG - max 2MB)</span></label>
			        <input type="file" name="suggestionFile" id="suggestionFile" accept=".jpg,.doc,.docx,.pdf">
			        <span class="remove"><i class="fas fa-trash mr"></i> [[!%asi.action_delete_upload? &topic=`actions` &namespace=`asi`]]</span>
			        <span class="errorMessage">[[!%asi.form_upload_file_err_msg? &topic=`forms` &namespace=`asi`]]</span>
			    </div>
			    <div class="checkbox">
			        <input class="enableSubmit" type="checkbox" name="usage" value="1">
			        <span>[[++usage_content_text]]</span>
			    </div>
			    <input type="hidden" name="recipient" value="toTopic">
			    <input type="submit" name="makeSuggestion" class="disabled pink full" value="[[!%asi.action_send_suggestion? &topic=`actions` &namespace=`asi`]]">
				<input type="hidden" name="institution_id" value="[[!+search_result.institution_id]]" />
				<input type="hidden" name="form_type" value="SUGGEST" />
				<input type="hidden" name="form_location" value="GLOBAL_POPUP" />
			</form>
		</div>
	</div>
</div>

<div id="suggestionMadePopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    [[!%asi.form_suggestion_success_msg_full? &topic=`forms` &namespace=`asi`]]
			    <a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_page? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>

<div id="ratingSentPopup" class="modal fade">
	<div class="modal-dialog larger">
		<div class="modal-content standard">
			<span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
				[[!%asi.form_rating_success_msg_full? &topic=`forms` &namespace=`asi`]]
				<br/>
				<a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_page? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>

<div id="contactInstitutionSentPopup" class="modal fade">
	<div class="modal-dialog larger">
		<div class="modal-content standard">
			<span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
				[[!%asi.form_contact_institution_success_msg_full? &topic=`forms` &namespace=`asi`]]
				<a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_page? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>

<div id="ratingSentPopupExplore" class="modal fade">
	<div class="modal-dialog larger">
		<div class="modal-content standard">
			<span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
				[[!%asi.form_rating_success_msg_full_explore? &topic=`forms` &namespace=`asi`]]
				<br/>
				<a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_page? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>

<div id="contactInstitutionSentPopupExplore" class="modal fade">
	<div class="modal-dialog larger">
		<div class="modal-content standard">
			<span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
				[[!%asi.form_contact_institution_success_msg_full_explore? &topic=`forms` &namespace=`asi`]]
				<a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_page? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>
