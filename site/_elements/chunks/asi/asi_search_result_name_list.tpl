<div class="searchResult name">
    <div class="details">
        <div class="header">
            <h3>[[!+name]]</h3>
            [[!+date_type:isnt=`nodate`:then=`<span class="date"><i class="far fa-calendar-alt mr"></i> [[!+date]]</span>`]]
        </div>
        <div class="body">
            <div class="description">
                <span class="ref"><strong>[[!%asi.results_identifier? &topic=`default` &namespace=`asi`]]:</strong> [[!+record_id]]</span>
                <p>[[!+description:ellipsis=`120`]]</p>
            </div>
            <a class="view button blue" href="[[~61]]?repositoryCode=[[!+code]]&recordId=[[!+record_id]]&term=[[!+term]]"><i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
        </div>
        <span class="nameType"><i class="fas [[!+name_icon]]"></i> [[!%asi.[[!+name_description]]? &topic=`solr` &namespace=`asi`]]</span>
    </div>
    <div class="contentDropdown" data-control="result-dropdown-more">
        <div class="title">
            [[!%asi.title_context? &topic=`default` &namespace=`asi`]] <i class="fas fa-angle-down"></i>
        </div>
        <div class="inner">
            <p><strong>[[!%asi.title_institution_country? &topic=`default` &namespace=`asi`]]:</strong> [[!+institution_name]] / [[!+country_name]]</p>
            [[-<a class="view" href="#"><i class="fas fa-eye mr"></i> [[!%asi.action_view_only_results_from_finding_aid? &topic=`actions` &namespace=`asi`]]</a>]]
            [[!+related_chunk]]

        </div>
    </div>
</div>