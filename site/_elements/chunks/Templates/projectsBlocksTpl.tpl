[[!readMoreContent? &unique_id=`[[!+idx]]` &content=`[[+content]]` &wordCount=`[[+wordCount]]`]]

<div class="col-sm-6">
    <div class="projectsBlock [[+button:calltoactionTV=`ctaTVHasTpl`]]">
        <div class="main">
            <h3>[[+title]]</h3>
            <h5>[[+subtitle]]</h5>
            [[!+rm_[[!+idx]].preview:isnotempty=`
                <div class="more">
                [[!+rm_[[!+idx]].preview]]
                    <div class="inner">
                        [[!+rm_[[!+idx]].content]]
                        <a class="show">[[!%asi.show_less? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-up ml"></i></a>
                        [[+button:calltoactionTV=`ctaTVButtonBlueTpl`]]
                    </div>
                </div>
            `:default=`
                [[!+rm_[[!+idx]].content]]
            `]]
        </div>
        [[!+rm_[[!+idx]].preview:isnotempty=`
            <a class="show">[[!%asi.show_more? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-down ml"></i></a>
        `]]
        [[+button:calltoactionTV=`ctaTVButtonBlueTpl`]]
    </div>
</div>