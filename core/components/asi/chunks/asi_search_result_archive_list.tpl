<div class="searchResult [[!+image:neq=``:then=`wImage`]] [[!+digital:neq=``:then=`wDigi`]]" data-lazy-load="[[+fa_id]]">
    <div class="details">
        <div class="header">
            <div class="left">
                <h3>[[!+title:limit=`120`]]</h3>
                [[!+reference:neq=``:then=`<p><strong>[[!%asi.title_reference? &topic=`default` &namespace=`asi`]]:</strong> [[!+reference]]</p>`]]
            </div>
            <span class="date"><i class="far fa-calendar-alt mr"></i>[[!+date:neq=``:then=`[[!+date]]`:else=`no date`]]</span>
        </div>
        <div class="body">
            <div class="description">
                <p>[[!+extract:ellipsis=`150`]]</p>
                [[!+other_value:neq=``:then=`
                <p>[[!+other_value:ellipsis=`150`]]</p>
                `]]
                [[!+dao:eq=`1`:then=`<span class="digiObject"><i class="fas fa-image"></i> Digital object</span>`]]
            </div>
            <a class="view button blue" href="[[~60]]?&repositoryCode=[[!+code]]&term=[[!+link_term]]&levelName=[[!+levelName]][[!+link_data]]"><i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
            <a class="view button blue" target="_blank" href="/archive/aicode/[[!+code]]/type/[[!+recordType]]/id/[[!+recordId]][[!+extraCLevelIdPart]]"><i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
        </div>
        [[!+daoType:eq=`IMAGE`:then=`
        <div class="image" style="background-image:url(uploads/test-images/[[!+image]]);"></div>
        `]]
    </div>
    <div class="contentDropdown" data-control="result-dropdown-more">
        <div class="title">
            [[!%asi.title_context? &topic=`default` &namespace=`asi`]] <i class="fas fa-angle-down"></i>
        </div>
        <div class="inner" style="display: none;">
            <p><strong>[[!%asi.title_title? &topic=`default` &namespace=`asi`]]:</strong> [[+fa_title]]</p>
            [[-<a class="view" href="#"><i class="fas fa-eye mr"></i> [[!%asi.action_view_only_results_from_finding_aid? &topic=`actions` &namespace=`asi`]]</a>]]
            <p><strong>[[!%asi.results_identifier? &topic=`default` &namespace=`asi`]]:</strong> [[+fa_id]]</p>
            <p><strong>[[!%asi.title_institution_country? &topic=`default` &namespace=`asi`]]:</strong> [[!+institution]] / [[!+country]]</p>
        </div>
    </div>
</div>