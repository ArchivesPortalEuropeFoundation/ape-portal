<!DOCTYPE html>
<html lang="[[!++cultureKey]]">

<head>
    [[$head]]
    <style>
        .otherLink {
            color: #b23063;
            font-weight: 700;
        }

        .boxrow {
            display: block;
            content-visibility: auto;
        }

        .boxcol {
            display: inline-block;
        }

        .boxcol.left {
            float: left;
        }

        .boxcol.right {
            float: right;
        }

        [data-facet-set="countries"] li {
            display: none;
        }

        #showMore-countries {
            color: #b23063;
            font-weight: 700;
            cursor: pointer;
        }

        #showMore-countries:hover {
            color: black;
        }

        #showLess-countries {
            color: #b23063;
            font-weight: 700;
            cursor: pointer;
            display: none;
        }

        #showLess-countries:hover {
            color: black;
        }


        [data-facet-set="repositoryTypeFacet"] li {
            display: none;
        }

        #showMore-repositoryTypeFacet {
            color: #b23063;
            font-weight: 700;
            cursor: pointer;
        }

        #showMore-repositoryTypeFacet:hover {
            color: black;
        }

        #showLess-repositoryTypeFacet {
            color: #b23063;
            font-weight: 700;
            cursor: pointer;
            display: none;
        }

        #showLess-repositoryTypeFacet:hover {
            color: black;
        }
    </style>
</head>

<body>
    [[$header]]

    [[!country_filters_check]]

    <style>
        #advSearchControls.blueBG .contentDropdown {
            color: #555;
        }

        #advSearchControls.blueBG .contentDropdown .checkbox input::before,
        #advSearchControlsP.blueBG .contentDropdown .checkbox input::before {
            color: #555;
        }

        #advSearchControls.blueBG .contentDropdown .tipTitle {
            padding-left: 0;
            color: #AAA;
        }

        #advSearchControls.blueBG .contentDropdown .tooltipstered {
            display: none;
        }

        #advSearchControls.blueBG .contentDropdown {
            padding: 11px 10px 5px 10px;
            border: none;
        }

        #advSearchControls.blueBG .contentDropdown>.title:after {
            top: 12px;
            color: #AAA;
        }
    </style>

    <div class="altSlideOut pb10 replace">
        <div class="container">
            <div class="clearfix">
                <div class="left">
                    <strong data-display="results_count" style="display: none;"><span data-populate="results_count">100,000</span> [[!%asi.results? &topic=`default` &namespace=`asi`]]</strong>
                    <a class="visible-xs toggleSlideUp posR" href="#toolsSlideUp"><i class="fas fa-ellipsis-h"></i></a>
                </div>
                <div class="right">
                    [[- <a data-trigger="save_search" data-trigger="save_search" class="yellowIcon" href="#searchWithinPopup" data-toggle="modal"><i class="fas fa-search mr"></i> [[!%asi.search_within_institutions? &topic=`default` &namespace=`asi`]]</a>
                    <a class="blueIcon" data-trigger="save_search" href="#saveSearchPopup"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a> ]]
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
                    [[++tt_search_main:notempty=`
                    <div class="tipIcon" data-tooltip-content="#searchMainTooltip">
                        <i class="far fa-question-circle"></i>
                    </div>
                    `]]
                    <a data-navigate="search-in-archives" href="[[~50]]"><i class="fas fa-file"></i> <span class="tabTitle">[[!%asi.search_in_archives? &topic=`search` &namespace=`asi`]] </span><span class="count" data-count-type="search-in-archives" data-info="result_count"></span></a>
                    <a data-navigate="search-in-names" href="[[~51]]"><i class="fas fa-user"></i> <span class="tabTitle">[[!%asi.search_in_names? &topic=`search` &namespace=`asi`]] </span><span class="count" data-count-type="search-in-names" data-info="result_count"></span></a>
                    <a data-navigate="search-in-institutions" class="active"><i class="fas fa-building"></i> <span class="tabTitle">[[!%asi.search_in_institutions? &topic=`search` &namespace=`asi`]] </span><span data-count-type="search-in-institutions" data-info="result_count" class="count"></span></a>
                </div>
            </div>
            <div id="searchContainer" class="blueBG">
                <form class="search large countries" action="[[~[[*id]]]]" method="post">
                    <input type="text" autocomplete="off" data-input="search_term" class="searchField" name="search" placeholder="[[!%asi.type_search_term? &topic=`input` &namespace=`asi`]]" value="[[!from_request?&input=`term`]]">
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
                                    <input data-g="search-filter" data-search-target="countries" type="text" name="search" placeholder="[[!%asi.find_country? &topic=`input` &namespace=`asi`]]" autocomplete="off">
                                </div>
                            </div>

                            [[$static_country_list]]
                        </div>
                        [[-[[$asi_search_select_dropdown? &entity=`countries` &label=`[[!%asi.search_in_all_countries? &topic=`search` &namespace=`asi`]]` &tiptitle=`0`]]]]
                    </div>
                    <span class="clearSearch"><i class="fas fa-times"></i></span>
                    <div class="tools clearfix">
                        <a class="expandAdv">[[!%asi.show_adv_options? &topic=`search` &namespace=`asi`]] <i class="fas fa-angle-down"></i></a>
                        <div class="checkboxes" data-control="checkbox_filters">
                            <span class="checkbox">
                                <input data-filter-field="separate" data-filter-value="true" data-filter-type="boolean" type="checkbox" name="separate">
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
                            <div class="col-sm-6 col-md-4 col-lg-5">
                                <div class="advControl">
                                    <div class="tipTitle">
                                        <div class="tipIcon" data-tooltip-content="#searchElementInstitutionTooltip">
                                            <i class="far fa-question-circle"></i>
                                        </div>
                                        <p class="strongLabel">[[!%asi.search_using? &topic=`search` &namespace=`asi`]]</p>
                                    </div>

                                    <div class="contentDropdown">
                                        <div class="title">
                                            <div class="tipTitle">
                                                <div class="tipIcon tooltipstered" data-tooltip-content="#searchElementInstitutionTooltip">
                                                    <i class="far fa-question-circle"></i>
                                                </div>
                                                [[!%asi.search_using? &topic=`search` &namespace=`asi`]]
                                            </div>
                                        </div>
                                        <div class="inner">

                                            [[-
                                            <div class="searchLight">
                                                <div class="inputWrapper">
                                                    <i class="fas fa-search"></i>
                                                    <input data-g="search-filter" data-search-target="types" type="text" name="search" placeholder="[[!%asi.input_find_doc_type? &topic=`input` &namespace=`asi`]]" autocomplete="off">
                                                </div>
                                            </div>
                                            ]]

                                            <div class="checkboxList" data-control="using">
                                                [[- using is populated by search.js ]]
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-5">
                                <div class="advControl">
                                    <div class="tipTitle">
                                        <div class="tipIcon" data-tooltip-content="#searchArchiveTooltip">
                                            <i class="far fa-question-circle"></i>
                                        </div>
                                        <p class="strongLabel">[[!%asi.search_archive_type? &topic=`search` &namespace=`asi`]]</p>
                                    </div>

                                    <div class="contentDropdown">
                                        <div class="title">
                                            <div class="tipTitle">
                                                <div class="tipIcon tooltipstered" data-tooltip-content="#searchArchiveTooltip">
                                                    <i class="far fa-question-circle"></i>
                                                </div>
                                                [[!%asi.search_archive_type? &topic=`search` &namespace=`asi`]]
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
                            <div class="col-md-4 col-lg-2">
                                <div class="advSubmit inLine">
                                    <a class="button large pink borders submitSearch1" data-control="search_term_trigger"><i class="fas fa-search"></i> [[!%asi.btn_search? &topic=`actions` &namespace=`asi`]]</a>
                                    <a class="hideAdv">[[!%asi.hide_adv_search_options? &topic=`search` &namespace=`asi`]]<i class="fas fa-angle-up"></i></a>
                                </div>
                            </div>
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

    <div class="loading-spinner" data-display="loading-spinner">
        <img src="/assets/images/spinner.gif" />
    </div>


    <section id="resultsTabs" class="hidden" data-section="has_results">
        <div class="greyBG">
            <div class="container">
                <div class="resultsControls row">
                    <div class="col-md-9">
                        <h5 class="resultsCount">
                            [[%asi.search_results? &topic=`default` &namespace=`asi`]] (<span data-populate="results_start"></span>-<span data-populate="results_end"></span> / <span data-populate="results_count"></span> [[!%asi.results? &topic=`default` &namespace=`asi`]])
                        </h5>
                        [[- [[++tt_search_results_save:notempty=`
                        <div class="tipButton">
                            <div class="tipIcon" data-tooltip-content="#searchSaveTooltip">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <a class="button blue small" data-trigger="save_search" href="#saveSearchPopup"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                        </div>
                        `:default=`
                        <a class="button blue small" data-trigger="save_search" href="#saveSearchPopup"><i class="fas fa-save mr"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>
                        `]] ]]
                        <a class="button blue small toggleFilters"><i class="fas fa-list mr"></i> [[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]</a>
                        [[- <a class="button pink small" href="#searchWithinPopup" data-toggle="modal"><i class="fas fa-search mr"></i> [[!%asi.search_within? &topic=`search` &namespace=`asi`]]</a> ]]
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
                                            <a href="#">[[!%asi.filter_relevance? &topic=`default` &namespace=`asi`]]</a>
                                        </div>
                                    </div>
                                </div>
                                <h3>[[!%asi.your_filters? &topic=`default` &namespace=`asi`]]</h3>
                            </div>

                            <div class="contentDropdown select-countries" data-g="search-select-countries">
                                [[$asi_search_select_dropdown? &entity=`countries` &tip_id=`Country` &label=`[[!%asi.label_countries? &topic=`label` &namespace=`asi`]]`]]
                            </div>

                            <div class="contentDropdown select-countries" data-g="search-select-countries">
                                [[$asi_search_select_dropdown? &entity=`repositoryTypeFacet` &label=`[[!%asi.label_archive_type? &topic=`label` &namespace=`asi`]]` &tip_id=`ArchiveType`]]

                            </div>

                        </form>
                    </div>
                    <div class="col-md-9">
                        <div data-section="search_results">

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

    [[$searchWithinPopup]]

    [[$accountNeededPopup]]

    [[$banners]]

    [[$tooltips]]

    <div id="toolsSlideUp" class="slideUp">
        <span class="closeIcon toggleSlideUp"><i class="fas fa-times"></i></span>
        [[- <a class="toggleSlideUp" data-toggle="modal" href="#searchWithinPopup"><i class="fas fa-search yellow"></i> [[!%asi.search_in_institutions? &topic=`search` &namespace=`asi`]]</a>
        <a class="toggleSlideUp" data-trigger="save_search" href="#saveSearchPopup"><i class="fas fa-save blue"></i> [[!%asi.save_search? &topic=`actions` &namespace=`asi`]]</a>]]
        <a class="toggleSlideUp aLink" href="#innerHero"><i class="fas fa-pencil pink"></i> [[!%asi.tools_edit? &topic=`default` &namespace=`asi`]]</a>
        <a class="toggleFilters toggleSlideUp"><i class="fas fa-list"></i> [[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]</a>
        <a class=""><i class="fas fa-life-ring"></i> [[!%asi.help? &topic=`default` &namespace=`asi`]]</a>
    </div>

    <script>
        var enable_search = true; // this enables the search JS on this page
        var section = 'search-in-institutions';
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