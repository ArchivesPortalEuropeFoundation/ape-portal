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

[[+archive.gallery.slider:notempty=`
<div class="contentDropdown full open">
    <div class="title galleryDropdown">
        <h2>[[!%asi.title_digital_objects? &topic=`default` &namespace=`asi`]]</h2>
    </div>
    <hr>
    <div class="inner" style="display: block;">
        [[-[[!+archive.gallery.tab:neq=``:then=`
        <div class="view">
            <strong>[[!%asi.view_doc_label? &topic=`default` &namespace=`asi`]]: </strong>
            <ul class="nav-tabs">
                <li class="active"><a href="#tabGallerySlider" data-toggle="tab"><i class="fas fa-images"></i></a></li>
                <li><a href="#tabGalleryList" data-toggle="tab"><i class="fas fa-list"></i></a></li>
            </ul>
        </div>
        `]]]]
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
        &hooks=`reCaptchaV3,email,FormItSaveForm,removePost`
        &emailTpl=`allFormMessage`
        &emailSubject=`Content Rating (Archives)`
        &emailUseFieldForSubject=`1`
        &emailTo=`[[++contact_email]]`
        &emailFrom=`[[++contact_email]]`
        &formName=`Content Rating (Archives)`
        &formFields=`rating,feedback,repositoryCode,archiveid,unitid,clevelid`
        &fieldNames=`rating==Rating,feedback==Feedback (if any),repositoryCode=RepositoryCode,archiveid=Archive ID,unitid=UnitId,clevelid=CLevelId`
        &successMessagePlaceholder=`ms.successMessage`
        &successMessage=`<script>$("#ratingSentPopup").modal('show');</script>`
        &submitVar=`sendRating`
        &placeholderPrefix=`fa.`
        &validate=`rating:required,confirmHDY:blank`
        &validationErrorMessage=`[[!%asi.form_validation_error? &topic=`forms` &namespace=`asi`]]`
    ]]
    [[!+fi.error.captcha:isnotempty=`<h5 style="color: #c92828;margin-bottom: 10px;">[[+fi.error.captcha]]</h5>`]]
    [[!+fa.validation_error_message:isnotempty=`<h5 style="color: #c92828;margin-bottom: 10px;">[[+fa.validation_error_message]]</h5>`]]
    [[++rate_content_text]]
        <div class="row">
            <div class="col-md-7">
                <form class="standard mt20" id="rateForm" action="[[+request_uri]]" method="post">
                    <input type="hidden" name="subject" value="Content Rating (Archives): [[!+archive.title:striptags]]"/>
                    <input type="hidden" name="emailTitle" value="Content (Archive) has been rated">
                    <input type="hidden" name="repositoryCode" value="[[!+archive.repocode]]"/>
                    <input type="hidden" name="archiveid" value="[[!+archive.recordid]]"/>
                    <input type="hidden" name="unitid" value="[[!+archive.unitid]]"/>
                    <input type="hidden" name="clevelid" value="[[!+archive.clevelid]]"/>
                    <input type="hidden" name="institutionLink" value="[[++site_url]]advanced-search/search-in-institutions/results-(institutions)/?&repositoryCode=[[!+archive.repocode]]">

                    <input type="text" name="confirmHDY" class="confirmField" value="">
                    <div class="rating">
                        <input type="radio" name="rating" value="Good" class="good">
                        <input type="radio" name="rating" value="Neutral" class="neutral">
                        <input type="radio" name="rating" value="Bad" class="bad">
                    </div>
                    <div class="hiddenContent">
                        <div class="title"><strong>[[!%asi.action_add_feedback? &topic=`actions` &namespace=`asi`]]</strong>
                            <i class="far fa-angle-down"></i></div>
                        <div class="inner">
                            <div class="inputWrapper">
                                        <textarea name="feedback"
                                                placeholder="[[!%asi.input_your_feedback? &topic=`input` &namespace=`asi`]]"></textarea>
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
</div>
<div class="mt60" id="contactInstitutionForm">
    <a class="anchor" id="contactInstitution"></a>
    <h2 class="iconTitle"><i class="fas fa-comment"></i> [[!%asi.action_contact_this_institution? &topic=`actions` &namespace=`asi`]]</h2>
    [[++contact_institution_text]]
    <div class="row">
        <div class="col-md-7">

            [[!FormIt?
            &hooks=`reCaptchaV3,email,FormItSaveForm`
            &emailTpl=`allFormMessage`
            &emailSubject=`Contact Form (Archives)`
            &emailUseFieldForSubject=`1`
            &emailTo=`[[++contact_email]]`
            &emailFrom=`[[++contact_email]]`
            &formName=`Contact Form (Archives)`
            &formFields=`name,email,message,repositoryCode,archiveid,unitid,clevelid`
            &fieldNames=`name==Full name,email==Email address,message==Message,repositoryCode=RepositoryCode,archiveid=Archive ID,unitid=UnitId,clevelid=CLevelId`
            &submitVar=`contactInstitution`
            &placeholderPrefix=`fo.`
            &successMessagePlaceholder=`ms.successMessage`
            &successMessage=`<script>$("#contactInstitutionSentPopup").modal('show');</script>`
            &validate=`confirmHSL:blank`
            &validationErrorMessage=`[[!%asi.form_validation_error? &topic=`forms` &namespace=`asi`]]`
            ]]
            [[!+fi.error.captcha:isnotempty=`<h5 style="color: #c92828;margin-bottom: 10px;">[[+fi.error.captcha]]</h5>`]]
            [[!+fo.validation_error_message:isnotempty=`<h5 style="color: #c92828;margin-bottom: 10px;">[[+fo.validation_error_message]]</h5>`]]
            <form class="standard mt20" action="[[+request_uri]]" method="post">
                <input type="hidden" name="subject" value="Contact Form (Archives): [[!+archive.title:striptags]]"/>
                <input type="hidden" name="emailTitle" value="A new message from the Archive's Contact Form">
                <input type="hidden" name="repositoryCode" value="[[!+archive.repocode]]"/>
                <input type="hidden" name="archiveid" value="[[!+archive.recordid]]"/>
                <input type="hidden" name="unitid" value="[[!+archive.unitid]]"/>
                <input type="hidden" name="clevelid" value="[[!+archive.clevelid]]"/>
                <input type="hidden" name="institutionLink" value="[[++site_url]]advanced-search/search-in-institutions/results-(institutions)/?&repositoryCode=[[!+archive.repocode]]">
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
<script>
    gRecap();

    $('#rateForm .rating input').click(function () {
        if ($(this).is('.checked')) {
            $(this).removeAttr('checked');
            $(this).removeClass('checked');
            $('#rateForm input[type="submit"]').addClass('disabled');

            var field = $('.hiddenContent');
            if (field.hasClass('open')) {
                field.toggleClass('open');
                field.children('.inner').slideToggle(300, 'swing');

                var txtarea = $('.hiddenContent textarea');
                txtarea.val('');
            }

        } else {
            $('#rateForm .rating input').removeClass('checked');
            $(this).addClass('checked');
            if ($(this).hasClass('bad') || $(this).hasClass('neutral')){
                var field = $('.hiddenContent');
                if (!field.hasClass('open')) {
                    field.toggleClass('open');
                    field.children('.inner').slideToggle(300, 'swing');
                }

                var txtarea = $('.hiddenContent textarea');
                if (txtarea.val().length >= 10) {
                    $('#rateForm input[type="submit"]').removeClass('disabled');
                }
                else {
                    $('#rateForm input[type="submit"]').addClass('disabled');
                }
            }
            else {
                var field = $('.hiddenContent');
                if (field.hasClass('open')) {
                    field.toggleClass('open');
                    field.children('.inner').slideToggle(300, 'swing');

                    var txtarea = $('.hiddenContent textarea');
                    txtarea.val('');
                }

                $('#rateForm input[type="submit"]').removeClass('disabled');
            }
        }
    });

    $('#rateForm input[name="rating"]').on('change', function (e) {

        if ($('#rateForm input[name="rating"]:checked').val()) {
            var mood = $('#rateForm input[name="rating"]:checked').val();
            if (mood == 'Good'){
                $('#rateForm input[type="submit"]').removeClass('disabled');
            }
            else {
                var txtarea = $('.hiddenContent textarea');
                if (txtarea.val().length >= 10) {
                    $('#rateForm input[type="submit"]').removeClass('disabled');
                }
                else {
                    $('#rateForm input[type="submit"]').addClass('disabled');
                }
            }
        }
    });

    $('.hiddenContent textarea').keyup(function() {
        var mood = $('#rateForm input[name="rating"]:checked').val();
        if (mood == 'Good'){
            $('#rateForm input[type="submit"]').removeClass('disabled');
        }
        else {
            var txtarea = $('.hiddenContent textarea');
            if (txtarea.val().length >= 10) {
                $('#rateForm input[type="submit"]').removeClass('disabled');
            }
            else {
                $('#rateForm input[type="submit"]').addClass('disabled');
            }
        }
    });

    $('.hiddenContent > .title').click(function () {
        var parent = $(this).parent();
        $(parent).toggleClass('open');
        $(parent).children('.inner').slideToggle(300, 'swing');
    });
</script>
