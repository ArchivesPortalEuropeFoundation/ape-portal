<div id="deleteAccountPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
				[[-
					// This needs to be controlled by an RTE on config
				]]
			    <h2>You're about to delete your account</h2>
			    <p>Are you sure? You'll lose the following:</p>
			    <ul>
			        <li>Saved content and relevant update notifications</li>
			        <li>Access to researcher materials</li>
			        <li>Access to your API key (resulting in loss of API use)</li>
			    </ul>
			</div>
			<form class="standard">
			    <div class="checkbox large">
			        <input type="checkbox" name="confirmDelete" value="yes"><span>[[!%asi.input_confirm_delete_my_account? &topic=`input` &namespace=`asi`]]</span>
			    </div>
			    <h5>[[!%asi.title_want_to_update_notification_preferences? &topic=`default` &namespace=`asi`]]</h5>
			    <div class="row">
			        <div class="col-sm-4">
			            <div class="checkbox pref">
			                <input type="checkbox" name="newsletter" value="yes"><span>[[!%asi.input_newsletter? &topic=`input` &namespace=`asi`]]</span>
                            <p>[[++account_settings_newsletter]]</p>
			            </div>
			        </div>
			        <div class="col-sm-4">
			            <div class="checkbox pref disabled">
			                <p class="accountOnly">[[!%asi.label_account_only? &topic=`label` &namespace=`asi`]]</p>
			                <input type="checkbox" name="materials" value="yes"><span>[[!%asi.input_researcher_materials? &topic=`input` &namespace=`asi`]]</span>
                            <p>[[++account_settings_research]]</p>
			            </div>
			        </div>
			        <div class="col-sm-4">
			            <div class="checkbox pref disabled">
			                <p class="accountOnly">[[!%asi.label_account_only? &topic=`label` &namespace=`asi`]]</p>
			                <input type="checkbox" name="updates" value="yes"><span>[[!%asi.input_updates_to_my_saved_content? &topic=`input` &namespace=`asi`]]</span>
                            <p>[[++account_settings_content]]</p>
			            </div>
			        </div>
			    </div>
			    <input type="submit" class="pink full disabled switchModals" value="[[!%asi.action_delete_my_account? &topic=`actions` &namespace=`asi`]]">
			</form>
		</div>
	</div>
</div>

<div id="accountDeletedPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content checkmarkUL">
			    <h2>[[!%asi.title_account_delete_success_title? &topic=`default` &namespace=`asi`]]</h2>
			    <p>[[!%asi.title_account_delete_success_msg? &topic=`default` &namespace=`asi`]]</p>
			    <a class="button pink" href="[[~1]]">[[!%asi.action_return_to_website? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>