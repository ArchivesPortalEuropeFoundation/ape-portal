<div class="savedSearch" style="width: 100%" data-sort-item="bookmark"  data-sort-name="[[!+name]]" data-sort-id="[[!+id]]" data-sort-date="[[!+date_sort]]" data-search-filter-item="saved_bookmark" data-search-filter-field="[[!+name]]">
    <div class="details">
        <div class="row">
            <div class="col-sm-3">
                <div class="item">
                    <div class="title">(ID) [[!%asi.title_bookmark_name? &topic=`default` &namespace=`asi`]]</div>
                    <div class="value">
                        ([[!+id]]) [[!+name]]
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="item">
                    <div class="title">[[!%asi.title_description? &topic=`default` &namespace=`asi`]] <i class="fas fa-pencil editIcon"></i></div>
                    <div class="value">
                        [[!+description]]
                        <form class="editField">
                            <textarea data-field="description" data-entity="bookmark" data-id="[[!+id]]" name="bookmarkDescription" placeholder="[[!%asi.label_description_here? &topic=`label` &namespace=`asi`]]">[[!+description]]</textarea>
                            <i class="fas fa-check confirm"></i>
                            <i class="fas fa-times cancel"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="item inlineM">
                    <div class="title">[[!%asi.title_type_of_archive? &topic=`default` &namespace=`asi`]]<span class="visible-xs">:</span></div>
                    <div class="value">
                        [[!+archive_type]]
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="item inlineM">
                    <div class="title">[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]<span class="visible-xs">:</span></div>
                    <div class="value">
                        [[!+created_at]]
                    </div>
                </div>
            </div>
            <div class="optionsItem">
                <i class="fas fa-ellipsis-h showHiddenOptions"></i>
                <div class="hiddenOptions">
                    <ul>
                        <li><a data-copy-clipboard="[[!+url]]"><i class="fas fa-link"></i> [[!%asi.action_copy? &topic=`actions` &namespace=`asi`]]</a></li>
                        <li><a href="[[!+url]]"><i class="fas fa-eye"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a></li>
                        <li><a href="#addCollectionPopup" data-toggle="modal" data-trigger="load_collections_not_assigned_to_this" data-id="[[!+id]]" data-collection-target="bookmark"><i class="fas fa-plus"></i> [[!%asi.title_add_to_collection? &topic=`default` &namespace=`asi`]]</a></li>
                        <li><a href="#deleteConfirmPopup" data-toggle="modal" data-populate-bookmark-delete="[[!+id]]"><i class="fas fa-trash"></i> [[!%asi.action_delete? &topic=`actions` &namespace=`asi`]]</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tools">
        <a data-copy-clipboard="[[!+url]]"><i class="fas fa-link"></i> [[!%asi.action_copy? &topic=`actions` &namespace=`asi`]]</a>
        <a href="[[!+url]]"><i class="fas fa-eye"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
        <a href="#addCollectionPopup" data-toggle="modal" data-trigger="load_collections_not_assigned_to_this" data-id="[[!+id]]" data-collection-target="bookmark"><i class="fas fa-plus"></i> [[!%asi.title_add_to_collection? &topic=`default` &namespace=`asi`]]</a>
        <a href="#deleteConfirmPopup" data-toggle="modal" data-populate-bookmark-delete="[[!+id]]"><i class="fas fa-trash"></i> [[!%asi.action_delete? &topic=`actions` &namespace=`asi`]]</a>
    </div>
</div>