<div class="savedSearch" style="width: 100%; position:relative;" data-sort-item="search"  data-sort-name="[[!+name]]" data-sort-id="[[!+id]]" data-sort-date="[[!+date_sort]]" data-search-filter-item="saved_search" data-search-filter-field="[[!+name]]">
    <div class="details">
        <div class="row">
            <div class="col-sm-3">
                <div class="item">
                    <div class="title">(ID) [[!%asi.title_search_title? &topic=`default` &namespace=`asi`]] <i class="fas fa-pencil editIcon"></i></div>
                    <div class="value">
                        ([[!+id]]) [[!+name]]
                        <form class="editField">
                            <input type="text" data-field="name" data-entity="search" data-id="[[!+id]]" name="searchTitle" placeholder="[[!%asi.title_search_title? &topic=`default` &namespace=`asi`]]" value="[[!+name]]">
                            <i class="fas fa-check confirm"></i>
                            <i class="fas fa-times cancel"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="item">
                    <div class="title">[[!%asi.title_description? &topic=`default` &namespace=`asi`]] <i class="fas fa-pencil editIcon"></i></div>
                    <div class="value">
                        [[!+description]]
                        <form class="editField">
                            <textarea data-field="description" data-entity="search" data-id="[[!+id]]" name="searchDescription" placeholder="Description here">[[!+description]]</textarea>
                            <i class="fas fa-check confirm"></i>
                            <i class="fas fa-times cancel"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-3">
                <div class="item inlineM">
                    <div class="title">[[!%asi.title_search_term? &topic=`default` &namespace=`asi`]]<span class="visible-xs">:</span></div>
                    <div class="value">
                        [[!+term]]
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
                        <li><a href="#" data-copy-clipboard="[[!+full_url]]"><i class="fas fa-link"></i> [[!%asi.action_copy? &topic=`actions` &namespace=`asi`]]</a></li>
                        <li><a href="[[!+full_url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_results? &topic=`actions` &namespace=`asi`]]</a></li>
                        <li><a href="[[!+full_url]]&since=[[!+since]]"><i class="fas fa-clock"></i> [[!%asi.action_view_new_results? &topic=`actions` &namespace=`asi`]]</a></li>
                        <li><a href="#addCollectionPopup" data-toggle="modal" data-trigger="load_collections_not_assigned_to_this" data-id="[[!+id]]" data-collection-target="search"><i class="fas fa-plus"></i> [[!%asi.title_add_to_collection? &topic=`default` &namespace=`asi`]]</a></li>
                        <li><a href="#deleteConfirmPopup" data-toggle="modal" data-populate-search-delete="[[!+id]]"><i class="fas fa-trash"></i> [[!%asi.action_delete? &topic=`actions` &namespace=`asi`]]</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="contentDropdown">
        <div class="right">
            <a href="#" data-copy-clipboard="[[!+full_url]]"><i class="fas fa-link"></i> [[!%asi.action_copy? &topic=`actions` &namespace=`asi`]]</a>
            <a href="[[!+full_url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_results? &topic=`actions` &namespace=`asi`]]</a>
            <a href="[[!+full_url]]&since=[[!+since]]"><i class="fas fa-clock"></i> [[!%asi.action_view_new_results? &topic=`actions` &namespace=`asi`]]</a>
            <a href="#addCollectionPopup" data-toggle="modal" data-trigger="load_collections_not_assigned_to_this" data-id="[[!+id]]" data-collection-target="search"><i class="fas fa-plus"></i> [[!%asi.title_add_to_collection? &topic=`default` &namespace=`asi`]]</a>
            <a href="#deleteConfirmPopup" data-toggle="modal" data-populate-search-delete="[[!+id]]"><i class="fas fa-trash"></i> [[!%asi.action_delete? &topic=`actions` &namespace=`asi`]]</a>
        </div>
        <div class="title param_title">
            [[!%asi.title_full_search_parameters? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-down"></i>
        </div>
        <div class="inner wParam">
            <div class="row">
                <div class="col-md-8">
                    [[!+params_html]]
                </div>
                <div class="col-md-4">
                    <a class="button blue" href="[[!+full_url]]&existing=[[!+id]]"><i class="fas fa-pencil mr"></i> [[!%asi.action_edit_parameters? &topic=`actions` &namespace=`asi`]]</a>
                </div>
            </div>


        </div>
    </div>
</div>