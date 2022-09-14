<div class="branch" data-branch="[[!+counter]]" style="display: none;">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <hr>
                    [[!+institution.contact]]
                </div>
            </div>
        </div>
        
        [[!+institution.access:notempty=`
        <div class="contentDropdown full open">
            <hr>
            <div class="inner" style="display:block;">
                <div class="content">
                    [[!+institution.access]]
                </div>
            </div>
        </div>
        `]]
        
        [[!+institution.archives:notempty=`
        <div class="contentDropdown full transparent open">
            <hr>
            <div class="inner" style="display:block;">
                [[!+institution.archives]]    
            </div>
            [[-
            <div class="text-center mt30">
                <a class="showMore">[[!%asi.show_more? &topic=`actions` &namespace=`asi`]] <i
                        class="far fa-angle-down"></i></a>
                <a class="showLess">[[!%asi.show_less? &topic=`actions` &namespace=`asi`]] <i
                        class="far fa-angle-up"></i></a>
            </div>
            ]]
        </div>
        `]]
    </div>


    [[-!+holdings_desc]]
    [[-!+holdings_hist]]

</div>