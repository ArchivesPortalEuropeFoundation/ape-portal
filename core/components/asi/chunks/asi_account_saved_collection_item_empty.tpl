<div class="savedSearch" style="width: 100%" data-sort-item="collection"  data-sort-name="[[!+name]]" data-sort-id="[[!+id]]" data-sort-date="[[!+date_sort]]" data-search-filter-item="saved_collection" data-search-filter-field="[[!+name]]">
    <div class="details">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="item">
                    <div class="title">(ID) [[!%asi.title_collection_name? &topic=`default` &namespace=`asi`]] <i class="fas fa-pencil editIcon"></i></div>
                    <div class="value">
                        ([[!+id]]) [[!+name]]
                        <form class="editField">
                            <input data-field="name" data-entity="collection" data-id="[[!+id]]" type="text" name="searchTitle" placeholder="[[!%asi.title_collection_name? &topic=`default` &namespace=`asi`]]" value="[[!+name]]">
                            <i class="fas fa-check confirm"></i>
                            <i class="fas fa-times cancel"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-4">
                <div class="item">
                    <div class="title">[[!%asi.title_description? &topic=`default` &namespace=`asi`]] <i class="fas fa-pencil editIcon"></i></div>
                    <div class="value">
                        [[!+description]]
                        <form class="editField">
                            <textarea data-field="description" data-entity="collection" data-id="[[!+id]]" name="bookmarkDescription" placeholder="[[!%asi.title_description? &topic=`default` &namespace=`asi`]]">[[!+description]]</textarea>
                            <i class="fas fa-check confirm"></i>
                            <i class="fas fa-times cancel"></i>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-5 mt20SM">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="item">
                            <div class="title">[[!%asi.title_collection_searches? &topic=`default` &namespace=`asi`]]</div>
                            <div class="value xs13" data-collection-id="[[!+id]]" data-count="total_searches">
                                [[!+total_searches]]
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="item">
                            <div class="title">[[!%asi.title_bookmarks? &topic=`default` &namespace=`asi`]]</div>
                            <div class="value xs13" data-collection-id="[[!+id]]" data-count="total_bookmarks">
                                [[!+total_bookmarks]]
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="item">
                            <div class="title">[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]</div>
                            <div class="value xs13">
                                [[!+created_at]]
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="optionsItem">
                <i class="fas fa-ellipsis-h showHiddenOptions"></i>
                <div class="hiddenOptions">
                    <ul>
                        <li><a href="#" data-copy-clipboard="[[!+url]]" class="copyLink"><i class="fas fa-link"></i> [[!%asi.action_copy? &topic=`actions` &namespace=`asi`]]</a></li>
                        <li><a href="#deleteConfirmPopup" data-toggle="modal" data-populate-collection-delete="[[!+id]]"><i class="fas fa-trash"></i> [[!%asi.action_delete_collection? &topic=`actions` &namespace=`asi`]]</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="contentDropdown">
        <div class="right">
            <a href="#deleteConfirmPopup" data-toggle="modal" data-populate-collection-delete="[[!+id]]"><i class="fas fa-trash"></i> [[!%asi.action_delete_collection? &topic=`actions` &namespace=`asi`]]</a>
        </div>
        <div class="title" data-trigger="collection_drill" data-collection-id="[[!+id]]">
            [[!%asi.title_collection_contents? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-down"></i>
        </div>
        <div class="inner" data-container="collection_drill" data-collection-id="[[!+id]]">
            <div class="category">
                <h3>[[!%asi.title_searches? &topic=`default` &namespace=`asi`]]</h3>
                <div class="details hidden-xs" data-collection-search-headings="[[!+id]]">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="item">
                                <div class="title">(ID) [[!%asi.title_search_title? &topic=`default` &namespace=`asi`]]</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="item">
                                <div class="title">[[!%asi.title_collection_contents? &topic=`default` &namespace=`asi`]]</div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="item padR">
                                <div class="title">[[!%asi.title_search_term? &topic=`default` &namespace=`asi`]]</div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="item offsetL">
                                <div class="icons">
                                    <span>[[!%asi.action_remove? &topic=`actions` &namespace=`asi`]]</span>
                                </div>
                                <div class="title">[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-populate="account_saved_collection_searches" data-collection-name="[[!+name:htmlent]]" data-collection-id="[[!+id]]">
                    [[- searches load here via ajax ]]
                </div>

            </div>

            <div class="category">
                <h3>[[!%asi.title_bookmarks? &topic=`default` &namespace=`asi`]]</h3>
                <div class="details hidden-xs" data-collection-bookmark-headings="[[!+id]]">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="item">
                                <div class="title">(ID) [[!%asi.title_bookmark_name? &topic=`default` &namespace=`asi`]]</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="item">
                                <div class="title">[[!%asi.title_collection_contents? &topic=`default` &namespace=`asi`]]</div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="item padR">
                                <div class="title">[[!%asi.title_type_of_archive? &topic=`default` &namespace=`asi`]]</div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="item offsetL">
                                <div class="title">[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]</div>
                                <div class="icons">
                                    <span>[[!%asi.action_remove? &topic=`actions` &namespace=`asi`]]</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-populate="account_saved_collection_bookmarks" data-collection-id="[[!+id]]">
                    [[- bookmarks load here via ajax ]]
                </div>

            </div>
        </div>
    </div>
</div>