<div id="deleteConfirmPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
                [[++confirm_delete_text]]
			    <a class="button pink" data-dismiss="modal" data-control-delete-confirm>[[!%asi.label_yes? &topic=`label` &namespace=`asi`]]</a>
			    <a class="button pink" data-dismiss="modal">[[!%asi.label_no? &topic=`label` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>

<div id="deleteConfirmOptionPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    <h2>[[!%asi.title_you_are_about_to_remove_this_item? &topic=`default` &namespace=`asi`]]</h2>
			    <p>[[!%asi.confirm_msg_you_are_about_to_remove_this_item? &topic=`default` &namespace=`asi`]]</p>
			    <form class="standard">
			        <div class="checkbox">
			            <input data-trigger="remove_delete_confirm" type="checkbox" name="confirm" value="No"><span><strong>[[!%asi.input_do_not_ask_confirm_again? &topic=`input` &namespace=`asi`]]</strong></span>
			        </div>
			    </form>
			    <a class="button pink" data-dismiss="modal" data-trigger="remove_collection_item_delete_confirm">[[!%asi.action_remove? &topic=`actions` &namespace=`asi`]]</a>
			    <a data-dismiss="modal" class="cancel"><i class="far fa-times mr"></i> <strong>[[!%asi.action_cancel? &topic=`actions` &namespace=`asi`]]</strong></a>
			</div>
		</div>
	</div>
</div>

<div id="viewParamsPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    <h2>[[!%asi.title_saved_search? &topic=`default` &namespace=`asi`]]</h2>
                <div data-populate="popup_search_params"></div>
    			<div class="mt30">
    	            <a class="button pink" href="#" data-populate="search_results_url"><i class="fas fa-eye mr"></i> [[!%asi.action_view_results? &topic=`actions` &namespace=`asi`]]</a>
    	            <a class="button pink" href="#" data-populate="search_new_results_url"><i class="fas fa-pink mr"></i> [[!%asi.action_view_new_results? &topic=`actions` &namespace=`asi`]]</a>
    	        </div>
			</div>
		</div>
	</div>
</div>