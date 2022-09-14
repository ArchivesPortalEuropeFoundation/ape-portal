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
                    [[!+archive_type]]
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="item offsetL">
                <div class="icons">
                    <i class="fas fa-ellipsis-h showHiddenOptions" data-toggle="show_hidden_options"></i>
                    <i class="fas fa-trash delete" data-item="trash" data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="bookmark" data-toggle="modal"></i>
                    <div class="hiddenOptions">
                        <ul>
                            <li><a href="[[!+url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_bookmark? &topic=`actions` &namespace=`asi`]]</a></li>
                            <li><a data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="bookmark"><i class="fas fa-trash"></i> [[!%asi.action_remove_from_collection? &topic=`actions` &namespace=`asi`]]</a></li>
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
                <p class="mb10"><strong>[[!%asi.title_type_of_archive? &topic=`default` &namespace=`asi`]]:</strong> [[!+archive_type]]</p>
                <p><strong>[[!%asi.title_saved_on? &topic=`default` &namespace=`asi`]]:</strong> [[!+created_at]]</p>
            </div>
            <div class="title">
                [[!%asi.show_more? &topic=`actions` &namespace=`asi`]]
            </div>
        </div>
        <div class="icons">
            <i class="fas fa-ellipsis-h showHiddenOptions" data-toggle="show_hidden_options"></i>
            <i class="fas fa-trash delete" data-item="trash" data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="bookmark" data-toggle="modal"></i>
            <div class="hiddenOptions">
                <ul>
                    <li><a href="[[!+url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_bookmark? &topic=`actions` &namespace=`asi`]]</a></li>
                    <li><a data-item-name="[[!+name:htmlent]]" data-id="[[!+id]]" data-trigger="remove_collection_item" data-target="bookmark"><i class="fas fa-trash"></i> [[!%asi.action_remove_from_collection? &topic=`actions` &namespace=`asi`]]</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>