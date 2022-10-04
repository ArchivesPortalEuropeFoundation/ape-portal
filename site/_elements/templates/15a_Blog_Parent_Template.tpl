[[!blogPaging]]
<!DOCTYPE html>
<html lang="[[!++cultureKey]]">

<head>
    [[$head]]
</head>

<body>
    [[$header]]

    [[$innerHero]]

    <section class="noTopMargin">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-push-9">
                    <div class="row">
                        <div class="col-sm-6 col-md-12">
                            <div class="blogSearch">
                                <h4>[[!%asi.title_search_the_blog? &topic=`default` &namespace=`asi`]]</h4>
                                [[+blogSearchForm]]
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <div class="blogTags">
                                <h3>[[!%asi.title_categories? &topic=`default` &namespace=`asi`]]</h3>
                                [[!+tag.tag_name:notempty=`<li><a href="[[~13]]">All categories</a>`]]
                                    [[!TaggerGetTags? &groups=`3` &rowTpl=`taggerBlogCatsTpl` &sort=`{"rank": "ASC"}` &limit=`10`]]
                                    [[!TaggerGetTags? &groups=`3` &rowTpl=`taggerBlogCatsTpl` &sort=`{"rank": "ASC"}` &offset=`10` &limit=`100` &toPlaceholder=`moreTags`]]
                                    [[!+moreTags:notempty=`
                                    <div class="moreDropdownS">
                                        <div class="inner">
                                            [[+moreTags]]
                                        </div>
                                        <span class="title">[[!%asi.show_more? &topic=`actions` &namespace=`asi`]]</span>
                                    </div>
                                    `]]
                            </div>
                            <div class="blogTagsMobile">
                                <div class="selectDropdown">
                                    <div class="title">[[!%asi.title_categories? &topic=`default` &namespace=`asi`]]</div>
                                    <div class="inner">
                                        [[!+tag.tag_name:notempty=`<li><a href="[[~13]]">All categories</a>`]]
                                            [[!TaggerGetTags? &groups=`3` &rowTpl=`taggerBlogCatsTpl` &sort=`{"rank": "ASC"}`]]
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blogSubscribe">
                        [[!blog_subscribe]]
                    </div>
                    <div class="blogEvents">
                        <h3>[[!%asi.title_events? &topic=`default` &namespace=`asi`]]</h3>
                        [[pdoResources?
                        &parents=`[[BabelTranslation:default=`116`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`116`]]`
                        &tpl=`sidebarEventTpl`
                        &limit=`2`
                        &sortby=`{"eventStart":"DESC", "eventCountry":"[[+usrCountry]]"}`
                        &includeTVs=`eventTitle,eventStart,eventEnd,eventCountry`
                        ]]
                        [[-<a class="button blue full" href="[[~116]]">[[!%asi.action_view_calendar? &topic=`actions` &namespace=`asi`]]</a>]]
                    </div>
                </div>
                <div class="col-md-9 col-md-pull-3">
                    <div id="blogList" [[!+tag.tag:neq=``:then=` class="showingTags" `]]>
                        [[!SimpleSearchForm?
                        &landing=`13`
                        &tpl=`blogSearchFormTpl`
                        &searchIndex=`blogSearch`
                        &toPlaceholder=`blogSearchForm`
                        ]]
                        [[!SimpleSearch?
                        &ids=`13,116`
                        &tpl=`blogSearchTpl`
                        &containerTpl=`blogSearchContainerTpl`
                        &noResultsTpl=`blogSearchNoResultsTpl`
                        &searchIndex=`blogSearch`
                        &perPage=`6`
                        &pagingSeparator=``
                        &pageTpl=`blogSearchPageLinkTpl`
                        &currentPageTpl=`blogSearchCurrentLinkTpl`
                        &showExtract=`0`
                        &includeTVs=`1`
                        &tvPrefix=`tv.`
                        &includeTVs=`articleTitle,eventTitle,refImage60`
                        &processTVs=`refImage60`
                        &placeholderPrefix=`blogSearch.`
                        &toPlaceholder=`blogSearchResults`
                        &pageLimit=`10`
                        &pageNextTpl=`@INLINE <li class="next"><a rel="next" href="[[+link]]">[[!%asi.pg_next? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-right ml"></i></a></li>`
                        &pagePrevTpl=`@INLINE <li class="prev"><a rel="prev" href="[[+link]]"><i class="far fa-angle-left mr"></i> [[!%asi.pg_previous? &topic=`default` &namespace=`asi`]]</a></li>`
                        &pageFirstTpl=`@INLINE <li class="first"><a href="[[+link]]"><i class="far fa-angle-double-left mr"></i> [[!%asi.pg_first? &topic=`default` &namespace=`asi`]]</a></li>`
                        &pageLastTpl=`@INLINE <li class="last"><a href="[[+link]]">[[!%asi.pg_last? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-double-right ml"></i></a></li>`
                        ]]
                        [[!+blogSearchTrue:notempty=`
                        [[+blogSearchResults]]
                        `:default=`
                        <h4 class="tagsHidden">[[!%asi.title_highlights? &topic=`default` &namespace=`asi`]]:</h4>
                        <div id="blogFeaturedSlider" class="tagsHidden">
                            [[!pdoResources?
                            &parents=`[[*id]]`
                            &resources=`[[*blogFeatured]]`
                            &tpl=`blogSlideTpl`
                            &limit=`6`
                            &select=`{"modResource":"id,pagetitle,publishedon"}`
                            &sortby=`{"publishedon":"DESC"}`
                            &includeTVs=`articleTitle,refImage60`
                            &processTVs=`refImage60`
                            ]]
                        </div>
                        <div class="row mb40 tagsHidden">
                            [[!pdoResources?
                            &parents=`[[*id]]`
                            &resources=`[[*blogImportant]]`
                            &tpl=`blogImportantTpl`
                            &setTotal=`1`
                            &&totalVar=`count`
                            &limit=`2`
                            &select=`{"modResource":"id,pagetitle,publishedon"}`
                            &sortby=`{"publishedon":"DESC"}`
                            &includeTVs=`articleTitle,refImage60`
                            &processTVs=`refImage60`
                            ]]
                        </div>
                        <h5 class="tagsHidden">[[!%asi.title_all_content? &topic=`default` &namespace=`asi`]]:</h5>
                        [[!+tag.tag_name:notempty=`
                        <h4 class="catInfo">[[!%asi.title_showing_n_results_for_term? &topic=`default` &namespace=`asi`]]</h4>
                        `]]
                        [[!pdoPage?
                        &parents=`[[*id]]`
                        &resources=`[[*blogFeatured:append=`,[[*blogImportant]]`:prepend=`-`:replace=`,==,-`]]`
                        &tpl=`blogSingleTpl`
                        &limit=`6`
                        &select=`{"modResource":"id,pagetitle,publishedon"}`
                        &sortby=`{"publishedon":"DESC"}`
                        &includeTVs=`articleTitle,refImage60`
                        &processTVs=`refImage60`
                        &tplPageWrapper=`@INLINE [[+first]][[+prev]][[+pages]][[+next]][[+last]]`
                        &tplPage=`@INLINE <li><a href="[[+href]]">[[+pageNo]]</a></li>`
                        &tplPageActive=`@INLINE <li class="active"><a href="[[+href]]">[[+pageNo]]</a></li>`
                        &tplPageNext=`@INLINE <li class="next"><a href="[[+href]]">[[!%asi.pg_next? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-right ml"></i></a></li>`
                        &tplPagePrev=`@INLINE <li class="prev"><a href="[[+href]]"><i class="far fa-angle-left mr"></i> [[!%asi.pg_previous? &topic=`default` &namespace=`asi`]]</a></li>`
                        &tplPageFirst=`@INLINE <li class="first"><a href="[[+href]]"><i class="far fa-angle-double-left mr"></i> [[!%asi.pg_first? &topic=`default` &namespace=`asi`]]</a></li>`
                        &tplPageLast=`@INLINE <li class="last"><a href="[[+href]]">[[!%asi.pg_last? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-double-right ml"></i></a></li>`
                        &tplPageFirstEmpty=`@INLINE `
                        &tplPageLastEmpty=`@INLINE `
                        &tplPagePrevEmpty=`@INLINE `
                        &tplPageNextEmpty=`@INLINE `
                        [[!+tag.tag:neq=``:then=`&where=`[[!TaggerGetResourcesWhere? &tags=`[[+tag.tag]]` &where=`{"isfolder": 0}`]]``:else=``]]
                        ]]
                        [[!+page.nav:notempty=`
                        <div class="paging left">
                            <ul>[[!+page.nav]]</ul>
                        </div>
                        `]]
                        `]]
                    </div>
                </div>
            </div>
            <div id="mobileAppend"></div>
        </div>
    </section>

    [[$footer]]

    [[$banners]]

    [[$tooltips]]

    [[$blogSubscribePopup]]

    [[$scripts]]

    <script>
        if ($(window).width() < 992) {
            $('.blogSubscribe, .blogEvents').detach().appendTo('#mobileAppend');
        };
    </script>

</body>

</html>
