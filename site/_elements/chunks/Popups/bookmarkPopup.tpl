<div id="bookmarkPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			[[++bookmark_content_text]]
			<form class="standard">
			    <p class="fieldLabel">[[!%asi.title_brief_description? &topic=`default` &namespace=`asi`]]</p>
				<input type="hidden" data-populate="save_bookmark_name" value="[[!+search_result.title_value:striptags]]" />
				<input type="hidden" data-populate="save_bookmark_type" value="archive" />
				<input type="hidden" data-populate="save_bookmark_id" value="[[!+search_result.id]]" />
				<input type="hidden" data-populate="save_bookmark_params" value="[[!+search_result.params_json_escaped]]" />
			    <div class="inputWrapper">
			        <input type="text" name="description" data-populate="save_bookmark_description" placeholder="[[!%asi.input_ph_brief_description? &topic=`input` &namespace=`asi`]]" value="[[!+search_result.title_value:striptags]]">
			    </div>
			    <p class="fieldLabel">[[!%asi.title_content_summary? &topic=`default` &namespace=`asi`]]</p>
			    <div class="contentDropdown iconList">
			        [[-
					<div class="title">
			            <i class="fas fa-file"></i><strong>[[!%asi.title_title? &topic=`default` &namespace=`asi`]]:</strong> [[!+search_result.title_value:striptags]]
			        </div>
					]]
					
						[[!+search_result.params_html]]
			    </div>
            </form>
			<h4>[[!%asi.title_would_you_also_like_add_bookmark_to_collection? &topic=`default` &namespace=`asi`]]</h4>
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
                        <div class="inner">
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
			<a data-control="save_bookmark" class="button pink large full switchModals" [[-href="#bookmarkAddedPopup"]]>[[!%asi.title_bookmark_content? &topic=`default` &namespace=`asi`]]</a>
		</div>
	</div>
</div>

<div id="bookmarkAddedPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    [[++added_to_bookmark_text]]
			    <a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_page? &topic=`actions` &namespace=`asi`]]</a>
			    <a class="button pink" href="[[~[[BabelTranslation:default=`73`? &contextKey=`[[+contextKey]]` &resourceId=`73`]]]]#bookmarks">[[!%asi.action_view_my_bookmarks? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>