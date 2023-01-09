<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
        <style>

            ul.level {
                padding-left: 10px;
                list-style: disc;
            }
            a.displayLinkShowMore.linkShow {
                color: #b23063;
                font-weight: 700;
            }
            a.displayLinkShowLess.linkShow {
                color: #b23063;
                font-weight: 700;
                /*display: none;*/
            }

            .rightcolumn a {
                color: #b23063;
                font-weight: 700;
            }


        </style>
</head>
<body>
[[$header]]

[[!asi_search_result_detail?&section=`search-in-names`]]

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
                   [[- <div class="buttonDropdown">
                        <a class="button blue"><i class="fas fa-download"></i><span class="hidden-xs"> [[!%asi.tools_download_link? &topic=`default` &namespace=`asi`]]</span></a>
                        <div class="inner">
                            <a><i class="fas fa-file-download"></i> [[!%asi.action_download_pdf? &topic=`actions` &namespace=`asi`]]</a>
                            <a><i class="fas fa-file-export"></i> [[!%asi.tools_export? &topic=`default` &namespace=`asi`]]</a>
                            <a href="#" onclick="window.print();"><i class="fas fa-print"></i> [[!%asi.tools_print? &topic=`default` &namespace=`asi`]]</a>
                        </div>
                    </div>]]
                </div>
            </div>
            <div class="right">
              [[-  <a class="yellowIcon" href="#bookmarkPopup" data-trigger="save_bookmark"><i class="fas fa-bookmark mr"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
                <a class="pinkIcon" href="#suggestionPopup" data-trigger="suggestion"><i class="fas fa-pencil mr"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
                <a class="blueIcon" onclick="contactInstitutionClick()"><i class="fas fa-comment mr"></i> [[!%asi.action_contact_institution? &topic=`actions` &namespace=`asi`]]</a>
            </div>
        </div>
    </div>
</div>

<section id="innerHero">
    <div class="container">
        <a class="returnLink" onclick="history.back(-1)"><i class="far fa-angle-left mr"></i> [[!%asi.return_to_search? &topic=`default` &namespace=`asi`]]</a>
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[!+name.title]]</h1>
            <span class="date">
              <span class="nameType"><i class="fas [[!+name_icon]]"></i> [[!%asi.[[!+name_description]]? &topic=`solr` &namespace=`asi`]]</span>
                [[!+search_result.entity_type]]
                <span class="pipe">|</span>

                [[!+name.lifedates]]
            </span>
            <span class="ref"><strong>[[!%asi.results_identifier? &topic=`default` &namespace=`asi`]]:</strong> [[!#GET.recordId]]</span>
        </div>
        <div class="buttons">
            <a class="button blue visible-xs visible-sm toggleSlideUp viewContext" href="#affix"><i class="fas fa-sitemap"></i>[[!%asi.view_context? &topic=`default` &namespace=`asi`]]</a>
            <a class="button blue visible-xs visible-sm toggleSlideUp" href="#optionsSlideUp"><i class="fas fa-cogs"></i></a>
          [[-  <a class="button blue hidden-xs hidden-sm" href="#bookmarkPopup" data-trigger="save_bookmark"><i class="fas fa-bookmark"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a> ]]
            <a class="button blue hidden-xs hidden-sm" href="#suggestionPopup" data-trigger="suggestion"><i class="fas fa-pencil"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
            <a class="button blue hidden-xs hidden-sm" onclick="contactInstitutionClick()"><i class="fas fa-comment"></i> [[!%asi.action_contact_institution? &topic=`actions` &namespace=`asi`]]</a>
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
                    <a><i class="fas fa-file-download"></i> [[!%asi.action_download_pdf? &topic=`actions` &namespace=`asi`]]</a>
                    <a><i class="fas fa-file-export"></i> [[!%asi.tools_export? &topic=`default` &namespace=`asi`]]</a>
                    <a href="#" onclick="window.print();"><i class="fas fa-print"></i> [[!%asi.tools_print? &topic=`default` &namespace=`asi`]]</a>
                </div>
            </div>]]
        </div>
        <a class="originalLink" href="#" target="_blank">[[!%asi.view_orig_presentation? &topic=`default` &namespace=`asi`]] <i class="far fa-external-link-alt ml"></i></a>
    </div>
</section>

<section id="resultContainer" class="clearfix" style="display:flex; align-items:stretch; background-color:white;">
    <div class="left slideIn" id="affix--" style="background:#f7f7f7;">
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
        [[!+archives.items:notempty=`
        <div class="groups">
            <h4>[[!%asi.archival_materials? &topic=`default` &namespace=`asi`]] ([[!+archives.count]])</h4>
            <ul class="materials">
                [[!+archives.items]]
            </ul>
        </div>
        `]]
        [[!+relatedNames.items:notempty=`
        <div class="groups">
            <h4>[[!%asi.related_names? &topic=`default` &namespace=`asi`]] ( [[!+relatedNames.count]])</h4>
            <ul class="materials">
                [[!+relatedNames.items]]
            </ul>
        </div>
        `]]
    </div>
    <div class="right" style="margin-top:unset;border-top:5px solid #f7f7f7">
        [[-
            Data returned by APE API
        ]]
        <div id="nameContent">
            [[!+result_details]]
        </div>
        <hr>


        [[!+search_result.other_identifier_html]]
        [[!+search_result.last_updated_html]]

        <div class="mt60">
            <a class="anchor" id="rateContent"></a>
            <h2 class="iconTitle"><i class="fas fa-thumbs-up"></i> [[!%asi.action_rate_this_content? &topic=`actions` &namespace=`asi`]]</h2>

            [[!FormIt?
                &hooks=`reCaptchaV3,email,FormItSaveForm`
                &emailTpl=`allFormMessage`
                &emailSubject=`Content Rating (Names)`
                &emailUseFieldForSubject=`1`
                &emailTo=`[[++contact_email]]`
                &emailFrom=`[[++contact_email]]`
                &formName=`Content Rating (Names)`
                &formFields=`rating,feedback,repositoryCode,nameid`
                &fieldNames=`rating==Rating,feedback==Feedback (if any),repositoryCode=RepositoryCode,nameid=Name ID`
                &successMessage=`[[!%asi.form_rating_success_msg? &topic=`forms` &namespace=`asi`]]`
                &submitVar=`sendRating`
                &validate=`confirmEFm:blank`
            ]]
            [[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
            [[!+fi.successMessage:notempty=`<h5>[[+fi.successMessage]]</h5>`:default=`
                [[++rate_content_text]]
                <div class="row">
                    <div class="col-md-7">
                        <form class="standard mt20" id="rateForm" action="[[!requestURI]]#rateContent" method="post">
                            <input type="hidden" name="subject" value="Content Rating (Names): [[!+name.title:striptags]]"/>
                            <input type="hidden" name="emailTitle" value="Content (Name) has been rated">
                            <input type="hidden" name="repositoryCode" value="[[!+name.repocode]]"/>
                            <input type="hidden" name="nameid" value="[[!+name.id]]"/>
                            <input type="hidden" name="institutionLink" value="[[++site_url]]advanced-search/search-in-institutions/results-(institutions)/?&repositoryCode=[[!+name.repocode]]">
                            <input type="text" name="confirmEFm" class="confirmField">

                            <div class="rating">
                                <input type="radio" name="rating" value="Good" class="good">
                                <input type="radio" name="rating" value="Neutral" class="neutral">
                                <input type="radio" name="rating" value="Bad" class="bad">
                            </div>

                            <div class="hiddenContent">
                                <div class="title"><strong>[[!%asi.action_add_feedback? &topic=`actions` &namespace=`asi`]]</strong> <i class="far fa-angle-down"></i></div>
                                <div class="inner">
                                    <div class="inputWrapper">
                                        <textarea name="feedback" placeholder="[[!%asi.input_your_feedback? &topic=`input` &namespace=`asi`]]"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input class="disabled" type="submit" name="sendRating" value="[[!%asi.action_send_rating? &topic=`actions` &namespace=`asi`]]">
                            <input type="hidden" name="institution_id" value="[[!+search_result.institution_id]]" />
                            <input type="hidden" name="form_type" value="RATE" />
                            <input type="hidden" name="form_location" value="NAME_DETAIL" />
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
                    &emailSubject=`Contact Form (Names): [[!+name.title]]`
                    &emailUseFieldForSubject=`1`
                    &emailTo=`[[++contact_email]]`
                    &emailFrom=`[[++contact_email]]`
                    &formName=`Contact (Names)`
                    &formFields=`name,email,message,repositoryCode,recordid`
                    &fieldNames=`name==Full name,email==Email address,message==Message,repositoryCode=RepositoryCode,recordid=Name ID`
                    &redirectTo=`24`
                    &submitVar=`contactInstitution`
                    &validate=`confirmEFm:blank`
                ]]
                    [[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
                    <form class="standard mt20" action="[[!requestURI]]" method="post">
                        <input type="hidden" name="subject" value="Contact Form (Names): [[!+name.title]]"/>
                        <input type="hidden" name="emailTitle" value="A new message from the Name's Contact Form">
                        <input type="hidden" name="repositoryCode" value="[[!+name.repocode]]"/>
                        <input type="hidden" name="recordid" value="[[!+name.id]]"/>
                        <input type="hidden" name="institutionLink" value="[[++site_url]]advanced-search/search-in-institutions/results-(institutions)/?&repositoryCode=[[!+name.repocode]]">
                        <input type="text" name="confirmEFm" class="confirmField" value="">
                        
                        <p class="formError"><i class="fas fa-exclamation-triangle"></i> [[!%asi.form_required_fields_empty_err_msg? &topic=`forms` &namespace=`asi`]]</p>

                        <p class="fieldLabel">[[!%asi.label_full_name? &topic=`label` &namespace=`asi`]]*</p>
                        <div class="inputWrapper required">
                            <input type="text" name="name" placeholder="[[!%asi.input_ph_full_name? &topic=`label` &namespace=`asi`]]">
                            <span class="errorMessage">[[!%asi.form_full_name_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                        </div>
                         <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
                        <div class="inputWrapper required">
                            <input type="text" name="email" placeholder="[[!%asi.input_ph_email_address? &topic=`input` &namespace=`asi`]]">
                            <span class="errorMessage">[[!%asi.form_email_address_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
                        </div>
                        <p class="fieldLabel">[[!%asi.label_your_message? &topic=`label` &namespace=`asi`]]*</p>
                        <div class="inputWrapper required">
                            <textarea class="tall" name="message" placeholder="[[!%asi.input_ph_your_message? &topic=`input` &namespace=`asi`]]"></textarea>
                            <span class="errorMessage">[[!%asi.form_message_required_err_msg? &topic=`forms` &namespace=`asi`]]</span>
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
                        <input type="hidden" name="form_location" value="NAME_DETAIL" />
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
   [[- <a class="toggleSlideUp" data-trigger="save_bookmark" href="#bookmarkPopup"><i class="fas fa-bookmark yellow"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
    <a class="toggleSlideUp" data-trigger="suggestion" href="#suggestionPopup"><i class="fas fa-pencil blue"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
    <a class="toggleSlideUp" onclick="contactInstitutionClick()"><i class="fas fa-comment pink"></i> [[!%asi.action_contact_this_institution? &topic=`actions` &namespace=`asi`]]</a>
</div>

<script>
    var enable_search = true; // this enables the search JS on this page
    var section = 'search-in-names';
</script>
[[!$asi_logged_in_js]]
[[$scripts]]
[[!+ms.successMessage]]

<script src="https://cdn.jsdelivr.net/gh/igorlino/elevatezoom-plus@1.2.3/src/jquery.ez-plus.js"></script>
<script>
    $(".switchModals").click(function(e){
        $("#bookmarkPopup").modal('hide');
        setTimeout(function(){
            $("#bookmarkAddedPopup").modal('show');
        }, 800);
        e.preventDefault();
    });

    function setupShowHide() {
        var moreItems = document.getElementsByClassName("moreDisplay");
        moreItems.forEach(myFunction);
    }
    function myFunction(item) {
        sum += item;
    }


    $(".displayLinkShowLess").addClass("hidden");
        $('.displayLinkShowMore').addClass("hidden");
        $(".moreDisplay").each(function (index) {
            if ($(this).find('p').length > 3) {
                $(this).find('.displayLinkShowMore').removeClass("hidden");
                $(this).find('p').each(function (index) {
                    if (index > 2) {
                        $(this).addClass("hidden");
                    }
                });
            } else if ($(this).find('li.item').length > 3) {
                $(this).find('.displayLinkShowMore').removeClass("hidden");
                $(this).find('li.item').each(function (index) {
                    if (index > 2) {
                        $(this).addClass("hidden");
                    }
                });
            } else {
                $(this).find('.displayLinkShowMore').addClass("hidden");
            }
        });

    /**
     * Function to show more eac-cpf details
     * @param clazz
     * @param id
     */
    function showLess(className, id){
        
        
        var prefix = "#" + className + " ";
        $(prefix + ".displayLinkShowLess").click(function(){
            $(this).addClass("hidden");
            $(prefix + ".displayLinkShowMore").removeClass("hidden");
            $(prefix + id).each(function(index){
                if (index > 2){
                    $(this).addClass("hidden");
                }
            });
        });
        $(prefix + ".displayLinkShowLess").trigger("click");
        sameHeight();
    }

    /**
     * Function to show less eac-cpf details
     * @param className
     * @param id
     */
    function showMore(className, id){
        var prefix = "#" + className + " ";
        $(prefix + ".displayLinkShowMore").click(function(){
            $(this).addClass("hidden");
            $(prefix + ".displayLinkShowLess").removeClass("hidden");
            $(prefix + id).each(function(index){
                if(index > 2){
                    $(this).removeClass("hidden");
                }
            });
        });
        $(prefix + ".displayLinkShowMore").trigger("click");
        sameHeight();
    }

    /**
     * Function to assign the same height that its container
     */
    function sameHeight() {
        $('#eacCpfDisplayPortlet .row').each(function() {
            if(!$(this).is( ":hidden" )){
                $(this).css("height", "");
                $(this).children().css("height", "");
                var height = $(this).height();
                if(height == "auto"){
                    height = $(this).css("height");
                }
                $(this).children().css("height", height);
            }
        });
    }
</script>

</body>
</html>
