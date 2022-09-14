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
                    <i class="fas fa-ellipsis-h showHiddenOptions"></i>
                    <i class="fas fa-trash delete" href="#deleteConfirmOptionPopup" data-toggle="modal"></i>
                    <div class="hiddenOptions">
                        <ul>
                            <li><a href="[[!+full_url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_results? &topic=`actions` &namespace=`asi`]]</a></li>
                            [[!+owner:eq=`1`:then=`
                            <li><a href="[[!+full_url]]&since=[[!+since]]"><i class="fas fa-clock"></i> [[!%asi.action_view_new_results? &topic=`actions` &namespace=`asi`]]</a></li>
                            <li><a href="#viewParamsPopup" data-toggle="modal"><i class="fas fa-search"></i> [[!%asi.action_view_parameters? &topic=`actions` &namespace=`asi`]]</a></li>
                            <li><a href="#deleteConfirmOptionPopup" data-toggle="modal"><i class="fas fa-trash"></i> [[!%asi.action_remove_from_collection? &topic=`actions` &namespace=`asi`]]</a></li>
                            `]]
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
        <h5>(1000) [[!%asi.title_search_title? &topic=`default` &namespace=`asi`]]</h5>
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
            <i class="fas fa-ellipsis-h showHiddenOptions"></i>
            <i class="fas fa-trash delete" href="#deleteConfirmOptionPopup" data-toggle="modal"></i>
            <div class="hiddenOptions">
                <ul>
                    <li><a href="[[!+full_url]]"><i class="fas fa-eye"></i> [[!%asi.action_view_results? &topic=`actions` &namespace=`asi`]]</a></li>
                    [[!+owner:eq=`1`:then=`
                    <li><a href="[[!+full_url]]&since=[[!+since]]"><i class="fas fa-clock"></i> [[!%asi.action_view_new_results? &topic=`actions` &namespace=`asi`]]</a></li>
                    <li><a href="#viewParamsPopup" data-toggle="modal"><i class="fas fa-search"></i> [[!%asi.action_view_parameters? &topic=`actions` &namespace=`asi`]]</a></li>
                    <li><a href="#deleteConfirmOptionPopup" data-toggle="modal"><i class="fas fa-trash"></i> [[!%asi.action_remove_from_collection? &topic=`actions` &namespace=`asi`]]</a></li>
                    `]]
                </ul>
            </div>
        </div>
    </div>
</div>