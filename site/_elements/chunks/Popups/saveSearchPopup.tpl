<div id="saveSearchPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			[[++save_search_text]]
			<form class="standard">
			    <p class="fieldLabel">[[!%asi.label_name_of_search? &topic=`label` &namespace=`asi`]]</p>
			    <div class="inputWrapper">
			        <input data-populate="save_search_name" type="text" name="searchName" placeholder="[[!%asi.input_ph_name_of_search? &topic=`input` &namespace=`asi`]]">
			    </div>
				<p class="fieldLabel">[[!%asi.label_your_search? &topic=`label` &namespace=`asi`]]</p>
				<div class="inputWrapper">
					<input data-populate="save_search_term" type="text" name="searchTerm" placeholder="[[!%asi.input_ph_name_of_search? &topic=`input` &namespace=`asi`]]">
				</div>
			    <p class="fieldLabel">[[!%asi.title_brief_description? &topic=`default` &namespace=`asi`]]</p>
			    <div class="inputWrapper">
			        <input data-populate="save_search_description" type="text" name="description" placeholder="[[!%asi.input_ph_brief_description? &topic=`input` &namespace=`asi`]]">
			    </div>
			    <p class="fieldLabel">[[!%asi.label_search_parameters? &topic=`label` &namespace=`asi`]]</p>
			    <div class="contentDropdown iconList">
			        <div class="title">
						<strong>[[!%asi.title_search_type? &topic=`default` &namespace=`asi`]]:</strong> <span id="document_type">[[!%asi.title_in_archives? &topic=`default` &namespace=`asi`]]</span>
			        </div>
			        <div class="inner" data-populate="save_search_parameters">
			            
			        </div>
			    </div>
            </form>
			<h4>[[!%asi.title_like_add_search_to_collection? &topic=`default` &namespace=`asi`]]</h4>
			<div class="contentDropdown large addTo">
			    <div class="title">
			        <h5>[[!%asi.title_add_to_collection? &topic=`default` &namespace=`asi`]]</h5>
                </div>
			    <div class="inner">
			        <form class="searchLight">
                        <div class="inputWrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" placeholder="[[!%asi.input_ph_find_collection? &topic=`input` &namespace=`asi`]]">
                        </div>
                    </form>
                    <form class="standard" data-populate="collection_list">

                    </form>
                    <div class="createCollection">
                        <h5><i class="fas fa-plus"></i> [[!%asi.title_or_create_new_collection? &topic=`default` &namespace=`asi`]]</h5>
                        <div class="inner" style="display:none">
                            <form class="inlineSubmit sub200">
                                <p class="strongLabel">[[!%asi.label_new_collection_name? &topic=`label` &namespace=`asi`]]</p>
                                <div class="inputWrapper">
                                    <input data-populate="save_collection_name" type="text" name="collectionName" placeholder="[[!%asi.input_ph_new_collection_name? &topic=`input` &namespace=`asi`]]">
                                    <input data-control="save_collection" class="hidden-xs" type="submit" value="[[!%asi.action_create_new_collection? &topic=`actions` &namespace=`asi`]]">
                                    <input data-control="save_collection" class="visible-xs" type="submit" value="[[!%asi.action_create? &topic=`actions` &namespace=`asi`]]">
                                </div>
                                <span data-feedback="save_collection_success" class="success"></span>
                            </form>
                        </div>
                    </div>
			    </div>
			</div>
			<a data-control="save_search" class="button pink large full switchModals" href="#searchSavedPopup">[[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
		</div>
	</div>
</div>

<div id="searchSavedPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    [[++search_saved_text]]
			    <a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_page? &topic=`actions` &namespace=`asi`]]</a>
			    <a class="button pink" href="[[~73]]#searches">[[!%asi.action_view_my_searches? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>