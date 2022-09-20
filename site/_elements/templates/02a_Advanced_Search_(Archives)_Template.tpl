<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
<head>
    [[$head]]
</head>
<body>
[[$header]]

 
[[!country_filters_check]]

<style>
    #advSearchControls.blueBG .contentDropdown {color:#555;} #advSearchControls.blueBG .contentDropdown .checkbox input::before, #advSearchControlsP.blueBG .contentDropdown .checkbox input::before {color: #555;} #advSearchControls.blueBG .contentDropdown .tipTitle {padding-left: 0; color: #AAA;} #advSearchControls.blueBG .contentDropdown .tooltipstered {display: none;} #advSearchControls.blueBG .contentDropdown {
        padding: 11px 10px 5px 10px;
        border: none;
    }

    #advSearchControls.blueBG .contentDropdown > .title:after {top: 12px; color: #AAA;} .searchResult .details h3 .apeItemH3 {
        max-height: 66px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .searchResult .details h3 .apeItemH3 .show {
        max-height: 66px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .searchResult .details .header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .searchResult .details .header h3 {
        padding-right: 0px;
        margin-bottom: 0px;
    }

    .searchResult .details .header > span.date {
        margin-left: 30px;
        position: relative;
        top: 5px;
        right: auto;
        flex-shrink: 0;
        max-width: 160px;
        text-align: right;
    }

    .searchResult .details .body {
        display: flex;
        justify-content: space-between;
    }

    .searchResult .details .body .description {
        padding-right: 0px;
    }

    .searchResult .details .body > a.view {
        margin-left: 30px;
        padding: 10px;
        font-size: 14px;
        flex-shrink: 0;
        align-self: flex-start;
    }

    [data-facet-set="countries"] li {
        display: none;
    }

    [data-facet-set="institutions"] li {
        display: none;
    }

    [data-facet-set="topics"] li {
        display: none;
    }

    @media (max-width: 767px) {

        .searchResult .details .header {
            flex-direction: column;
        }

        .searchResult .details .header > span.date {
            order: -1;
            margin-left: 0px;
            margin-bottom: 10px;
            top: 0px;
            max-width: none;
            text-align: left;
        }

        .searchResult .details .body {
            flex-direction: column;
        }

        .searchResult .details .body > a.view {
            margin-left: 0px;
            margin-top: 15px;
        }

    }

    @media (min-width: 992px) {
        #advSearchControls .advSubmit, #advSearchControlsP .advSubmit {
            text-align: right;
            margin-top: -45px;
        }

    }

</style>

<div class="altSlideOut pb10 replace">
    <div class="container">
        <div class="clearfix">
            <div class="left">
                <strong data-display="results_count" style="display: none;"><span
                            data-populate="results_count">100,000</span> [[!%asi.results? &topic=`default`
                    &namespace=`asi`]]</strong>
                <a class="visible-xs toggleSlideUp posR" href="#toolsSlideUp"><i class="fas fa-ellipsis-h"></i></a>
            </div>
            <div class="right">
                [[- <a data-trigger="save_search" class="blueIcon" href="#saveSearchPopup"><i
                            class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a> ]]
                <a class="pinkIcon aLink" href="#innerHero"><i class="fas fa-pencil mr"></i> [[!%asi.edit_search?
                    &topic=`actions` &namespace=`asi`]]</a>
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

[[!$advSearchHero]]

<section class="noTopMargin">
    <div class="container">
        <div class="text-center">
            <div class="advSearchTabs">
                [[++tt_advanced_search_main:notempty=`
                <div class="tipIcon" data-tooltip-content="#advancedSearchMainTooltip">
                    <i class="far fa-question-circle"></i>
                </div>
                `]]
                <a data-navigate="search-in-archives" class="active"><i class="fas fa-file"></i> <span class="tabTitle">[[!%asi.search_in_archives? &topic=`search` &namespace=`asi`]] </span><span
                            class="count" data-count-type="search-in-archives" data-info="result_count"></span></a>
                <a data-navigate="search-in-names" href="[[~51]]"><i class="fas fa-user"></i> <span class="tabTitle">[[!%asi.search_in_names? &topic=`search` &namespace=`asi`]] </span><span
                            class="count" data-count-type="search-in-names" data-info="result_count"></span></a>
                <a data-navigate="search-in-institutions" href="[[~52]]"><i class="fas fa-building"></i> <span
                            class="tabTitle">[[!%asi.search_in_institutions? &topic=`search` &namespace=`asi`]] </span><span
                            data-count-type="search-in-institutions" data-info="result_count" class="count"></span></a>
            </div>
        </div>
        <div id="searchContainer" class="blueBG">
            <form class="search large countries" action="[[~[[*id]]]]" method="post">
                <input type="text" autocomplete="off" data-input="search_term" class="searchField" name="search"
                       placeholder="[[!%asi.type_search_term? &topic=`input` &namespace=`asi`]]"
                       value="[[!from_request?&input=`term`]]">
                <input type="submit" data-control="search_term_trigger">
                <div class="suggestions" data-interface="suggestions">

                    <div class="suggest_inner" data-container="section_suggest" style="display: none; border: none">
                        <h5>[[!%asi.search_sections? &topic=`search` &namespace=`asi`]]</h5>
                        <div data-populate="section_suggest"></div>
                        <hr>
                    </div>

                    <div class="suggest_inner" data-container="spelling_suggest" style="display: none; border: none">
                        <h5>[[!%asi.search_spelling? &topic=`search` &namespace=`asi`]]</h5>
                        <div data-populate="spelling_suggest"></div>
                        <hr>
                    </div>

                    <div class="suggest_inner" data-container="topic_suggest" style="display: none; border: none">
                        <h5>[[!%asi.search_topics? &topic=`search` &namespace=`asi`]]</h5>
                        <div data-populate="topic_suggest"></div>
                        <hr>
                    </div>

                </div>

                <div class="selectDropdown countryDropdown select-countries" data-g="search-select-countries">

                    <div class="title">
                        [[!%asi.search_in_all_countries? &topic=`search` &namespace=`asi`]]
                    </div>
                    <div class="inner" data-facet-set="countries">

                        <div class="searchLight">
                            <div class="inputWrapper">
                                <i class="fas fa-search"></i>
                                <input data-g="search-filter" data-search-target="countries" type="text" name="search"
                                       placeholder="[[!%asi.find_country? &topic=`input` &namespace=`asi`]]"
                                       autocomplete="off">
                            </div>
                        </div>

                        [[$static_country_list]]
                    </div>
                </div>

                <span class="clearSearch"><i class="fas fa-times"></i></span>
                <div class="tools clearfix">
                    <a class="expandAdv">[[!%asi.show_adv_options? &topic=`search` &namespace=`asi`]] <i
                                class="fas fa-angle-down"></i></a>
                    <div class="checkboxes" data-control="checkbox_filters">
							<span class="checkbox">
                                <input data-type="top_filter_switch" data-filter-field="containsdigital"
                                       data-filter-value="true" data-filter-type="boolean" type="checkbox"
                                       name="Contains digital objects">
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
                                <input data-filter-field="separate" data-filter-value="true" data-filter-type="boolean"
                                       type="checkbox" name="separate">
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
                                <div class="tipTitle">
                                    <div class="tipIcon" data-tooltip-content="#searchElementTooltip">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    <p class="strongLabel">[[!%asi.search_using? &topic=`search` &namespace=`asi`]]</p>
                                </div>

                                <div class="contentDropdown">
                                    <div class="title">
                                        <div class="tipTitle">
                                            <div class="tipIcon tooltipstered"
                                                 data-tooltip-content="#searchFiltertypesTooltip">
                                                <i class="far fa-question-circle"></i>
                                            </div>
                                            [[!%asi.search_using? &topic=`search` &namespace=`asi`]]
                                        </div>
                                    </div>
                                    <div class="inner">
                                        <div class="checkboxList" data-control="using">
                                            [[- using is populated by search.js ]]
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-sm-6 col-md-3">

                            <div class="advControl">
                                <div class="tipTitle">
                                    <div class="tipIcon" data-tooltip-content="#searchDocumentTooltip">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    <p class="strongLabel">[[!%asi.find_doc_type? &topic=`search` &namespace=`asi`]]</p>
                                </div>

                                <div class="contentDropdown">
                                    <div class="title">
                                        <div class="tipTitle">
                                            <div class="tipIcon tooltipstered"
                                                 data-tooltip-content="#searchDocumentTooltip">
                                                <i class="far fa-question-circle"></i>
                                            </div>
                                            [[!%asi.drop_doc_type? &topic=`search` &namespace=`asi`]]
                                        </div>
                                    </div>
                                    <div class="inner">
                                        <div class="checkboxList" data-control="types">
                                            [[- types is populated by search.js ]]
                                        </div>
                                    </div>
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
                                        <input type="text" id="dateFrom" name="dateFrom"
                                               placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
                                    </div>
                                    <span class="to">[[!%asi.date_to? &topic=`search` &namespace=`asi`]]</span>
                                    <div class="inputWrapper">
                                        <i class="far fa-calendar-alt"></i>
                                        <input type="text" id="dateTo" name="dateTo"
                                               placeholder="[[!%asi.date_search_format? &topic=`input` &namespace=`asi`]]">
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
                        <a class="button large pink borders submitSearch1" data-control="search_term_trigger"><i
                                    class="fas fa-search"></i> [[!%asi.btn_search? &topic=`actions`
                            &namespace=`asi`]]</a>
                        <a class="hideAdv">[[!%asi.hide_adv_search_options? &topic=`search` &namespace=`asi`]]<i
                                    class="fas fa-angle-up"></i></a>
                    </div>
                </div>
                <div class="mobileSubmit">
                    <a class="button large pink submitSearch2" data-control="search_term_trigger"><i
                                class="fas fa-search"></i> [[!%asi.btn_search? &topic=`actions` &namespace=`asi`]]</a>
                    <span class="reduceSearch"><i class="fas fa-eye-slash"></i> [[!%asi.reduce_search? &topic=`search` &namespace=`asi`]]</span>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="loading-spinner" data-display="loading-spinner">
    <img src="/assets/images/spinner.gif"/>
</div>

<section id="resultsTabs" class="hidden" data-section="has_results">
    [[-
    <div class="text-center">
        <ul class="nav-tabs">
            [[++tt_search_results_tabs:notempty=`
            <div class="tipIcon" data-tooltip-content="#searchTabsTooltip">
                <i class="far fa-question-circle"></i>
            </div>
            `]]
            <li class="active"><a href="#listTab" data-toggle="tab">[[!%asi.list_view? &topic=`default`
                    &namespace=`asi`]]</a></li>
            <li class=""><a href="#contextTab" data-toggle="tab">[[!%asi.context_view? &topic=`default`
                    &namespace=`asi`]]</a></li>
        </ul>
    </div>
    ]]
    <div class="greyBG">
        <div class="container">
            <div class="tab-content">
                <div id="listTab" class="tab-pane fade active in">
                    <div class="resultsControls row">
                        <div class="col-md-9">
                            <h5 class="resultsCount">
                                [[%asi.search_results? &topic=`default` &namespace=`asi`]] (<span
                                        data-populate="results_start"></span>-<span data-populate="results_end"></span>
                                / <span data-populate="results_count"></span> [[!%asi.results? &topic=`default`
                                &namespace=`asi`]])
                            </h5>
                            [[- [[++tt_search_results_save:notempty=`
                            <div class="tipButton">
                                <div class="tipIcon" data-tooltip-content="#searchSaveTooltip">
                                    <i class="far fa-question-circle"></i>
                                </div>
                                <a data-trigger="save_search" class="button blue small" href="#saveSearchPopup"><i
                                            class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions`
                                    &namespace=`asi`]]</a>
                            </div>
                            `:default=`
                            <a data-trigger="save_search" class="button blue small" href="#saveSearchPopup"><i
                                        class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions`
                                &namespace=`asi`]]</a>
                            `]] ]]
                            <a class="button blue small toggleFilters"><i class="fas fa-list mr"></i>
                                [[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]</a>
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
                                    <div class="inner">
                                        <a href="#">[[!%asi.reference_code? &topic=`default` &namespace=`asi`]]</a>
                                    </div>
                                    <div class="inner">
                                        <a href="#">[[!%asi.finding_aid_no? &topic=`default` &namespace=`asi`]]</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="searchExtra">
                        <div class="searchMean clearfix">
                            <span class="toggleShow">[[!%asi.did_you_mean? &topic=`default` &namespace=`asi`]] <i
                                        class="fas fa-angle-down ml"></i></span>
                            <p>
                                <strong>[[!%asi.did_you_mean? &topic=`default` &namespace=`asi`]]:</strong>
                                <span data-populate="did_you_mean"></span>
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
                                        <div class="selectDropdown" data-control="sort_by">
                                            <div class="title">
                                                [[!%asi.filter_relevance? &topic=`default` &namespace=`asi`]]
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.filter_relevance? &topic=`default`
                                                    &namespace=`asi`]]</a>
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.reference_code? &topic=`default`
                                                    &namespace=`asi`]]</a>
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.finding_aid_no? &topic=`default`
                                                    &namespace=`asi`]]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>[[!%asi.your_filters? &topic=`default` &namespace=`asi`]]</h3>
                                </div>

                                <div class="contentDropdown select-countries" data-g="search-select-countries">
                                    [[$asi_search_select_dropdown? &entity=`countries` &label=`[[!%asi.label_countries?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`Country`]]
                                </div>

                                <div class="contentDropdown select-institutions" data-g="search-select-institutions">
                                    [[$asi_search_select_dropdown? &entity=`institutions`
                                    &label=`[[!%asi.label_archival_institution? &topic=`label` &namespace=`asi`]]`
                                    &tip_id=`Institution`]]
                                </div>

                                [[-
                                <div class="contentDropdown select-aids" data-g="search-select-aids">
                                    [[$asi_search_select_dropdown? &entity=`aids` &label=`[[!%asi.label_funding_aid?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`Finding`]]
                                </div>
                                ]]

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`types` &label=`[[!%asi.label_document_type?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`DocumentType`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`levels` &label=`[[!%asi.label_levels?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`Levels` &exclusive=`1`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`containsdigital`
                                    &label=`[[!%asi.label_contains_digital_obj? &topic=`label` &namespace=`asi`]]`
                                    &tip_id=`ContainsDigi` &exclusive=`1`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`digitaltypes`
                                    &label=`[[!%asi.label_digital_obj_types? &topic=`label` &namespace=`asi`]]`
                                    &tip_id=`DigiType`]]
                                </div>

                                <div class="contentDropdown select-types" data-g="search-select-types">
                                    [[$asi_search_select_dropdown? &entity=`datetypes` &label=`[[!%asi.label_date_type?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`DateType`]]
                                </div>

                                <div class="contentDropdown select-start2" data-g="search-date-starttimespan">
                                    [[!asi_search_date? &entity=`startTimespan` &label=`[[!%asi.label_start_timespan?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`StartTime`]]
                                </div>

                                <div class="contentDropdown select-end2" data-g="search-date-endtimespan">
                                    [[!asi_search_date? &entity=`endTimespan` &label=`[[!%asi.label_end_timespan?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`EndTime`]]
                                </div>

                                [[-
                                <div class="contentDropdown select-lang_material" data-g="search-select-lang_material">
                                    [[$asi_search_select_dropdown? &entity=`materialLanguage`
                                    &label=`[[!%asi.label_lang_of_material? &topic=`label` &namespace=`asi`]]`
                                    &tip_id=`LangMaterial`]]
                                </div>
                                ]]

                                <div class="contentDropdown select-topics" data-g="search-select-topics">
                                    [[$asi_search_select_dropdown? &entity=`topics` &label=`[[!%asi.level_topics?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`Topics`]]
                                </div>


                                [[-
                                <div class="contentDropdown select-topics" data-g="search-select-topics">
                                    [[$asi_search_select_dropdown? &entity=`topics` &tip_id=`Topics`]]
                                </div>

                                <div class="contentDropdown select-topics" data-g="search-select-topics">
                                    [[$asi_search_select_dropdown? &entity=`using` &label=`[[!%asi.label_search_using?
                                    &topic=`label` &namespace=`asi`]]` &tip_id=`Using`]]
                                </div>
                                ]]

                            </form>
                        </div>
                        <div class="col-md-9">
                            <div data-section="search_results">

                            </div>
                        </div>
                    </div>
                </div>
                [[-
                <div id="contextTab" class="tab-pane fade">
                    <div class="resultsControls text-center">
                        <h5 class="resultsCount">
                            [[%asi.search_results? &topic=`default` &namespace=`asi`]] (<span
                                    data-populate="results_count"></span> [[!%asi.results? &topic=`default`
                            &namespace=`asi`]])
                        </h5>
                        [[- [[++tt_search_results_save:notempty=`
                        <div class="tipButton">
                            <div class="tipIcon" data-tooltip-content="#searchSaveTooltip">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <a data-trigger="save_search" class="button blue small" href="#accountNeededPopup"><i
                                        class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions`
                                &namespace=`asi`]]</a>
                        </div>
                        `:default=`
                        <a data-trigger="save_search" class="button blue small" href="#accountNeededPopup"><i
                                    class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                        `]] ]]
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
                                            <input data-filter-type="tile_filter"
                                                   data-filter-target="context-view-countries"
                                                   data-filter-field-name="countries" type="text" name="search"
                                                   placeholder="[[!%asi.find_country? &topic=`input` &namespace=`asi`]]">
                                        </div>
                                    </form>
                                    <div class="sortBy">
                                        <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                        <div class="selectDropdown">
                                            <div class="title">
                                                [[- @TODO - this will need new lexicons I think ]]

                                                [[- OLD !%asi.most_results? &topic=`search` &namespace=`asi`]]
                                                Name A-Z
                                            </div>
                                            <div class="inner">

                                                [[- OLD <a href="#">[[!%asi.most_results? &topic=`search`
                                                    &namespace=`asi`]]</a>]]
                                                <a data-order="tile_order" data-order-target="countries"
                                                   data-order-type="a-z" data-container-target="#contextCountry"
                                                   href="#">Name A-Z</a>
                                                <a data-order="tile_order" data-order-target="countries"
                                                   data-order-type="z-a" data-container-target="#contextCountry"
                                                   href="#">Name Z-A</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="toggleSlideUp" href="#countrySort">[[!%asi.sort? &topic=`actions`
                                        &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                                    <a class="toggleShow"><span>[[!%asi.hide? &topic=`actions` &namespace=`asi`]]</span>
                                        <i class="far fa-angle-up ml"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="inner">
                            <div class="row" data-populate="context-view-countries">

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
                                            <input data-filter-type="tile_filter"
                                                   data-filter-target="context-view-institutions"
                                                   data-filter-field-name="institutions" type="text" name="search"
                                                   placeholder="[[!%asi.input_ph_find_institution? &topic=`input` &namespace=`asi`]]">
                                        </div>
                                    </form>
                                    <div class="sortBy">
                                        <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                        <div class="selectDropdown">
                                            <div class="title">
                                                [[- @TODO - this will need new lexicons I think ]]

                                                [[- OLD !%asi.most_results? &topic=`search` &namespace=`asi`]]
                                                Name A-Z
                                            </div>
                                            <div class="inner">

                                                [[- OLD <a href="#">[[!%asi.most_results? &topic=`search`
                                                    &namespace=`asi`]]</a>]]
                                                <a data-order="tile_order" data-order-target="institutions"
                                                   data-order-type="a-z" data-container-target="#contextInstitution"
                                                   href="#">Name A-Z</a>
                                                <a data-order="tile_order" data-order-target="institutions"
                                                   data-order-type="z-a" data-container-target="#contextInstitution"
                                                   href="#">Name Z-A</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="toggleSlideUp" href="#institutionSort">[[!%asi.sort? &topic=`actions`
                                        &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                                    <a class="toggleShow"><span>[[!%asi.hide? &topic=`actions` &namespace=`asi`]]</span>
                                        <i class="far fa-angle-up ml"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="inner">
                            <div class="countryList">

                                <div class="row" data-populate="context-view-institutions">
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
                                            <input data-control="update_term" data-filter-field-name="search_aids"
                                                   type="text" name="search"
                                                   placeholder="[[!%asi.input_find_guide_or_aid? &topic=`input` &namespace=`asi`]]">
                                        </div>
                                    </form>
                                    <div class="sortBy">
                                        <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                                        <div class="selectDropdown" data-control="sort_by">
                                            <div class="title">
                                                [[!%asi.filter_relevance? &topic=`default` &namespace=`asi`]]
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.filter_relevance? &topic=`default`
                                                    &namespace=`asi`]]</a>
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.filter_date? &topic=`default` &namespace=`asi`]]</a>
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.reference_code? &topic=`default`
                                                    &namespace=`asi`]]</a>
                                            </div>
                                            <div class="inner">
                                                <a href="#">[[!%asi.finding_aid_no? &topic=`default`
                                                    &namespace=`asi`]]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="toggleSlideUp upM" href="#aidSort">[[!%asi.sort? &topic=`actions`
                                        &namespace=`asi`]] <i class="fas fa-sort ml"></i></a>
                                    <a class="toggleShow"><span>[[!%asi.hide? &topic=`actions` &namespace=`asi`]]</span>
                                        <i class="far fa-angle-up ml"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="checkboxes formStandard" data-facet-set="types">
                                    <span class="checkbox-list checkbox" data-facet-item-set="types"
                                          data-facet-item="hg" data-search-filter-field="hg">
        								<input data-filter-field="types" data-filter-value="hg"
                                               data-filter-type="context_check" type="checkbox" name="holding"
                                               value="1">
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
                                    <span class="checkbox" data-facet-item-set="types" data-facet-item="fa"
                                          data-search-filter-field="fa">
        								<input data-filter-field="types" data-filter-value="fa"
                                               data-filter-type="context_check" type="checkbox" name="fa" value="1">
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
                        <div class="inner" data-section="search_aids">

                        </div>
                    </div>
                </div>
                ]]
            </div>
        </div>
    </div>
    <div class="container">
        <ul class="paging" data-control="pagination">
            <li data-paginate="first" class="first"><a href="#"><i class="far fa-angle-double-left"></i><span> [[!%asi.pg_first? &topic=`default` &namespace=`asi`]]</a></span>
            </li>
            <li data-paginate="prev" class="prev"><a href="#"><i class="far fa-angle-left"></i><span> [[!%asi.pg_previous? &topic=`default` &namespace=`asi`]]</a></span>
            </li>
            <span data-paginate="pages"></span>
            <li data-paginate="next" class="next"><a
                        href="#"><span>[[!%asi.pg_next? &topic=`default` &namespace=`asi`]] </span><i
                            class="far fa-angle-right"></i></a></li>
            <li data-paginate="last" class="last"><a
                        href="#"><span>[[!%asi.pg_last? &topic=`default` &namespace=`asi`]] </span><i
                            class="far fa-angle-double-right"></i></a></li>
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
    [[-<a class="toggleSlideUp" data-toggle="modal" href="#searchWithinPopup"><i class="fas fa-search yellow"></i>
        [[!%asi.search_in_institutions? &topic=`search` &namespace=`asi`]]</a>]]
    [[-<a data-trigger="save_search" class="toggleSlideUp" href="#saveSearchPopup"><i class="fas fa-save blue"></i>
        [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>]]
    <a class="toggleSlideUp aLink" href="#innerHero"><i class="fas fa-pencil pink"></i> [[!%asi.tools_edit?
        &topic=`default` &namespace=`asi`]]</a>
    <a class="toggleFilters toggleSlideUp"><i class="fas fa-list"></i> [[!%asi.sort_filters? &topic=`default`
        &namespace=`asi`]]</a>
    <a class=""><i class="fas fa-life-ring"></i> [[!%asi.help? &topic=`default` &namespace=`asi`]]</a>

</div>

<script>
    var enable_search = true; // this enables the search JS on this page
    var section = 'search-in-archives';
</script>

[[!$asi_logged_in_js]]

[[$scripts]]

<script>


    $('.countryItem, .institutionItem').click(function () {
        $(this).toggleClass('active');
    });

    $('.moreListInst').each(function () {
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

        $(this).find('.item:lt(' + x + ')').css('display', 'block');

        more.click(function () {
            x = (x + y <= items) ? x + y : items;
            list.find('.item:lt(' + x + ')').css('display', 'block');
            less.show();
            if (x == items) {
                more.hide();
            }
        });

        less.click(function () {
            x = (x - y < z) ? z : x - y;
            list.find('.item').not(':lt(' + x + ')').hide();
            more.show();
            less.show();
            if (x == z) {
                less.hide();
            }
        });
    });

    $(".switchModals").click(function (e) {
        $("#saveSearchPopup").modal('hide');
        setTimeout(function () {
            $("#searchSavedPopup").modal('show');
        }, 800);
        e.preventDefault();
    });


</script>

</body>
</html>
