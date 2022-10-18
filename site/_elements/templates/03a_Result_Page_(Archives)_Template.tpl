<!DOCTYPE html>
<html lang="[[!++cultureKey]]">

<head>
    [[$head]]
    <style>
        .pControlacces {
            padding-bottom: 20px;
        }

        .externalLink a {
            color: #b23063;
            font-weight: 700;
        }

        .linkButton a {
            color: #b23063;
            font-weight: 700;
        }

        .otherLink {
            color: #b23063;
            font-weight: 700;
        }

        .daolist-orig {
            display: flex;
            flex-wrap: wrap;
        }

        .dao {
            text-align: center;
            flex: 0 0 33.3%;
        }

        .nolink {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .content h4 {
            margin-bottom: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    [[$header]]

    [[!asi_search_result_detail? &section=`search-in-archives`]]
    <div class="altSlideOut replace">
        <div class="container">
            <div class="clearfix">
                <div class="left">
                    <a onclick="history.back(-1)" class="hidden-xs"><i class="far fa-angle-left mr"></i> [[!%asi.return_to_search? &topic=`default` &namespace=`asi`]]</a>
                    <div class="buttons visible-xs">
                        <a class="button blue toggleSlideUp viewContext" href="#affix"><i class="fas fa-sitemap"></i>[[!%asi.view_context? &topic=`default` &namespace=`asi`]]</a>
                        <a class="button blue toggleSlideUp" href="#optionsSlideUp"><i class="fas fa-cogs"></i></a>
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
                </div>
                <div class="right">
                  [[-  <a class="yellowIcon" href="#bookmarkPopup" data-trigger="save_bookmark"><i class="fas fa-bookmark mr"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
                    <a class="pinkIcon" href="#suggestionPopup" data-trigger="suggestion"><i class="fas fa-pencil mr"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
                    <a class="aLink blueIcon" onclick="contactInstitutionClick()"><i class="fas fa-comment mr"></i> [[!%asi.action_contact_institution? &topic=`actions` &namespace=`asi`]]</a>
                </div>
            </div>
        </div>
    </div>

    <section id="innerHero">
        <div class="container">
            <a class="returnLink" onclick="history.back(-1)"><i class="far fa-angle-left mr"></i> [[!%asi.return_to_search? &topic=`default` &namespace=`asi`]]</a>

            [[$breadcrumbs]]
            <div class="content" data-populate="archive_detail_top">

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
                [[!+search_result.original_presentation_html]]
            </div>

        </div>
    </section>

    <section id="resultContainer" class="clearfix">
        <div class="left slideIn" id="affix">
            <div data-populate="archive_detail_top_left">
                <div class="top">
                    <h3>[[!%asi.view_context? &topic=`default` &namespace=`asi`]]</h3>
                    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
                </div>
                <div class="country">
                    <i class="fas fa-globe-europe"></i> [[!+institution.country]]
                </div>
                <div class="institution">
                    <i class="fas fa-landmark"></i> [[!+institution.name]]
                </div>
                [[-
                <div class="aid">
                    <i class="fas fa-layer-group"></i> Holding / Source guide here
                </div>
                ]]
            </div>
            <div class="groups">
                <h4><i class="fas fa-bars"></i> [[!%asi.search_finding_aid_sub_groups? &topic=`search` &namespace=`asi`]]</h4>
                <div style="max-height: 70vh; overflow: scroll;" data-populate="tree">

                </div>
                [[- <h1>AJAX demo</h1>
                <div id="treeJus" class="demo"></div>]]
                [[-<div id="tree"></div>
                <div id="statusLine">Debug Status Line</div>]]

            </div>
        </div>
        <div class="right" data-populate="archive_detail_rhs">
            [[-$asi_search_result_archive_rhs]]

            <div class="content">
                [[-
                Content supplied by APE API
                ]]
                <div id="archiveContent">
                    [[!+archive.html]]
                </div>

                [[- REMOVED
                <p>[[!+search_result.scope_first:striptags]]</p>
                <div class="moreDropdown">
                    <div class="inner">
                        <p>[[!+search_result.scope_rest:striptags]]</p>
                    </div>
                    [[!+search_result.scope_rest:neq=``:then=`
                    <div class="title inContent">
                        [[!%asi.action_more? &topic=`actions` &namespace=`asi`]]
                    </div>
                    `]]
                </div>
                ]]
            </div>
            [[- REMOVED
            [[- MH: the chunk for these is asi_dropdown_section, the rendering is performed in AsiManager::renderSection ]]
            [[+search_result.creator_history]]
            [[+search_result.archive_history]]
            [[+search_result.arrangement]]
            [[+search_result.access]]
            [[- @TODO - Conditions governing reproduction ]]
            [[+search_result.publication_note]]
            [[+search_result.extent]]
            [[+search_result.keywords]]
            [[+search_result.language]]
            [[+search_result.creator]]
            [[+search_result.providor]]
            ]]

            [[+archive.gallery.slider:notempty=`
            <div class="contentDropdown full open">
                <div class="title galleryDropdown">
                    <h2>[[!%asi.title_digital_objects? &topic=`default` &namespace=`asi`]]</h2>
                </div>
                <hr>
                <div class="inner" style="display: block;">
                    [[!+gallery_content_tab:neq=``:then=`
                    <div class="view">
                        <strong>[[!%asi.view_doc_label? &topic=`default` &namespace=`asi`]]: </strong>
                        <ul class="nav-tabs">
                            <li class="active"><a href="#tabGallerySlider" data-toggle="tab"><i class="fas fa-images"></i></a></li>
                            <li><a href="#tabGalleryList" data-toggle="tab"><i class="fas fa-list"></i></a></li>
                        </ul>
                    </div>
                    `]]
                    <div class="tab-content">
                        <div id="tabGallerySlider" class="tab-pane fade active in">
                            <div class="row">
                                <div class="col-md-9 col-lg-6">
                                    <div class="galleryContainer">
                                        <span class="galleryCounter">0/0</span>
                                        <div id="documentGallerySlider">
                                            [[!+archive.gallery.slider]]
                                        </div>
                                        <div id="documentCaptionSlider">
                                            [[!+archive.gallery.caption]]
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tabGalleryList" class="tab-pane fade">
                            <div class="row">
                                [[!+archive.gallery.tab]]
                            </div>
                        </div>
                        <div class="content">
                            [[- <p><strong>[[!%asi.title_usage_rights? &topic=`default` &namespace=`asi`]]:</strong></p>
                            <p>[[!%asi.usage_rights_description? &topic=`default` &namespace=`asi`]]</p> ]]
                        </div>
                        [[!+archive.gallery.tab:eq=``:then=`
                        <div class="noObjects">
                            <p><strong>[[!%asi.err_msg_there_are_no_digital_objects? &topic=`forms` &namespace=`asi`]]</strong></p>
                            <a class="button blue aLink" href="#contactInstitution">[[!%asi.action_enquire_about_digitisation?
                                &topic=`actions` &namespace=`asi`]]</a>
                        </div>
                        `]]
                    </div>
                </div>
            </div>
            `]]
            [[!+archive.components.resultsTotal:gt=`0`:then=`
            <div class="contentDropdown full open">
                <div class="title">
                    <h2>[[!%asi.title_components? &topic=`default` &namespace=`asi`]]</h2>
                </div>
                <hr>
                <div class="inner componentsDropdown" style="display: block;">
                    <div class="controls clearfix">

                        <span class="count"><span>[[!+archive.childrenCount]]</span> [[!%asi.label_items_total?
                            &topic=`label` &namespace=`asi`]]: [[!+archive.components.resultsTotal]]</span>

                        <div id="ComponentsPagination" class="pagination" style="float: right; margin-top: 0px;"></div>

                    </div>

                    <div id="componentChildren">
                        [[+archive.children]]
                    </div>

                </div>
            </div>
            `]]

            <div class="mt40">
                <a class="anchor" id="rateContent"></a>
                <h2 class="iconTitle"><i class="fas fa-thumbs-up"></i> [[!%asi.action_rate_this_content? &topic=`actions` &namespace=`asi`]]</h2>

                [[!FormIt?
                    &hooks=`reCaptchaV3,email,FormItSaveForm`
                    &emailTpl=`allFormMessage`
                    &emailSubject=`Content has been rated - [[!+archive.title:striptags]]`
                    &emailTo=`[[++contact_email]]`
                    &emailFrom=`[[++contact_email]]`
                    &formName=`Rating Form - [[!+archive.title:striptags]]`
                    &formFields=`rating,feedback`
                    &fieldNames=`rating==Rating,feedback==Feedback (if any)`
                    &successMessage=`[[!%asi.form_rating_success_msg? &topic=`forms` &namespace=`asi`]]`
                    &submitVar=`sendRating`
                    &validate=`confirmHSL:blank`
                ]]
                [[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
                [[!+fi.successMessage:notempty=`<h5>[[+fi.successMessage]]</h5>`:default=`
                    [[++rate_content_text]]
                    <div class="row">
                        <div class="col-md-7">
                            <form class="standard mt20" id="rateForm" action="[[!requestURI]]#rateContent" method="post">
                                <input type="hidden" name="emailTitle" value="Content has been rated">
                                <input type="text" name="confirmHSL" class="confirmField" value="">
                                <div class="rating">
                                    <input type="radio" name="rating" value="Good" class="good">
                                    <input type="radio" name="rating" value="Neutral" class="neutral">
                                    <input type="radio" name="rating" value="Bad" class="bad">
                                </div>
                                <div class="hiddenContent">
                                    <div class="title"><strong>[[!%asi.action_add_feedback? &topic=`actions` &namespace=`asi`]]</strong>
                                        <i class="far fa-angle-down"></i>
                                    </div>
                                    <div class="inner">
                                        <div class="inputWrapper">
                                            <textarea name="feedback" placeholder="[[!%asi.input_your_feedback? &topic=`input` &namespace=`asi`]]"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input class="disabled" type="submit" name="sendRating" value="[[!%asi.action_send_rating? &topic=`actions` &namespace=`asi`]]">
                                <input type="hidden" name="institution_id" value="[[+search_result.institution_id]]">
                                <input type="hidden" name="form_type" value="RATE" />
                                <input type="hidden" name="form_location" value="ARCHIVE_DETAIL" />
                            </form>
                        </div>
                    </div>
                `]]
            </div>
            <div class="mt60" id="contactInstitutionForm">
                <a class="anchor" id="contactInstitution"></a>
                <h2 class="iconTitle"><i class="fas fa-comment"></i> [[!%asi.action_contact_this_institution? &topic=`actions` &namespace=`asi`]]</h2>
                [[++contact_institution_text]]
                <div class="row">
                    <div class="col-md-7">

                        [[!FormIt?
                        &hooks=`reCaptchaV3,email,FormItSaveForm,redirect`
                        &emailTpl=`allFormMessage`
                        &emailSubject=`A message regarding [[!+archive.title:striptags]]`
                        &emailTo=`[[++contact_email]]`
                        &emailFrom=`[[++contact_email]]`
                        &formName=`Contact Archive - [[!+archive.title:striptags]]`
                        &formFields=`name,email,message`
                        &fieldNames=`name==Full name,email==Email address,message==Message`
                        &redirectTo=`24`
                        &submitVar=`contactInstitution`
                        &validate=`confirmHSL:blank`
                        ]]
                        [[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
                        <form class="standard mt20" action="[[!requestURI]]" method="post">
                            <input type="hidden" name="emailTitle" value="A new message from the APE website">
                            <input type="text" name="confirmHSL" class="confirmField" value="">
                            <p class="formError"><i class="fas fa-exclamation-triangle"></i>
                                [[!%asi.form_required_fields_empty_err_msg? &topic=`forms` &namespace=`asi`]]</p>
                            <p class="fieldLabel">[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*</p>
                            <div class="inputWrapper required">
                                <input type="text" name="name" placeholder="[[!%asi.input_ph_full_name? &topic=`label` &namespace=`asi`]]">
                                <span class="errorMessage">[[!%asi.form_full_name_required_err_msg? &topic=`forms`
                                    &namespace=`asi`]]</span>
                            </div>
                            <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
                            <div class="inputWrapper required">
                                <input type="text" name="email" placeholder="[[!%asi.input_ph_email_address? &topic=`input` &namespace=`asi`]]">
                                <span class="errorMessage">[[!%asi.form_email_address_required_err_msg? &topic=`forms`
                                    &namespace=`asi`]]</span>
                            </div>
                            <p class="fieldLabel">[[!%asi.label_your_message? &topic=`label` &namespace=`asi`]]*</p>
                            <div class="inputWrapper required">
                                <textarea class="tall" name="message" placeholder="[[!%asi.input_ph_your_message? &topic=`input` &namespace=`asi`]]"></textarea>
                                <span class="errorMessage">[[!%asi.form_message_required_err_msg? &topic=`forms`
                                    &namespace=`asi`]]</span>
                            </div>
                            [[- <div class="checkbox">
                                <input type="checkbox" name="translate" value="1">
                                <span>[[!%asi.label_translate_to? &topic=`label` &namespace=`asi`]]:</span>
                                <div class="tipSelect">
                                    <div class="selectDropdown">
                                        <div class="title">[[!%asi.eng? &topic=`language` &namespace=`asi`]]</div>
                                        <div class="inner">
                                            <a href="#">[[!%asi.fra? &topic=`language` &namespace=`asi`]]</a>
                                            <a href="#">[[!%asi.ger? &topic=`language` &namespace=`asi`]]</a>
                                            <a href="#">[[!%asi.spa? &topic=`language` &namespace=`asi`]]</a>
                                        </div>
                                    </div>
                                    [[++contact_translate_tooltip:notempty=`
                                    <div class="tipIcon" data-tooltip-content="#contactTranslateTooltip">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    `]]
                                </div>
                            </div>
                            ]]
                            <input type="submit" name="contactInstitution" value="[[!%asi.action_send_message? &topic=`actions` &namespace=`asi`]]">
                            <input type="hidden" name="recordId" value="[[!#GET.recordId]]" />
                            <input type="hidden" name="form_type" value="DIRECT" />
                            <input type="hidden" name="form_location" value="ARCHIVE_DETAIL" />
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    [[$footer]]

    [[$banners]]

    [[$tooltips]]

    [[$bookmarkPopup]]

    [[$accountNeededPopup]]

    [[$suggestionPopup]]

    <div id="optionsSlideUp" class="slideUp">
        <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
        <a onclick="history.back(-1)"><i class="far fa-angle-left"></i> [[!%asi.return_to_search? &topic=`default` &namespace=`asi`]]</a>
        [[- <a class="toggleSlideUp" href="#bookmarkPopup" data-trigger="save_bookmark"><i class="fas fa-bookmark yellow"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
        <a class="toggleSlideUp" data-trigger="suggestion" href="#suggestionPopup"><i class="fas fa-pencil blue"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
        <a class="aLink toggleSlideUp" onclick="contactInstitutionClick()"><i class="fas fa-comment pink"></i> [[!%asi.action_contact_this_institution? &topic=`actions` &namespace=`asi`]]</a>
    </div>

    <script>
        var enable_components = true; // this enables the components JS on this page
        var enable_tree = true;
        var enable_search = true; // this enables the search JS on this page
        var section = 'search-in-archives';

        const conf = {
            component_endpoint: "/asi-ajax/?action=archive_children",
            tree_endpoint: "/asi-ajax/?action=heirarchical_tree",
            repo_code: "[[!+archive.repocode:strip]]"
        }

        var repoCode = "[[!+archive.repocode:strip]]";
        var recordId = "[[!+archive.recordid:strip]]";
        var eadId = "[[!+archive.eadid:strip]]";
        var clevelId = "[[!+archive.clevelid:strip]]";
        var unitId = "[[!+archive.unitid:strip]]";
        var levelName = "[[!+archive.levelname:strip]]";
        var treeId = "[[!+archive.treeid:strip]]";
        var type = "[[!+archive.type:strip]]";
        var max = "[[!+archive.components.limit:strip]]";
        var compCurrentPg = "[[!+archive.components.page:strip]]";
        var compResultsTotal = "[[!+archive.components.resultsTotal:strip]]";
        var compPageTotal = "[[!+archive.components.pageTotal:strip]]";
    </script>

    [[!$asi_logged_in_js]]
    [[$scripts]]
    [[!+ms.successMessage]]
    <script src="assets/tree.js?[[!cache_buster]]"></script>

    <script src="https://cdn.jsdelivr.net/gh/igorlino/elevatezoom-plus@1.2.3/src/jquery.ez-plus.js"></script>

    <script>
        const compOptions = {
            currentPage: compCurrentPg ?? 1,
            totalPages: compPageTotal ?? 1,
            onPageClicked: function (e, originalEvent, type, page) {
                updateResults(page);
            }
        }

        $(document).ready(function () {
            updateResults(compCurrentPg);
        });

        $('#ComponentsPagination').bootstrapPaginator(compOptions);

        function updateResults(newPage) {
            var apiCall = `${conf.component_endpoint}&page=${newPage}&repositoryCode=${conf.repo_code}&levelName=${levelName}&recordId=${recordId}&type=${type}`;
            if (clevelId) {
                apiCall = apiCall + `&c=C${clevelId}`;
            }
            if (unitId) {
                apiCall = apiCall + `&unitId=${unitId}`;
            }
            apiCall = encodeURI(apiCall);
            $(document).find("#componentChildren").css("opacity", "0.3");

            $.ajax({
                method: "GET",
                url: apiCall,
                context: this,
                dataType: 'json'
            })
                .done(function (data) {

                    compOptions.currentPage = data.result.page;
                    compOptions.totalPages = data.result.pageTotal;
                    $("#componentChildren").html(data.result.html);

                    if (compOptions.totalPages > 1) {
                        $('#componentChildren').show();
                        $('#ComponentsPagination').bootstrapPaginator(compOptions);
                    } else {
                        $('#componentChildren').hide();
                    }
                    $(document).find("#componentChildren").css("opacity", "1");
                    $(document).find("#componentChildren").show();

                }).fail(function (err) {
                    
                }).always(function () {
                    
                    
                });
        }

        function updateTree(newPage) {
            var apiCall = `${conf.ajax_endpoint}&page=${newPage}&repositoryCode=${conf.repo_code}&levelName=${levelName}&recordId=${recordId}`;
            if (clevelId) {
                apiCall = apiCall + `&c=C${clevelId}`;
            }
            if (unitId) {
                apiCall = apiCall + `&unitId=${unitId}`;
            }
            $(document).find("#componentChildren").css("opacity", "0.3");
            $.ajax({
                method: "GET",
                url: apiCall,
                context: this,
                dataType: 'json'
            })
                .done(function (data) {
                    compOptions.currentPage = data.result.page;
                    compOptions.totalPages = data.result.pageTotal;
                    $("#componentChildren").html(data.result.html);
                    if (compOptions.totalPages > 1) {
                        $('#componentChildren').show();
                        $('#ComponentsPagination').bootstrapPaginator(compOptions);
                    } else {
                        $('#componentChildren').hide();
                    }
                    $(document).find("#componentChildren").css("opacity", "1");
                    $(document).find("#componentChildren").show();
                }).fail(function (err) {
                    
                });
        }

        $(".switchModals").click(function (e) {
            $("#bookmarkPopup").modal('hide');
            setTimeout(function () {
                $("#bookmarkAddedPopup").modal('show');
            }, 800);
            e.preventDefault();
        });
    </script>
    

</body>

</html>
