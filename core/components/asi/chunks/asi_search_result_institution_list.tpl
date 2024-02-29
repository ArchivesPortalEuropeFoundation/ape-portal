<div class="searchResult institution">
    <div class="details">
        <h3 class="shaveitem">[[!+name]]</h3>
        <div class="description">
            [[!+archive_type:notempty=`
            <p class="aligned">
                <span class="fixed">[[!%asi.title_type_of_archive? &topic=`default` &namespace=`asi`]]:</span>[[!+archive_type]]
            </p>
            `]]
            
            [[!+address:notempty=`
            <p class="aligned">
                <span class="fixed">[[!%asi.visitor_address? &topic=`default` &namespace=`asi`]]:</span><a class="otherLink" href="institution/aicode/[[!+code]]?term=[[!+term]]&scroll=accessDisplay">[[!+address]]</a>
            </p>
            `]]

            <a class="view button blue" href="[[~62]]?repositoryCode=[[!+code]]&term=[[!+term]]">
            <i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>

            <a style="top: 46px;" class="view button blue" target="_blank" href="/institution/aicode/[[!+code]]?term=[[!+term]]">
                <i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
        
            [[!+searchable_content:gt=`0`:then=`
            <a class="aidsLink" href="institution/aicode/[[!+code]]?term=[[!+term]]&scroll=archivalMaterials"><i class="fas fa-bars"></i>[[!%asi.label_list_of_archival_materials? &topic=`label` &namespace=`asi`]]</a>`]]
        </div>
        <span class="country"><i class="fas fa-globe-europe"></i> [[!+country]]</span>
    </div>
    [[-
    <div class="contentDropdown" data-control="result-dropdown-more">
        <div class="title">
            [[!%asi.title_contact_and_access_details? &topic=`default` &namespace=`asi`]]<i
                class="fas fa-angle-down"></i>
        </div>
        <div class="inner">
            
            <p class="aligned">
                <span class="fixed">[[!%asi.visitor_address? &topic=`default` &namespace=`asi`]]:</span> [[!+address]]</p>

                    <span class="fixed">
                        <a class="" href="[[~62]]?repositoryCode=[[!+code]]&term=[[!+term]]#accessService">
                            <i class="fas fa-map-signs mr"></i>
                            [[!%asi.title_get_directions? &topic=`default` &namespace=`asi`]]
                        </a>
                    </span>

                <p>
                    <strong>Email:</strong> <a href="mailto:hello@institutionnamehere.com">hello@institutionnamehere.com</a>
                </p>
                <p>
                    <strong>Web:</strong> <a href="www.institutionnamehere.com" target="_blank">www.institutionnamehere.com</a>
                </p>
                <p>
                    <strong>[[!%asi.phone? &topic=`default` &namespace=`asi`]]:</strong> <a href="tel:+44 1234 567 890">+44 1234 567 890</a>
                </p>

                <h4>[[!%asi.access_service_information? &topic=`default` &namespace=`asi`]]</h4>

                <p>
                    <strong>[[!%asi.opening_hours? &topic=`default` &namespace=`asi`]]:</strong> Details of opening hours display here.
                </p>
                <p>
                    <strong>[[!%asi.title_closing_dates? &topic=`default` &namespace=`asi`]]:</strong> Please check website
                </p>

        </div>
    </div>
    ]]
</div>