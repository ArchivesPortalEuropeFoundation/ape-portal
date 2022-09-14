<div class="details">
    <div class="row">
        <div class="col-sm-3">
            <div class="item">
                <div class="value">
                    ([[!+id]]) [[!+name]]
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="item">
                <div class="value">
                    [[!+description]]
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="item padR">
                <div class="value">
                    [[!+term]]
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="item offsetL">
                <div class="icons">
                    <i class="fas fa-ellipsis-h showHiddenOptions" data-toggle="show_hidden_options"></i>
                    <i class="fas fa-trash delete" data-item="trash" data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="search" data-toggle="modal"></i>
                    <div class="hiddenOptions">
                        <ul>
                            <li><a href="[[!+full_url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_results? &topic=`actions` &namespace=`asi`]]</a></li>
                            <li><a href="[[!+full_url]]"><i class="fas fa-clock"></i> [[!%asi.action_view_new_results? &topic=`actions` &namespace=`asi`]]</a></li>
                            <li><a href="#viewParamsPopup" data-param-results-url="[[!+full_url]]" data-param-new-results-url="[[!+full_url]]" data-trigger="params_popup" data-id="[[!+id]]"><i class="fas fa-search"></i> [[!%asi.action_view_parameters? &topic=`actions` &namespace=`asi`]]</a></li>
                            <li><a href="#" data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="search"><i class="fas fa-trash"></i> [[!%asi.action_remove_from_collection? &topic=`actions` &namespace=`asi`]]</a></li>
                        </ul>
                    </div>
                </div>
                <div class="value">
                    [[!+created_at]]
                </div>
            </div>
        </div>
    </div>
    <div class="detailsMobile">
        <h5>([[!+id]]) [[!+name]]</h5>
        <div class="moreDropdownS">
            <div class="inner">
                <p>[[!+description]]</p>
                <p class="mb10"><strong>[[!%asi.title_search_term? &topic=`default` &namespace=`asi`]]:</strong> [[!+term]]</p>
                <p><strong>[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]:</strong> [[!+created_at]]</p>
            </div>
            <div class="title">
                [[!%asi.show_more? &topic=`actions` &namespace=`asi`]]
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-ellipsis-h showHiddenOptions" data-toggle="show_hidden_options"></i>
            <i class="fas fa-trash delete" data-item="trash" data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="search" data-toggle="modal"></i>
            <div class="hiddenOptions">
                <ul>
                    <li><a href="[[!+full_url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_results? &topic=`actions` &namespace=`asi`]]</a></li>
                    <li><a href="[[!+full_url]]"><i class="fas fa-clock"></i> [[!%asi.action_view_new_results? &topic=`actions` &namespace=`asi`]]</a></li>
                    <li><a href="#viewParamsPopup" data-param-results-url="[[!+full_url]]" data-param-new-results-url="[[!+full_url]]" data-trigger="params_popup" data-id="[[!+id]]"><i class="fas fa-search"></i> [[!%asi.action_view_parameters? &topic=`actions` &namespace=`asi`]]</a></li>
                    <li><a href="#" data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="search"><i class="fas fa-trash"></i> [[!%asi.action_remove_from_collection? &topic=`actions` &namespace=`asi`]]</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>