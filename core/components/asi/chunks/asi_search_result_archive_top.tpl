<h1>[[!+archive.title:striptags]]</h1>

[[!+archive.subtitle_date:notempty=`<span class="date">
                <i class="far fa-calendar-alt"></i> [[!+archive.subtitle_date]]
            </span>`]]
[[!+archive.eadid:notempty=`<span class="ref">
                <strong>[[!%asi.title_reference? &topic=`default` &namespace=`asi`]]:</strong>
                [[!+archive.eadid]]
            </span>`]]
<div class="buttons">
    <a class="button blue visible-xs visible-sm toggleSlideUp viewContext" href="#affix"><i class="fas fa-sitemap"></i>[[!%asi.view_context? &topic=`default` &namespace=`asi`]]</a>
    <a class="button blue visible-xs visible-sm toggleSlideUp" href="#optionsSlideUp"><i class="fas fa-cogs"></i></a>
    [[- <a class="button blue hidden-xs hidden-sm" href="#bookmarkPopup" data-trigger="save_bookmark"><i class="fas fa-bookmark"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
    <a class="button blue hidden-xs hidden-sm" href="#suggestionPopup" data-trigger="suggestion"><i class="fas fa-pencil"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
    <a class="button blue aLink hidden-xs hidden-sm" onclick="contactInstitutionClick()"><i class="fas fa-comment"></i> [[!%asi.action_contact_institution? &topic=`actions` &namespace=`asi`]]</a>
    <div class="buttonDropdown">
        <a class="button blue"><i class="fas fa-share-alt"></i><span class="hidden-xs"> [[!%asi.tools_share? &topic=`default` &namespace=`asi`]]</span></a>
        <div class="inner">
            <a href="[[++sharing_facebook]]" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="[[++sharing_twitter]]" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="[[++sharing_linkedin]]" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
            <a href="[[!+URI]]" class="copyUrl"><i class="fas fa-link"></i> <span>[[!%asi.tools_copy_link? &topic=`default` &namespace=`asi`]]</span></a>
        </div>
    </div>
    [[-<div class="buttonDropdown">
        <a class="button blue"><i class="fas fa-download"></i><span class="hidden-xs"> [[!%asi.tools_download_link? &topic=`default` &namespace=`asi`]]</span></a>
        <div class="inner">
            <a href="[[!download_pdf_link]]" target="_blank"><i class="fas fa-file-download"></i> [[!%asi.action_download_pdf? &topic=`actions` &namespace=`asi`]]</a>
            <a><i class="fas fa-file-export"></i> [[!%asi.tools_export? &topic=`default` &namespace=`asi`]]</a>
            <a href="#" onclick="window.print();"><i class="fas fa-print"></i> [[!%asi.tools_print? &topic=`default` &namespace=`asi`]]</a>
        </div>
    </div>]]
</div>
[[!+archive.original_link:notempty=`<a class="originalLink" href="[[!+archive.original_link]]" target="_blank">[[!+archive.original_link_text]] <i class="far fa-external-link-alt ml"></i></a>`]]
