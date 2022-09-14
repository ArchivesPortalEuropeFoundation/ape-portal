<!DOCTYPE html>
<html>
<head>
    [[$head]]
</head>
<body>
[[$header]]

<div class="altSlideOut pb10 replace">
    <div class="container">
        <div class="clearfix">
            <div class="left">
                <strong>100,000+ [[!%asi.results? &topic=`default` &namespace=`asi`]]</strong>
                <a class="visible-xs toggleSlideUp posR" href="#toolsSlideUp"><i class="fas fa-ellipsis-h"></i></a>
            </div>
            <div class="right">
                <a data-trigger="save_search" class="blueIcon" href="#saveSearchPopup" data-toggle="modal"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                <a class="pinkIcon aLink" href="#innerHero"><i class="fas fa-pencil mr"></i> [[!%asi.edit_search? &topic=`actions` &namespace=`asi`]]</a>
                <a class="blackIcon toggleHelp" href="#"><i class="fas fa-life-ring mr"></i> [[!%asi.help?
                    &topic=`default` &namespace=`asi`]]</a>
            </div>
        </div>
        <div data-g="filter-summary" class="searchFilters clearfix">
            <p>
                <strong>[[!%asi.search_filters? &topic=`search` &namespace=`asi`]]:</strong>
                [[- this gets filled in by asi.js ]]
            </p>
        </div>
    </div>
</div>

[[$advSearchHero]]

<section class="noTopMargin">
    <div class="container">
        <div class="text-center">
            <div class="advSearchTabs">
                [[++tt_advanced_search_main:notempty=`
                <div class="tipIcon" data-tooltip-content="#advancedSearchMainTooltip">
                    <i class="far fa-question-circle"></i>
                </div>
                `]]
                <a data-navigate="search-in-archives" class="active"><i class="fas fa-file"></i> <span class="tabTitle">[[!%asi.search_in_archives? &topic=`search` &namespace=`asi`]] </span><span class="count">(100,000+)</span></a>
                <a data-navigate="search-in-names" href="[[~51]]"><i class="fas fa-user"></i> <span class="tabTitle">[[!%asi.search_in_names? &topic=`search` &namespace=`asi`]] </span><span class="count">(100,000+)</span></a>
                <a data-navigate="search-in-institutions" href="[[~52]]"><i class="fas fa-building"></i> <span class="tabTitle">[[!%asi.search_in_institutions? &topic=`search` &namespace=`asi`]] </span><span class="count">(4)</span></a>
            </div>
        </div>
        <div id="searchContainer" class="blueBG">
            <form class="search large countries" action="[[~[[*id]]]]" method="post">
                <input type="text" autocomplete="off" data-input="search_term" class="searchField" name="search" placeholder="[[!%asi.type_search_term? &topic=`input` &namespace=`asi`]]" value="[[!from_request?&input=`term`]]">
                <input type="submit" data-control="search_term_trigger">
                <div class="suggestions" data-interface="suggestions">
                    <a class="entry" href="#">City of <strong data-populate="term"></strong> <i class="fas fa-building"></i> <span>(100,000+)</span></a>
                    <a class="entry" href="#">John <strong data-populate="term"></strong> <i class="fas fa-user"></i> <span>(10)</span></a>
                    <a class="entry" href="#">Topic <strong data-populate="term"></strong> <i class="fas fa-book"></i> <span>(1)</span></a>
                    <hr>
                    <h5>[[!%asi.did_you_mean? &topic=`default` &namespace=`asi`]]:</h5>
                    <a class="entry" href="#" data-populate="did_you_mean_1" <i class="fas fa-landmark"></i> <span>(100,000+)</span></a>
                    <a class="entry" href="#" data-populate="did_you_mean_2"> <i class="fas fa-users"></i> <span>(10,000+)</span></a>
                </div>

                <div class="selectDropdown countryDropdown select-countries" data-g="search-select-countries">
                    [[$asi_search_select_dropdown? &entity=`countries` &label=`[[!%asi.search_in_all_countries? &topic=`search` &namespace=`asi`]]` &tiptitle=`0`]]
                </div>

                <span class="clearSearch"><i class="fas fa-times"></i></span>
                <div class="tools clearfix">
                    <a class="expandAdv">[[!%asi.show_adv_options? &topic=`search` &namespace=`asi`]] <i class="fas fa-angle-down"></i></a>
                    <div class="checkboxes">
							<span class="checkbox">
								<input type="checkbox" name="digital" value="1">
								[[++tt_search_check_digital:notempty=`
								<span class="tipText">
								    [[!%asi.show_digital_objs? &topic=`search` &namespace=`asi`]]
								    <div class="tipIcon" data-tooltip-content="#searchDigitalTooltip">
										<i class="far fa-question-circle"></i>
									</div>
								</span>
								`:default=`
								<span>[[!%asi.show_digital_objs? &topic=`search` &namespace=`asi`]]</span>
								`]]
							</span>
                        <span class="checkbox">
								<input type="checkbox" name="seperate" value="1">
								[[++tt_search_check_terms:notempty=`
								<span class="tipText">
								    [[!%asi.search_term_sep? &topic=`search` &namespace=`asi`]]
									<div class="tipIcon" data-tooltip-content="#searchTermTooltip">
										<i class="far fa-question-circle"></i>
									</div>
								</span>
								`:default=`
								<span>[[!%asi.search_term_sep? &topic=`search` &namespace=`asi`]]</span>
								`]]
							</span>
                    </div>
                </div>
                <div id="advSearchControls" class="blueBG">
                    <p class="bold">[[*advSearchOptionsText]]</p>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="advControl">
                                [[++tt_search_select_element:notempty=`
                                <div class="tipTitle">
                                    <div class="tipIcon" data-tooltip-content="#searchElementTooltip">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    <p class="strongLabel">[[!%asi.search_using? &topic=`search` &namespace=`asi`]]</p>
                                </div>
                                `:default=`
                                <p class="strongLabel">[[!%asi.search_using? &topic=`search` &namespace=`asi`]]</p>
                                `]]
                                <div class="selectWrapper">
                                    <select name="elements">
                                        <option value="">All elements</option>
                                        <option value="1">Element 1</option>
                                        <option value="2">Element 2</option>
                                        <option value="3">Element 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="advControl">
                                [[++tt_search_select_document:notempty=`<div class="tipTitle">
                                    <div class="tipIcon" data-tooltip-content="#searchDocumentTooltip">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    <p class="strongLabel">[[!%asi.drop_doc_type? &topic=`search` &namespace=`asi`]]</p>
                                </div>
                                `:default=`
                                <p class="strongLabel">[[!%asi.drop_doc_type? &topic=`search` &namespace=`asi`]]</p>
                                `]]
                                <div class="selectWrapper">
                                    <select name="documents">
                                        <option value="">All documents</option>
                                        <option value="1">Document 1</option>
                                        <option value="2">Document 2</option>
                                        <option value="3">Document 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="advControl">
                                [[++tt_search_by_date:notempty=`
                                <div class="tipTitle">
                                    <div class="tipIcon" data-tooltip-content="#searchDateTooltip">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    <p class="strongLabel">[[!%asi.date_search? &topic=`search` &namespace=`asi`]]</p>
                                </div>
                                `:default=`
                                <p class="strongLabel">[[!%asi.date_search? &topic=`search` &namespace=`asi`]]</p>
                                `]]
                                <div class="dateSearch">
										<span class="checkbox">
											<input type="checkbox" name="exactDate" value="1">
											[[!%asi.exact_date_search? &topic=`search` &namespace=`asi`]]
										</span>
                                    <div class="inputWrapper">
                                        <i class="far fa-calendar-alt"></i>
                                        <input type="text" id="dateFrom" name="dateFrom" placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
                                    </div>
                                    <span class="to">[[!%asi.date_to? &topic=`search` &namespace=`asi`]]</span>
                                    <div class="inputWrapper">
                                        <i class="far fa-calendar-alt"></i>
                                        <input type="text" id="dateTo" name="dateTo" placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="advSubmit">
							<span class="checkbox">
								<input type="checkbox" name="context" value="1">
								[[++tt_search_in_context:notempty=`
								<span class="tipText">
									[[!%asi.view_in_context? &topic=`search` &namespace=`asi`]]
									<div class="tipIcon" data-tooltip-content="#searchContextTooltip">
									    <i class="far fa-question-circle"></i>
									</div>
								</span>
								`:default=`
								<span>[[!%asi.view_in_context? &topic=`search` &namespace=`asi`]]</span>
								`]]
							</span>
                        <a class="button large pink borders submitSearch1" data-control="search_term_trigger"><i class="fas fa-search"></i> [[!%asi.btn_search? &topic=`actions` &namespace=`asi`]]</a>
                        <a class="hideAdv">[[!%asi.hide_adv_search_options? &topic=`search` &namespace=`asi`]]<i class="fas fa-angle-up"></i></a>
                    </div>
                </div>
                <div class="mobileSubmit">
                    <a class="button large pink submitSearch2" data-control="search_term_trigger"><i class="fas fa-search"></i> [[!%asi.btn_search? &topic=`actions` &namespace=`asi`]]</a>
                    <span class="reduceSearch"><i class="fas fa-eye-slash"></i> [[!%asi.reduce_search? &topic=`search` &namespace=`asi`]]</span>
                </div>
            </form>
        </div>
    </div>
</section>

<section id="resultsTabs" class="hidden" data-section="has_results">
    <div class="text-center">
        <ul class="nav-tabs">
            [[++tt_search_results_tabs:notempty=`
            <div class="tipIcon" data-tooltip-content="#searchTabsTooltip">
                <i class="far fa-question-circle"></i>
            </div>
            `]]
            <li class="active"><a href="#listTab" data-toggle="tab">[[!%asi.list_view? &topic=`default` &namespace=`asi`]]</a></li>
            <li class=""><a href="#contextTab" data-toggle="tab">[[!%asi.context_view? &topic=`default` &namespace=`asi`]]</a></li>
        </ul>
    </div>
    <div class="greyBG">
        <div class="container">
            <div class="tab-content">
                <div id="listTab" class="tab-pane fade active in">
                    <div class="resultsControls row">
                        <div class="col-md-9">
                            <h5 class="resultsCount">
                                [[!%asi.context_view? &topic=`default` &namespace=`asi`]] (40-50 / 100,000+ [[!%asi.results? &topic=`default` &namespace=`asi`]])
                            </h5>
                            [[++tt_search_results_save:notempty=`
                            <div class="tipButton">
                                <div class="tipIcon" data-tooltip-content="#searchSaveTooltip">
                                    <i class="far fa-question-circle"></i>
                                </div>
                                <a data-trigger="save_search" class="button blue small" href="#saveSearchPopup" data-toggle="modal"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                            </div>
                            `:default=`
                            <a data-trigger="save_search" class="button blue small" href="#saveSearchPopup" data-toggle="modal"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                            `]]
                            <a class="button blue small toggleFilters"><i class="fas fa-list mr"></i> [[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]</a>
                        </div>
                        <div class="col-md-3">
                            <div class="sortBy">
                                <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                <div class="selectDropdown" data-control="sort_by">
                                    <div class="title">
                                        [[!%asi.filter_relevance? &topic=`default` &namespace=`asi`]]
                                    </div>
                                    <div class="inner">
                                        <a href="#">[[!%asi.filter_relevance? &topic=`default` &namespace=`asi`]]</a>
                                    </div>
                                    <div class="inner">
                                        <a href="#">[[!%asi.filter_date? &topic=`default` &namespace=`asi`]]</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="searchExtra">
                        <div class="searchMean clearfix">
                            <span class="toggleShow">[[!%asi.did_you_mean? &topic=`default` &namespace=`asi`]] <i class="fas fa-angle-down ml"></i></span>
                            <p>
                                <strong>[[!%asi.did_you_mean? &topic=`default` &namespace=`asi`]]:</strong>
                                <a href="#"><span data-populate="did_you_mean_1"></span></a>
                                <a href="#"><span data-populate="did_you_mean_2"></span></a>
                                <a href="#"><span data-populate="did_you_mean_3"></span></a>
                                <a href="#"><span data-populate="did_you_mean_4"></span></a>
                                <a href="#"><span data-populate="did_you_mean_5"></span></a>
                                <a href="#"><span data-populate="did_you_mean_6"></span></a>
                            </p>
                        </div>
                        <hr>
                        <div data-g="filter-summary" class="searchFilters clearfix">
                            <p>
                                <strong>[[!%asi.search_filters? &topic=`search` &namespace=`asi`]]:</strong>
                                [[- this gets filled in by asi.js ]]
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <form id="filterSidebar" class="standard">

                                <div class="mobileHeader">
                                    <span class="toggleFilters"><i class="far fa-times"></i></span>
                                    <div class="sortBy">
                                        <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                        <div class="selectDropdown">
                                            <div class="title">
                                                [[!%asi.filter_relevance? &topic=`default` &namespace=`asi`]]
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.filter_relevance? &topic=`default` &namespace=`asi`]]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>[[!%asi.your_filters? &topic=`default` &namespace=`asi`]]</h3>
                                </div>

                                <div class="contentDropdown select-countries" data-g="search-select-countries">
                                    [[$asi_search_select_dropdown? &entity=`countries`]]
                                </div>

                                 <div class="contentDropdown select-institutions" data-g="search-select-institutions">
                                    [[$asi_search_select_dropdown? &entity=`institutions` &label=`[[!%asi.label_archival_institution? &topic=`label` &namespace=`asi`]]` &tip_id=`Institution`]]
                                </div>

                                <div class="contentDropdown select-aids" data-g="search-select-aids">
                                    [[$asi_search_select_dropdown? &entity=`aids` &label=`Finding aid`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`types` &label=`[[!%asi.drop_doc_type? &topic=`search` &namespace=`asi`]]`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`levels`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`containsDigital` &label=`Contains digital objects`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`digitalTypes` &label=`Digital object types`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`dateTypes` &label=`Date type`]]
                                </div>

                                <div class="contentDropdown select-start" data-g="search-date-starttimespan">
                                    [[!asi_search_date? &entity=`startTimespan` &label=`Start Timespan`]]
                                </div>

                                <div class="contentDropdown select-end" data-g="search-date-endtimespan">
                                    [[!asi_search_date? &entity=`endTimespan` &label=`End Timespan`]]
                                </div>

                                <div class="contentDropdown select-lang_material" data-g="search-select-lang_material">
                                    [[$asi_search_select_dropdown? &entity=`materialLanguage` &label=`Language of material`]]
                                </div>

                                <div class="contentDropdown select-topics" data-g="search-select-topics">
                                    [[$asi_search_select_dropdown? &entity=`topics`]]
                                </div>

                                <div class="contentDropdown select-topics" data-g="search-select-topics">
                                    [[$asi_search_select_dropdown? &entity=`topics`]]
                                </div>

                                <div class="contentDropdown select-topics" data-g="search-select-topics">
                                    [[$asi_search_select_dropdown? &entity=`using` &label=`[[!%asi.search_using? &topic=`search` &namespace=`asi`]]`]]
                                </div>

                            </form>
                        </div>
                        <div class="col-md-9">
                            <div data-section="search_results">

                            </div>
                        </div>
                    </div>
                </div>
                <div id="contextTab" class="tab-pane fade">
                    <div class="resultsControls text-center">
                        <h5 class="resultsCount">
                            [[!%asi.context_view? &topic=`default` &namespace=`asi`]] (4701 [[!%asi.results? &topic=`default` &namespace=`asi`]])
                        </h5>
                        [[++tt_search_results_save:notempty=`
                        <div class="tipButton">
                            <div class="tipIcon" data-tooltip-content="#searchSaveTooltip">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <a data-trigger="save_search" class="button blue small" href="#accountNeededPopup" data-toggle="modal"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                        </div>
                        `:default=`
                        <a data-trigger="save_search" class="button blue small" href="#accountNeededPopup" data-toggle="modal"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                        `]]
                    </div>
                    <div id="contextCountry" class="contextDropdown">
                        <div class="title row">
                            <div class="col-sm-6">
                                <h3>[[!%asi.search_select_mply_country? &topic=`search` &namespace=`asi`]]</h3>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <form class="searchLight">
                                        <div class="inputWrapper">
                                            <i class="fas fa-search"></i>
                                            <input type="text" name="search" placeholder="[[!%asi.find_country? &topic=`input` &namespace=`asi`]]">
                                        </div>
                                    </form>
                                    <div class="sortBy">
                                        <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                        <div class="selectDropdown">
                                            <div class="title">
                                                [[!%asi.most_results? &topic=`search` &namespace=`asi`]]
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.most_results? &topic=`search` &namespace=`asi`]]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="toggleSlideUp" href="#countrySort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                                    <a class="toggleShow"><span>[[!%asi.hide? &topic=`actions` &namespace=`asi`]]</span> <i class="far fa-angle-up ml"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="inner">
                            <div class="row">
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">United Kingdom</span>
                                        <span class="count">(1,000,000+)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Netherlands</span>
                                        <span class="count">(1,000,000+)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Switzerland</span>
                                        <span class="count">(1,000,000+)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Czech Republic</span>
                                        <span class="count">(512,941)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Isle of Mann</span>
                                        <span class="count">(404,283)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Spain</span>
                                        <span class="count">(308,183)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">France</span>
                                        <span class="count">(72,091)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Latvia</span>
                                        <span class="count">(20,714)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Luxembourg</span>
                                        <span class="count">(294)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-2">
                                    <div class="countryItem">
                                        <span class="name">Belgium</span>
                                        <span class="count">(4)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contextInstitution" class="contextDropdown">
                        <div class="title row">
                            <div class="col-sm-6">
                                <h3>[[!%asi.search_select_arch_inst_mply? &topic=`search` &namespace=`asi`]]</h3>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <form class="searchLight">
                                        <div class="inputWrapper">
                                            <i class="fas fa-search"></i>
                                            <input type="text" name="search" placeholder="[[!%asi.input_ph_find_institution? &topic=`input` &namespace=`asi`]]">
                                        </div>
                                    </form>
                                    <div class="sortBy">
                                        <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                        <div class="selectDropdown">
                                            <div class="title">
                                                [[!%asi.find_institution? &topic=`input` &namespace=`asi`]]
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.find_institution? &topic=`input` &namespace=`asi`]]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="toggleSlideUp" href="#institutionSort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                                    <a class="toggleShow"><span>[[!%asi.hide? &topic=`actions` &namespace=`asi`]]</span> <i class="far fa-angle-up ml"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="inner">
                            <div class="countryList">
                                <h5><i class="fas fa-globe-europe"></i> United Kingdom</h5>
                                <div class="row moreListInst">
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(50)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">Archival Institution Name</span>
                                            <span class="count">(20,083)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(100,000+)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(50)</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="text-center mt30">
                                            <a class="showMore">[[!%asi.action_show_more_from? &topic=`actions` &namespace=`asi`]] United Kingdom <i class="far fa-angle-down"></i></a>
                                            <a class="showLess">[[!%asi.action_show_less_from? &topic=`actions` &namespace=`asi`]] United Kindgom <i class="far fa-angle-up"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="countryList">
                                <h5><i class="fas fa-globe-europe"></i> Spain</h5>
                                <div class="row moreListInst">
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> Spain</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> Spain</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> Spain</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="countryList">
                                <h5><i class="fas fa-globe-europe"></i> Belgium</h5>
                                <div class="row moreListInst">
                                    <div class="col-sm-6 col-md-4 item">
                                        <div class="institutionItem">
                                            <span class="country"><i class="fas fa-globe-europe"></i> Belgium</span>
                                            <span class="name">The Name of the Archival Institution Displays Here</span>
                                            <span class="count">(1,000,000+)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contextAids" class="contextDropdown">
                        <div class="title row">
                            <div class="col-sm-6">
                                <h3>[[!%asi.filter_finding_aids? &topic=`search` &namespace=`asi`]]</h3>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <form class="searchLight upM">
                                        <div class="inputWrapper">
                                            <i class="fas fa-search"></i>
                                            <input type="text" name="search" placeholder="[[!%asi.input_find_guide_or_aid? &topic=`input` &namespace=`asi`]]">
                                        </div>
                                    </form>
                                    <div class="sortBy">
                                        <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                        <div class="selectDropdown">
                                            <div class="title">
                                                Finding aid
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.filter_finding_aids? &topic=`search` &namespace=`asi`]]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="toggleSlideUp upM" href="#aidSort">[[!%asi.sort? &topic=`actions` &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                                    <a class="toggleShow"><span>[[!%asi.hide? &topic=`actions` &namespace=`asi`]]</span> <i class="far fa-angle-up ml"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="checkboxes formStandard">
                                    <span class="checkbox">
        								<input type="checkbox" name="holding" value="1">
        								[[++tt_search_results_holding:notempty=`
                                        <span class="tipText">
        								    [[!%asi.filter_only_holding_guides? &topic=`search` &namespace=`asi`]]
        								    <div class="tipIcon" data-tooltip-content="#searchHoldingTooltip">
        										<i class="far fa-question-circle"></i>
        									</div>
        								</span>
                                        `:default=`
                                        [[!%asi.filter_only_holding_guides? &topic=`search` &namespace=`asi`]]
                                        `]]
        							</span>
                                    <span class="checkbox">
        								<input type="checkbox" name="finding" value="1">
        								[[++tt_search_results_finding:notempty=`
                                        <span class="tipText">
        								    [[!%asi.filter_only_finding_aids? &topic=`search` &namespace=`asi`]]
        								    <div class="tipIcon" data-tooltip-content="#searchFindingTooltip">
        										<i class="far fa-question-circle"></i>
        									</div>
        								</span>
                                        `:default=`
                                        [[!%asi.filter_only_finding_aids? &topic=`search` &namespace=`asi`]]
                                        `]]
        							</span>
                                </div>
                            </div>
                        </div>
                        <div class="inner">
                            <div class="aidsResult">
                                <div class="details">
                                    <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom (The name of the Archival Institution displays here)</span>
                                    <h5><i class="fas fa-layer-group"></i>Holding / Source Guide Here</h5>
                                    <span class="count">(1,000,000+)</span>
                                    <a class="view button blue" href="#"><i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
                                </div>
                                <div class="contentDropdown">
                                    <div class="title">
                                        Sub-groups <i class="fas fa-angle-down"></i>
                                    </div>
                                    <div class="inner">
                                        <ul class="subGroups">
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(1000)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 3 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="parent">
                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 4 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                        <ul>
                                                                            <li class="parent">
                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 5 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                <ul>
                                                                                    <li class="parent">
                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 6 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                        <ul>
                                                                                            <li class="parent">
                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 7 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                <ul>
                                                                                                    <li class="parent">
                                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 8 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                        <ul>
                                                                                                            <li class="parent">
                                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 9 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                <ul>
                                                                                                                    <li class="parent">
                                                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 10 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                        <ul>
                                                                                                                            <li class="parent">
                                                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 11 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                                <ul>
                                                                                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 12<i class="far fa-angle-right"></i></a></li>
                                                                                                                                </ul>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(500)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(200)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(4)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <div class="moreDropdown">
                                                <div class="inner">
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(1000)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(500)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(200)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(4)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                </div>
                                                <div class="title">
                                                    More
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="aidsResult">
                                <div class="details">
                                    <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom (The name of the Archival Institution displays here)</span>
                                    <h5><i class="fas fa-bars"></i>Finding Aid Name Here</h5>
                                    <span class="count">(1,000,000+)</span>
                                    <a class="view button blue" href="#"><i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
                                </div>
                                <div class="contentDropdown">
                                    <div class="title">
                                        Sub-groups <i class="fas fa-angle-down"></i>
                                    </div>
                                    <div class="inner">
                                        <ul class="subGroups">
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(1000)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 3 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="parent">
                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 4 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                        <ul>
                                                                            <li class="parent">
                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 5 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                <ul>
                                                                                    <li class="parent">
                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 6 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                        <ul>
                                                                                            <li class="parent">
                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 7 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                <ul>
                                                                                                    <li class="parent">
                                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 8 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                        <ul>
                                                                                                            <li class="parent">
                                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 9 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                <ul>
                                                                                                                    <li class="parent">
                                                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 10 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                        <ul>
                                                                                                                            <li class="parent">
                                                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 11 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                                <ul>
                                                                                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 12<i class="far fa-angle-right"></i></a></li>
                                                                                                                                </ul>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(500)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(200)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(4)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <div class="moreDropdown">
                                                <div class="inner">
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(1000)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(500)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(200)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(4)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                </div>
                                                <div class="title">
                                                    More
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="aidsResult">
                                <div class="details">
                                    <span class="country"><i class="fas fa-globe-europe"></i> United Kingdom (The name of the Archival Institution displays here)</span>
                                    <span class="guide"><i class="fas fa-layer-group"></i> Holding / Source Guide Here</span>
                                    <h5><i class="fas fa-bars"></i>Finding Aid Name Here</h5>
                                    <span class="count">(1,000,000+)</span>
                                    <a class="view button blue" href="#"><i class="fas fa-eye mr"></i> [[!%asi.action_view? &topic=`actions` &namespace=`asi`]]</a>
                                </div>
                                <div class="contentDropdown">
                                    <div class="title">
                                        Sub-groups <i class="fas fa-angle-down"></i>
                                    </div>
                                    <div class="inner">
                                        <ul class="subGroups">
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(1000)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 3 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="parent">
                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 4 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                        <ul>
                                                                            <li class="parent">
                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 5 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                <ul>
                                                                                    <li class="parent">
                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 6 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                        <ul>
                                                                                            <li class="parent">
                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 7 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                <ul>
                                                                                                    <li class="parent">
                                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 8 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                        <ul>
                                                                                                            <li class="parent">
                                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 9 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                <ul>
                                                                                                                    <li class="parent">
                                                                                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 10 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                        <ul>
                                                                                                                            <li class="parent">
                                                                                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 11 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a>
                                                                                                                                <ul>
                                                                                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 12<i class="far fa-angle-right"></i></a></li>
                                                                                                                                </ul>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(500)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(200)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(4)</span> <i class="far fa-angle-right"></i></a>
                                                <ul>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                    <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                </ul>
                                            </li>
                                            <div class="moreDropdown">
                                                <div class="inner">
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(1000)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(500)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(200)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="parent">
                                                        <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 1 <span class="count">(4)</span> <i class="far fa-angle-right"></i></a>
                                                        <ul>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(100)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent">
                                                                <i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(750)</span> <i class="far fa-angle-right"></i></a>
                                                                <ul>
                                                                    <li class="child"><i class="fas fa-file-alt"></i> <a href="#">Sub-level group 3<i class="far fa-angle-right"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(50)</span> <i class="far fa-angle-right"></i></a></li>
                                                            <li class="parent"><i class="fas fa-caret-right openGroup"></i> <a href="#">Sub-level group 2 <span class="count">(22)</span> <i class="far fa-angle-right"></i></a></li>
                                                        </ul>
                                                    </li>
                                                </div>
                                                <div class="title">
                                                    More
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <ul class="paging" data-control="pagination">
            <li data-paginate="first" class="first"><a href="#"><i class="far fa-angle-double-left"></i><span> [[!%asi.pg_first? &topic=`default` &namespace=`asi`]]</a></span></li>
            <li data-paginate="prev" class="prev"><a href="#"><i class="far fa-angle-left"></i><span> [[!%asi.pg_previous? &topic=`default` &namespace=`asi`]]</a></span></li>
            <span data-paginate="pages"></span>
            <li data-paginate="next" class="next"><a href="#"><span>[[!%asi.pg_next? &topic=`default` &namespace=`asi`]] </span><i class="far fa-angle-right"></i></a></li>
            <li data-paginate="last" class="last"><a href="#"><span>[[!%asi.pg_last? &topic=`default` &namespace=`asi`]] </span><i class="far fa-angle-double-right"></i></a></li>
        </ul>
    </div>
</section>

[[$footer]]

[[$saveSearchPopup]]

[[$accountNeededPopup]]

[[$banners]]

[[$tooltips]]

<div id="countrySort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.sort_countries_by? &topic=`search` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_find_institution_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_find_institution_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<div id="institutionSort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.filter_sort_institutions_by? &topic=`filters` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_institution_name_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_institution_name_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<div id="aidSort" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    <h3>[[!%asi.filter_sort_finding_aids_by? &topic=`filters` &namespace=`asi`]]:</h3>
    <ul>
        <li><a href="#">[[!%asi.filter_finding_aid_name_a_z? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_finding_aid_name_z_a? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_most_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.least_results_first? &topic=`filters` &namespace=`asi`]]</a></li>
        <li><a href="#">[[!%asi.filter_another? &topic=`filters` &namespace=`asi`]]</a></li>
    </ul>
</div>

<div id="toolsSlideUp" class="slideUp">
    <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
    [[-<a class="toggleSlideUp" data-toggle="modal" href="#searchWithinPopup"><i class="fas fa-search yellow"></i> [[!%asi.search_in_institutions? &topic=`search` &namespace=`asi`]]</a>]]
    <a data-trigger="save_search" class="toggleSlideUp" data-toggle="modal" href="#saveSearchPopup"><i class="fas fa-save blue"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
    <a class="toggleSlideUp aLink" href="#innerHero"><i class="fas fa-pencil pink"></i> [[!%asi.tools_edit? &topic=`default` &namespace=`asi`]]</a>
    <a class="toggleFilters toggleSlideUp"><i class="fas fa-list"></i> [[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]</a>
    <a class=""><i class="fas fa-life-ring"></i> [[!%asi.help? &topic=`default` &namespace=`asi`]]</a>

</div>

[[$scripts]]

<script>
    $('.countryItem, .institutionItem').click(function() {
        $(this).toggleClass('active');
    });

    $('.moreListInst').each(function() {
        var list = $(this);
        var items = list.find('.item').size();
        var more = list.find('.showMore');
        var less = list.find('.showLess');
        var x = 6;
        var y = 3;
        var z = x;

        if (x > items) {
            more.hide();
        }

        $(this).find('.item:lt('+x+')').css('display', 'block');

        more.click(function () {
            x= (x+y <= items) ? x+y : items;
            list.find('.item:lt('+x+')').css('display', 'block');
            less.show();
            if(x == items){
                more.hide();
            }
        });

        less.click(function () {
            x=(x-y<z) ? z : x-y;
            list.find('.item').not(':lt('+x+')').hide();
            more.show();
            less.show();
            if(x == z){
                less.hide();
            }
        });
    });

    $(".switchModals").click(function(e){
        $("#saveSearchPopup").modal('hide');
        setTimeout(function(){
            $("#searchSavedPopup").modal('show');
        }, 800);
        e.preventDefault();
    });
</script>

<script>
    var section = 'search-in-archives';
</script>
<script src="[[++base_url]]bundles/asi/asi.js"></script>

</body>
</html>