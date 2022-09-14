<div id="addCollectionPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard savePopup">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			[[++add_collection_search_text]]
			[[-add_collection_bookmark_text]]
			<div class="contentDropdown large addTo open disabled mt30">
			    <div class="title">
			        <h5>[[!%asi.title_choose_a_collection? &topic=`default` &namespace=`asi`]]</h5>
                </div>
			    <div class="inner" style="display: block;">
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
                        <div class="inner" style="display: none;">
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
            <a data-control="save_item_to_collection" data-search-id="" class="button pink large full switchModals" href="#searchSavedPopup">[[!%asi.action_add_saved_search_bkmrk_to_collection? &topic=`actions` &namespace=`asi`]]</a>
		</div>
	</div>
</div>

<div id="addCollection2Popup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard savePopup">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			[[++add_collection_search2_text]]
			[[-add_collection_bookmark2_text]]
            <div class="createCollection">
                <h5><i class="fas fa-plus"></i> [[!%asi.title_create_a_new_collection? &topic=`default` &namespace=`asi`]]</h5>
                <div class="inner">
                    <form class="inlineSubmit sub200">
                        <p class="strongLabel">[[!%asi.label_new_collection_name? &topic=`label` &namespace=`asi`]]</p>
                        <div class="inputWrapper">
                            <input type="text" name="collectionName" placeholder="[[!%asi.input_ph_new_collection_name? &topic=`input` &namespace=`asi`]]">
                            <input class="hidden-xs" type="submit" value="[[!%asi.action_create_new_collection? &topic=`actions` &namespace=`asi`]]">
                            <input class="visible-xs" type="submit" value="[[!%asi.action_create? &topic=`actions` &namespace=`asi`]]">
                        </div>
                        <span class="success"><i class="fas fa-check mr"></i> [[!%asi.msg_new_collection_created? &topic=`default` &namespace=`asi`]]:<br class="visible-xs"> Collection name here</span>
                    </form>
                </div>
            </div>
			<a class="button pink large full switchModals" href="#searchSavedPopup">[[!%asi.action_add_saved_search_to_new_collection? &topic=`actions` &namespace=`asi`]]</a>
		</div>
	</div>
</div>

<div id="addCollection3Popup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard savePopup">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			[[++add_collection_search3_text]]
			[[-add_collection_bookmark3_text]]
            <div class="createCollection">
                <h5><i class="fas fa-plus"></i> [[!%asi.title_create_a_new_collection? &topic=`default` &namespace=`asi`]]</h5>
                <div class="inner">
                    <form class="inlineSubmit sub200">
                        <p class="strongLabel">[[!%asi.label_new_collection_name? &topic=`label` &namespace=`asi`]]</p>
                        <div class="inputWrapper">
                            <input type="text" name="collectionName" placeholder="[[!%asi.input_ph_new_collection_name? &topic=`input` &namespace=`asi`]]">
                            <input class="hidden-xs" type="submit" value="[[!%asi.action_create_new_collection? &topic=`actions` &namespace=`asi`]]">
                            <input class="visible-xs" type="submit" value="[[!%asi.action_create? &topic=`actions` &namespace=`asi`]]">
                        </div>
                        <span class="success"><i class="fas fa-check mr"></i> [[!%asi.msg_new_collection_created? &topic=`default` &namespace=`asi`]]:<br class="visible-xs"> Collection name here</span>
                    </form>
                </div>
            </div>
			<a class="button pink large full switchModals" href="#searchSavedPopup">[[!%asi.action_add_saved_search_to_new_collection? &topic=`actions` &namespace=`asi`]]</a>
		</div>
	</div>
</div>

<div id="collectionAddedPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
			    [[++added_to_collection_text]]
			    [[-added_to_bookmark_text]]
			    <a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_saved_searches_bkmrk? &topic=`actions` &namespace=`asi`]]</a>

                <a class="button pink" href="/saved-searches-bookmarks-collections#collections">[[!%asi.action_view_my_collections?
                    &topic=`actions` &namespace=`asi`]]</a>

                [[-<a class="button pink" href="[[~[[BabelTranslation:default=`73`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`73`]]]]#collections">[[!%asi.action_view_my_collections?
			        &topic=`actions` &namespace=`asi`]]</a>]]
			</div>
		</div>
	</div>
</div>

<div id="createCollectionPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
                [[++create_collection_text]]
			</div>
			<form class="standard mt30">
		        <p class="fieldLabel">[[!%asi.input_ph_new_collection_name? &topic=`input` &namespace=`asi`]]</p>
		        <div class="inputWrapper">
		            <input data-field="new_collection_name" type="text" name="collectionName" placeholder="[[!%asi.input_ph_new_collection_name? &topic=`input` &namespace=`asi`]]">
		        </div>
		        <a data-trigger="create_new_collection" class="button pink large full switchModals" href="#collectionCreatedPopup">[[!%asi.action_create_new_collection? &topic=`actions` &namespace=`asi`]]</a>
		    </form>
		</div>
	</div>
</div>

<div id="collectionCreatedPopup" class="modal fade">
    <div class="modal-dialog larger">
        <div class="modal-content standard">
            <span class="closeButton" data-dismiss="modal"><i class="fas fa-times"></i></span>
			<div class="content">
                [[+collection_created_text]]
			    <a class="button pink" data-dismiss="modal">[[!%asi.action_return_to_collections? &topic=`actions` &namespace=`asi`]]</a>
			    <a class="button pink" href="[[~[[BabelTranslation:default=`73`? &contextKey=`[[+contextKey]]` &resourceId=`73`]]]]#searches" data-dismiss="modal">[[!%asi.action_view_saved_searches? &topic=`actions` &namespace=`asi`]]</a>
			    <a class="button pink" href="[[~[[BabelTranslation:default=`73`? &contextKey=`[[+contextKey]]` &resourceId=`73`]]]]#bookmarks" data-dismiss="modal">[[!%asi.action_view_bookmarks? &topic=`actions` &namespace=`asi`]]</a>
			</div>
		</div>
	</div>
</div>