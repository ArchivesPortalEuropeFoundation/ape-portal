<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]

        <style>
            h3 {
                font-size: 28px;
                font-weight: normal;
            }
            h3 a {
                color: #b23063;
                font-weight: 700;
                cursor: pointer;
                transition: 0.3s ease-in-out 0s;
            }

            h3 a:hover {
                color: #b23063;
                font-weight: 700;
                cursor: pointer;
                transition: 0.3s ease-in-out 0s;
            }
           #archivalMaterials h3 a.displayLinkSeeLess {
                display: none;
            }
            table.aiSection tr td:first-child {
                min-width: 260px;
                max-width: 260px;
                padding-right: 10px;
                font-weight: bold;
            }
            .pagination {
                display: block;
            }
            .searchFilterBtn {
                width: 15%;
                display: inline-block;
                padding: 10px 15px 10px 25px!important;

            }
            button.button.blue {
                background-color: #178aa8;
                padding: 10px 15px 10px 15px!important;
                border-style: none;
                color: white;
            }
            button.button.blue:hover, button.button.blue.active {
                background-color: #b23063;
            }
            .searchFilterInput {
                display: inline-block!important;
                width: 80%!important;
                padding: 10px 15px 10px 25px;
                height: 42px;
                font-size: 13px;
                color: #000;
                border: none;
                border-bottom: 1px solid #aeaeae !important;
                background-color: #f7f7f7!important;
            }
            .linkButton.nolink {
                opacity: 0.4;
                cursor: not-allowed;
            }
            .archivalMaterials.longDisplay {
                padding-top: 20px;
            }

        </style>
	</head>
	<body id="instTpl">
[[$header]]

[[!asi_search_result_detail? &section=`search-in-institutions`]]
<div class="altSlideOut replace">
    <div class="container">
        <div class="clearfix">
            <div class="left">
                <a onclick="history.back(-1)" class="hidden-xs"><i class="far fa-angle-left mr"></i> [[!%asi.return_to_search? &topic=`default` &namespace=`asi`]]</a>
                <div class="buttons visible-xs">
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

<section id="innerHero" style="margin-bottom: 20px;">
    <div class="container">
        <a class="returnLink" onclick="history.back(-1)"><i class="far fa-angle-left mr"></i> [[!%asi.return_to_search? &topic=`default` &namespace=`asi`]]</a>
        [[$breadcrumbs]]
        <div class="content">
            <h1 data-populate="branch_name">[[!+institution.name]]</h1>
        </div>

        <div class="buttons">
            <a class="button blue visible-xs toggleSlideUp" href="#optionsSlideUp"><i class="fas fa-cogs"></i></a>
          [[-  <a class="button blue hidden-xs hidden-sm" href="#bookmarkPopup" data-trigger="save_bookmark"><i class="fas fa-bookmark"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
            <a class="button blue hidden-xs" href="#suggestionPopup" data-trigger="suggestion"><i class="fas fa-pencil"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
            <a class="button blue hidden-xs" onclick="contactInstitutionClick()"><i class="fas fa-comment"></i> [[!%asi.action_contact_institution? &topic=`actions` &namespace=`asi`]]</a>
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
        
        <div class="branch_switch" style="margin-top: 30px;">
            <div style="margin-right:10px">
                [[!%asi.change_office? &topic=`default` &namespace=`asi`]]: 
            </div>
            <div class="selectDropdown" style="min-width: 200px; display: block;">
                <div class="title">
                    [[!+institution.agency_name_shortened]]
                </div>
                <div class="inner">
                    [[!+selector]]
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mapContainer" id="mapContainer" style="margin-top: 45px;">
                    <div id="google_map_main" class="google_map" data-google-map="true" data-key="[[!+search_result.map_key]]" style="position: relative; background-color: #EEE; background-image: url('/assets/images/map-placeholder.jpg'); cursor: pointer; height: 320px; width: 100%; display: flex; align-items: center; justify-content: center;background-position: center; background-size: cover;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="standard" style="margin-top: 30px;">
    [[!+branches]]
</section>

[[!+institution.archival_materials:gt=`0`:then=`
<section class="lightGreyHalfMargin" id="archivalMaterials">
    <div class="container">


        

        <h3>[[!%asi.archival_materials_cap? &topic=`label` &namespace=`asi`]] <a class="archivalMaterials displayLinkSeeMore" onclick="seeMoreMaterials('archivalMaterials')">(See more)</a><a class="archivalMaterials displayLinkSeeLess" href="javascript:seeLessMaterials('archivalMaterials');">(See less)</a></h3>
        <br/>

        [[!+institution.finding_aids:notempty=`
        <div class="archivalMaterials longDisplay" style="display: none;">
            <div class="title row closed" style="margin-top: 15px;">
                <div class="col-sm-6">
                    <h3>[[!%asi.finding_aids? &topic=`search` &namespace=`asi`]]</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-right">
                        <div class="searchLight">
                            <div class="inputWrapper">
                                <input data-filter-type="search_filter" data-filter-target="fa" type="text" id="faSearchInput" class="searchFilterInput" name="search" placeholder="[[!%asi.input_ph_find_finding_aids? &topic=`input` &namespace=`asi`]]">
                                <button id="faSearchBtn" class="button blue" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner" style="display:block; margin-bottom: 15px;">
                <div id="faContent"></div>
                <div id="findingAidsPagination"></div>
            </div>
        </div>
        `]]
        [[!+institution.holding_guides:notempty=`
        <div class="archivalMaterials longDisplay" style="display: none;">
            <div class="title row closed" style="margin-top: 15px;">
                <div class="col-sm-6">
                    <h3>[[!%asi.holding_guides? &topic=`search` &namespace=`asi`]]</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-right">
                        <div class="searchLight">
                            <div class="inputWrapper">
                                <input data-filter-type="search_filter" data-filter-target="hg" type="text" id="hgSearchInput" class="searchFilterInput" name="search" placeholder="[[!%asi.input_ph_find_holding_guides? &topic=`input` &namespace=`asi`]]">
                                <button id="hgSearchBtn" class="button blue" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner" style="display:block; margin-bottom: 15px;">
                <div id="hgContent"></div>
                <div id="holdingGuidesPagination"></div>
            </div>
        </div>
        `]]
        [[!+institution.source_guides:notempty=`
        <div class="archivalMaterials longDisplay" style="display: none;">
            <div class="title row closed" style="margin-top: 15px;">
                <div class="col-sm-6">
                    <h3>[[!%asi.source_guides? &topic=`search` &namespace=`asi`]]</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-right">
                        <div class="searchLight">
                            <div class="inputWrapper">
                                <input data-filter-type="search_filter" data-filter-target="sg" type="text" id="sgSearchInput" class="searchFilterInput" name="search" placeholder="[[!%asi.input_ph_find_source_guides? &topic=`input` &namespace=`asi`]]">
                                <button id="sgSearchBtn" class="button blue" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner" style="display:block; margin-bottom: 15px;">
                <div id="sgContent"></div>
                <div id="sourceGuidesPagination"></div>
            </div>
        </div>
        `]]
        [[!+institution.names_items:notempty=`
        <div class="archivalMaterials longDisplay" style="display: none;">
            <div class="title row closed" style="margin-top: 15px;">
                <div class="col-sm-6">
                    <h3>[[!%asi.names? &topic=`search` &namespace=`asi`]]</h3>
                </div>
                <div class="col-sm-6">
                    <div class="text-right">
                        <div class="searchLight">
                            <div class="inputWrapper">
                                <input data-filter-type="search_filter" data-filter-target="ec" type="text" id="ecSearchInput" class="searchFilterInput" name="search" placeholder="[[!%asi.input_ph_find_names? &topic=`input` &namespace=`asi`]]">
                                <button id="ecSearchBtn" class="button blue" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner" style="display:block; margin-bottom: 15px;">
                <div id="ecContent"></div>
                <div id="namesPagination"></div>
            </div>
        </div>
        `]]
            </div>
        </div>
    </div>
</section>
`]]

        
<section id="otherInfo" class="halfTopMargin">
    <div class="container">
        <div class="contentDropdown full open">
            <hr>

            <div class="inner" style="display:block;">
                <div class="content">
                    [[!+institution.other_info]]
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
   &hooks=`reCaptchaV3,email,FormItSaveForm,redirect`
   &emailTpl=`allFormMessage`
   &emailSubject=`A message regarding [[*pagetitle]]`
   &emailTo=`[[++contact_email]]`
   &emailFrom=`[[++contact_email]]`
   &formName=`Contact Institution - [[*pagetitle]]`
   &formFields=`name,email,message`
   &fieldNames=`name==Full name,email==Email address,message==Message`
   &redirectTo=`24`
   &submitVar=`contactInstitution`
   &validate=`confirmHSL:blank`
]]                
                [[!+fi.error.captcha:isnotempty=`<p>[[+fi.error.captcha]]</p>`]]
                    <form class="standard mt20" id="instituteContact" action="[[!requestURI]]" method="post">
                        <input type="hidden" name="emailTitle" value="A new message from the APE website">
                        <input type="text" name="confirmHSL" class="confirmField" value="">
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
                        [[-<div class="checkbox">
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
                        <input type="hidden" name="institution_id" value="[[!+search_result.institution_id]]" />
                        <input type="hidden" name="form_type" value="DIRECT" />
                        <input type="hidden" name="form_location" value="INSTITUTION_DETAIL" />
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

[[!$asi_logged_in_js]]
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsCYdkOj0EesQUEVCLlh_gdnd3zwaCZG8"></script>


[[$scripts]]
<script>
    const conf = {
        ajax_endpoint: "/asi-ajax/?action=institute_archival_materials",
        repo_code: "[[!+institution.repo_code]]"
    }

    var scrollClass = "[[!+scroll]]";
    var map_key = "[[!++gmaps_api_key]]";
    var enable_search = true; // this enables the search JS on this page
    var section = 'search-in-archives';
    var current_map_lng = Number("[[!+institution.longitude]]");
    var current_map_lat = Number("[[!+institution.latitude]]");

    var max = "[[!+institution.finding_aids_pagination.limit]]";

    var faCurrentPg = "[[!+institution.finding_aids_pagination.page]]";
    var faResultsTotal = "[[!+institution.finding_aids_pagination.resultsTotal]]";
    var faPageTotal = "[[!+institution.finding_aids_pagination.pageTotal]]";

    var hgCurrentPg = "[[!+institution.holding_guides_pagination.page]]";
    var hgResultsTotal = "[[!+institution.holding_guides_pagination.resultsTotal]]";
    var hgPageTotal = "[[!+institution.holding_guides_pagination.pageTotal]]";

    var sgCurrentPg = "[[!+institution.source_guides_pagination.page]]";
    var sgResultsTotal = "[[!+institution.source_guides_pagination.resultsTotal]]";
    var sgPageTotal = "[[!+institution.source_guides_pagination.pageTotal]]";

    var ecCurrentPg = "[[!+institution.names_items_pagination.page]]";
    var ecResultsTotal = "[[!+institution.names_items_pagination.resultsTotal]]";
    var ecPageTotal = "[[!+institution.names_items_pagination.pageTotal]]";

    var faSearch = '';
    var sgSearch = '';
    var hgSearch = '';
    var ecSearch = '';
</script>
<script>
    const faOptions = {
        currentPage: faCurrentPg,
        totalPages: faPageTotal,
        onPageClicked: function(e,originalEvent,type,page){
            console.log(type);
            console.log('Page no:'+page);
            updateResults('fa', page, faSearch);
        }
    }

    $('#findingAidsPagination').bootstrapPaginator(faOptions);

    var hgOptions = {
        currentPage: hgCurrentPg,
        totalPages: hgPageTotal,
        onPageClicked: function(e,originalEvent,type,page){
            updateResults('hg', page, hgSearch);
        }
    }

    $('#holdingGuidesPagination').bootstrapPaginator(hgOptions);

    var sgOptions = {
        currentPage: sgCurrentPg,
        totalPages: sgPageTotal,
        onPageClicked: function(e,originalEvent,type,page){
            updateResults('sg', page, sgSearch);
        }
    }

    $('#sourceGuidesPagination').bootstrapPaginator(sgOptions);

    var ecOptions = {
        currentPage: ecCurrentPg,
        totalPages: ecPageTotal,
        onPageClicked: function(e,originalEvent,type,page){
            updateResults('ec', page, ecSearch);
        }
    }

    $('#namesPagination').bootstrapPaginator(ecOptions);

    $(document).ready(function () {
        updateResults('fa', faCurrentPg, faSearch);
        updateResults('hg', hgCurrentPg, hgSearch);
        updateResults('sg', sgCurrentPg, sgSearch);
        updateResults('ec', ecCurrentPg, ecSearch);
        if(scrollClass) {
            var container = $("html,body");
            var scrollName = '#'+scrollClass;
            var scrollTo = $(scrollName);
            if(scrollClass === 'archivalMaterials') {
                seeMoreMaterials('archivalMaterials');
                $('html, body').animate({
                    scrollTop: $(archivalMaterials).offset().top-50
                }, 1000);
                console.log('Scrolled Here: '+scrollName);
            }
        }
    });

    function contactInstitutionClick() {
        $('html, body').animate({
            scrollTop: $('#contactInstitutionForm').offset().top-50
        }, 1000);
    }

    function updateResults(type,newPage, search) {
        var prevHeight = document.documentElement.scrollHeight;
        var prevPosition = document.documentElement.scrollTop;
        $.ajax({
            method: "GET",
            url: `${conf.ajax_endpoint}&page=${newPage}&repositoryCode=${conf.repo_code}&type=${type}&search=${search}`,
            context: this,
            dataType: 'json'
        })
            .done(function (data) {
                if(type === 'fa') {
                    faOptions.currentPage = data.result.page;
                    faOptions.totalPages = data.result.pageTotal;
                    if(faOptions.totalPages > 1) {
                        $('#findingAidsPagination').show();
                        $('#findingAidsPagination').bootstrapPaginator(faOptions);
                    } else {
                        $('#findingAidsPagination').hide();
                    }
                }
                if(type === 'sg') {
                    sgOptions.currentPage = data.result.page;
                    sgOptions.totalPages = data.result.pageTotal;
                    if(sgOptions.totalPages > 1) {
                        $('#sourceGuidesPagination').show();
                        $('#sourceGuidesPagination').bootstrapPaginator(sgOptions);
                    } else {
                        $('#sourceGuidesPagination').hide();
                    }
                }
                if(type === 'hg') {
                    hgOptions.currentPage = data.result.page;
                    hgOptions.totalPages = data.result.pageTotal;
                    if(hgOptions.totalPages > 1) {
                        $('#holdingGuidesPagination').show();
                        $('#holdingGuidesPagination').bootstrapPaginator(hgOptions);
                    } else {
                        $('#holdingGuidesPagination').hide();
                    }
                }
                if(type === 'ec') {
                    ecOptions.currentPage = data.result.page;
                    ecOptions.totalPages = data.result.pageTotal;
                    if(ecOptions.totalPages > 1) {
                        $('#namesPagination').show();
                        $('#namesPagination').bootstrapPaginator(ecOptions);
                    } else {
                        $('#namesPagination').hide();
                    }
                }
                $("#"+type+"Content").html(data.result.html);
                var newHeight = document.documentElement.scrollHeight;
                adjustHeight = prevHeight - newHeight;
                adjustPosition = prevPosition - adjustHeight;
                document.documentElement.scrollTop = adjustPosition;
                var newPosition = document.documentElement.scrollTop;
            }).fail(function (err) {
            console.log(err);
        }).always(function () {
            console.log('Always');
        });
    }

    $("#faSearchBtn").button().click(function(){
        faSearch = $('#faSearchInput').val();
        updateResults('fa', 1, faSearch);

    });

    $("#hgSearchBtn").button().click(function(){
        hgSearch = $('#hgSearchInput').val();
        updateResults('hg', 1, hgSearch);

    });

    $("#sgSearchBtn").button().click(function(){
        sgSearch = $('#sgSearchInput').val();
        updateResults('sg', 1, sgSearch);

    });

    $("#ecSearchBtn").button().click(function(){
        ecSearch = $('#ecSearchInput').val();
        updateResults('ec', 1, ecSearch);

    });


</script>
<script src="assets/map.js?[[!cache_buster]]"></script>
[[- <script src="https://cdn.jsdelivr.net/gh/igorlino/elevatezoom-plus@1.2.3/src/jquery.ez-plus.js"></script> ]]

[[!+ms.successMessage]]

</body>
</html>
