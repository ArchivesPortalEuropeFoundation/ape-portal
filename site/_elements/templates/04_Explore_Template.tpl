<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
<head>
    [[$head]]
</head>
<body>
[[$header]]
[[!getContextSetting? &context=`[[!+contextKey]]`]]
[[$innerHero]]

[[+alternatingContent:notempty=`
<section class="noTopMargin alternatingContent">
    <div class="container">
        [[getImageList?
        &tvname=`alternatingContent`
        &tpl=`alternatingContentATpl`
        &tpl_n2=`alternatingContentBTpl`
        &toPlaceholder=`alternatingContent`
        ]]
        [[+alternatingContent]]
    </div>
</section>
`]]

<section class="noTopMargin" id="exploreTabs">
    <div class="container">
        <div class="content text-center">
            [[*exploreSubTitle:notempty=`<h4 class="superTitle">[[*exploreSubTitle]]</h4>`]]
            [[*exploreTitle]]
        </div>
        <ul class="nav-tabs buttons">
            <li class="[[!getUrlParamBoth:is=`true`:or:is=`both`:then=`active`:else=``? &param1=`search` &param2=`searchTopic`]]"><a href="#tabDocuments" data-tabID="10" data-toggle="tab">[[!%asi.title_highlights? &topic=`default` &namespace=`asi`]]</a></li>
            <li class="[[!getUrlParamBoth:is=`true`:then=`active`:else=``? &param1=`searchTopic` &param2=`search`]]"><a href="#tabTopics" data-tabID="20" data-toggle="tab">[[!%asi.tab_topics? &topic=`default` &namespace=`asi`]]</a></li>
        </ul>
        <a class="anchor" id="tabSection"></a>

        <div class="tab-content">
            <div id="tabDocuments" class="tab-pane fade [[!getUrlParamBoth:is=`true`:or:is=`both`:then=`active in`:else=``? &param1=`search` &param2=`searchTopic`]]">
                [[*exploreDocsText:notempty=`
                <div class="content text-center">
                    [[*exploreDocsText]]
                </div>
                `]]
                <div class="exploreControls row">
                    <div class="col-sm-5 col-md-4">
                        <form class="searchLight">
                            <div class="inputWrapper">
                                <i class="fas fa-search"></i>
                                <span class="clear_search documents"><a href=""><i class="fas fa-times"></i></a></span>
                                <input type="text" name="search" placeholder="[[!%asi.input_ph_find_featured_doc? &topic=`input` &namespace=`asi`]]" value="[[!getUrlParam? &name=`search`]]">
                                <input type="hidden" name="sortbyD" value="[[!getUrlParam? &name=`sortbyD`]]"/>
                                <input type="hidden" id="viewD_input" name="viewD" value="[[!getUrlParam:is=``:or:is=`full`:then=`full`:else=`list`? &name=`viewD`]]"/>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-7 col-md-5 col-md-offset-3">
                        <div class="view">
                            <strong>[[!%asi.view_doc_label? &topic=`default` &namespace=`asi`]]: </strong>
                            <ul class="nav-tabs">
                                <li class="[[!getUrlParam:is=``:or:is=`full`:then=`active`:else=``? &name=`viewD`]]"><a id="a_view_full" href="#tabDocumentsFull" data-tabID="10" data-toggle="tab"><i class="fas fa-images"></i></a></li>
                                <li class="[[!getUrlParam:is=`list`:then=`active`:else=``? &name=`viewD`]]"><a id="a_view_list" href="#tabDocumentsList" data-tabID="11" data-toggle="tab"><i class="fas fa-list"></i></a></li>
                            </ul>
                        </div>
                        <div class="sortBy">
                            <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                            <div class="selectDropdown">
                                <div class="title">
                                    [[!getUrlParam:is=``:or:is=`newest`:then=`[[!%asi.order_new_first? &topic=`filters` &namespace=`asi`]]`? &name=`sortbyD`]]
                                    [[!getUrlParam:is=`oldest`:then=`[[!%asi.order_old_first? &topic=`filters` &namespace=`asi`]]`? &name=`sortbyD`]]
                                    [[!getUrlParam:is=`a-z`:then=`[[!%asi.filter_name_a_z? &topic=`filters` &namespace=`asi`]]`? &name=`sortbyD`]]
                                    [[!getUrlParam:is=`z-a`:then=`[[!%asi.filter_name_z_a? &topic=`filters` &namespace=`asi`]]`? &name=`sortbyD`]]
                                </div>



                                <div class="inner">


                                    <a id="a_sorting_d1" href="[[~[[*id]]]]?sortbyD=newest[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]][[!getUrlParam:ne=``:then=`&viewD=[[!getUrlParam? &name=`viewD`]]`:else=`&viewD=full`? &name=`viewD`]]#tabSection">[[!%asi.order_new_first? &topic=`filters` &namespace=`asi`]]</a>
                                    <a id="a_sorting_d2" href="[[~[[*id]]]]?sortbyD=oldest[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]][[!getUrlParam:ne=``:then=`&viewD=[[!getUrlParam? &name=`viewD`]]`:else=`&viewD=full`? &name=`viewD`]]#tabSection">[[!%asi.order_old_first? &topic=`filters` &namespace=`asi`]]</a>
                                    <a id="a_sorting_d3" href="[[~[[*id]]]]?sortbyD=a-z[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]][[!getUrlParam:ne=``:then=`&viewD=[[!getUrlParam? &name=`viewD`]]`:else=`&viewD=full`? &name=`viewD`]]#tabSection">[[!%asi.filter_name_a_z? &topic=`filters` &namespace=`asi`]]</a>
                                    <a id="a_sorting_d4" href="[[~[[*id]]]]?sortbyD=z-a[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]][[!getUrlParam:ne=``:then=`&viewD=[[!getUrlParam? &name=`viewD`]]`:else=`&viewD=full`? &name=`viewD`]]#tabSection">[[!%asi.filter_name_z_a? &topic=`filters` &namespace=`asi`]]</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div id="tabDocumentsFull" class="tab-pane fade [[!getUrlParam:is=``:or:is=`full`:then=`active in`:else=``? &name=`viewD`]]">

                        <div class="row moreList">

                         [[!pdoResources?
                            &parents=`[[+context.highlight_parent_id]]`
                            &tpl=`linkBlockStandard60Tpl`
                            &limit=`0`
                            &includeTVs=`heroTitle,refImage60,refText,showInList`
                            &processTVs=`refImage60`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`newest`:then=`&sortby=`{"editedon":"DESC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`oldest`:then=`&sortby=`{"editedon":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"pagetitle":"ASC", "heroTitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"pagetitle":"DESC", "heroTitle":"DESC"}``? &name=`sortbyD`]]
                            &where=`[[!getUrlParam:notempty=`[{"parent:=":[[!++highlight_parent_id]]}, {"pagetitle:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" },{ "OR:refText:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" }]`? &name=`search`]] `
                            ]]

                            [[-
                            [[!#GET.search:notempty=`
                                [[!pdoResources?
                                    &parents=`[[+context.highlight_parent_id]]`
                                    &tpl=`linkBlockStandard60Tpl`
                                    &limit=`0`

                                    &includeTVs=`heroTitle,refImage60,refText,refType,showInList`
                                    &processTVs=`refImage60`
                                    &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`newest`:then=`&sortby=`{"publishedon":"DESC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`oldest`:then=`&sortby=`{"publishedon":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"heroTitle":"ASC", "pagetitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"heroTitle":"DESC", "pagetitle":"DESC"}``? &name=`sortbyD`]]

                                    &where=`[{"pagetitle:LIKE":"%[[#GET.search]]%","OR:refText:LIKE":"%[[#GET.search]]%","AND:context_key:LIKE":"[[+contextKey]]","AND:parent:=":"[[+context.highlight_parent_id]]"}]`
                                ]]
                            `]]
                            [[!#GET.search:empty=`

                            [[pdoResources?
                            &parents=`[[+context.highlight_parent_id]]`
                            &tpl=`linkBlockStandard60Tpl`
                            &limit=`0`
                            &includeTVs=`heroTitle,refImage60,refText,refType,showInList`
                            &processTVs=`refImage60`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`a-z`:then=`&sortby=`{"heroTitle":"ASC", "pagetitle":"ASC"}``? &name=`sortbyT`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"heroTitle":"DESC", "pagetitle":"DESC"}``? &name=`sortbyT`]]
                            &where=`[[!getUrlParam:notempty=`[{"parent:=":[[!++highlight_parent_id]]}, {"pagetitle:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" },{ "OR:refText:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" }]`? &name=`search`]] `
                            ]]
                            `]]
                            ]]

                            [[!getUrlParam:empty=`
                            <div class="col-xs-12">
                                <div class="text-center mt30">
                                    <a class="showMore">[[!%asi.show_more? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-down"></i></a>
                                    <a class="showLess">[[!%asi.show_less? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-up"></i></a>
                                </div>
                            </div>`]]
                        </div>
                    </div>
                    <div id="tabDocumentsList" class="tab-pane [[!getUrlParam:is=`list`:then=`active in`:else=``? &name=`viewD`]] fade">
                        <div class="row">
                            [[!pdoResources?
                            &parents=`[[+context.highlight_parent_id]]`
                            &tpl=`exploreListTpl`
                            &limit=`0`
                            &includeTVs=`heroTitle,refText,showInList`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`newest`:then=`&sortby=`{"publishedon":"DESC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`oldest`:then=`&sortby=`{"publishedon":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"pagetitle":"ASC", "heroTitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"pagetitle":"DESC", "heroTitle":"DESC"}``? &name=`sortbyD`]]
                            &where=`[[!getUrlParam:notempty=`[{"parent:=":[[!++highlight_parent_id]]}, {"pagetitle:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" },{ "OR:refText:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" }]`? &name=`search`]] `
                            ]]
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabTopics" class="tab-pane fade [[!getUrlParamBoth:is=`true`:then=`active in`:else=``? &param1=`searchTopic` &param2=`search`]]">
                [[*exploreTopicsText:notempty=`
                <div class="content text-center">
                    [[*exploreTopicsText]]
                </div>
                `]]
                <div class="exploreControls row">
                    <div class="col-sm-5 col-md-4">
                        <form class="searchLight">
                            <div class="inputWrapper">
                                <i class="fas fa-search"></i>
                                <span class="clear_search topic"><a href=""><i class="fas fa-times"></i></a></span>
                                <input type="text" name="searchTopic" placeholder="[[!%asi.input_ph_find_featured_topic? &topic=`input` &namespace=`asi`]]" value="[[!getUrlParam? &name=`searchTopic`]]">
                                <input type="hidden" name="sortbyT" value="[[!getUrlParam? &name=`sortbyT`]]"/>
                                <input type="hidden" id="viewT_input" name="viewT" value="[[!getUrlParam:is=``:or:is=`full`:then=`full`:else=`list`? &name=`viewT`]]"/>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-7 col-md-5 col-md-offset-3">
                        <div class="view">
                            <strong>[[!%asi.view_doc_label? &topic=`default` &namespace=`asi`]]: </strong>
                            <ul class="nav-tabs">
                                <li class="[[!getUrlParam:is=``:or:is=`full`:then=`active`:else=``? &name=`viewT`]]"><a id="a_view_t_full" href="#tabTopicsFull" data-tabID="20" data-toggle="tab"><i class="fas fa-images"></i></a></li>
                                <li class="[[!getUrlParam:is=`list`:then=`active`:else=``? &name=`viewT`]]"><a id="a_view_t_list" href="#tabTopicsList" data-tabID="21" data-toggle="tab"><i class="fas fa-list"></i></a></li>
                            </ul>
                        </div>
                        <div class="sortBy">
                            <strong>[[!%asi.sort_filters? &topic=`default` &namespace=`asi`]]:</strong>
                            <div class="selectDropdown">
                                <div class="title">
                                    [[!getUrlParam:is=``:or:is=`a-z`:then=`[[!%asi.filter_name_a_z? &topic=`filters` &namespace=`asi`]]`? &name=`sortbyT`]]
                                    [[!getUrlParam:is=`z-a`:then=`[[!%asi.filter_name_z_a? &topic=`filters` &namespace=`asi`]]`? &name=`sortbyT`]]
                                </div>
                                <div class="inner">
                                    <a id="a_sorting_t1"  href="[[~[[*id]]]]?sortbyT=a-z&searchTopic=[[!getUrlParam? &name=`searchTopic`]][[!getUrlParam:ne=``:then=`&viewT=[[!getUrlParam? &name=`viewT`]]`:else=`&viewT=full`? &name=`viewT`]]#tabSection">[[!%asi.filter_name_a_z? &topic=`filters` &namespace=`asi`]]</a>
                                    <a id="a_sorting_t2"  href="[[~[[*id]]]]?sortbyT=z-a&searchTopic=[[!getUrlParam? &name=`searchTopic`]][[!getUrlParam:ne=``:then=`&viewT=[[!getUrlParam? &name=`viewT`]]`:else=`&viewT=full`? &name=`viewT`]]#tabSection">[[!%asi.filter_name_z_a? &topic=`filters` &namespace=`asi`]]</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tabTopicsFull" class="tab-pane fade [[!getUrlParam:is=``:or:is=`full`:then=`active in`:else=``? &name=`viewT`]]">
                        <div class="row moreList">
                            [[!#GET.searchTopic:notempty=`

                            [[!pdoResources?
                            &parents=`[[+context.topic_parent_id]]`
                            &tpl=`linkBlockStandard60Tpl`
                            &limit=`0`

                            &includeTVs=`heroTitle,refImage60,refText,refType,showInList`
                            &processTVs=`refImage60`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`newest`:then=`&sortby=`{"publishedon":"DESC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`oldest`:then=`&sortby=`{"publishedon":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"pagetitle":"ASC", "heroTitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"pagetitle":"DESC", "heroTitle":"DESC"}``? &name=`sortbyD`]]

                            &where=`[{"pagetitle:LIKE":"%[[#GET.searchTopic]]%","OR:refText:LIKE":"%[[#GET.searchTopic]]%","AND:context_key:LIKE":"[[+contextKey]]","AND:parent:=":"[[+context.topic_parent_id]]"}]`
                            ]]
                            `]]
                            [[!#GET.searchTopic:empty=`
                            [[pdoResources?
                            &parents=`[[+context.topic_parent_id]]`
                            &tpl=`linkBlockStandard60Tpl`
                            &limit=`0`
                            &includeTVs=`heroTitle,refImage60,refText,refType,showInList`
                            &processTVs=`refImage60`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`a-z`:then=`&sortby=`{"pagetitle":"ASC", "heroTitle":"ASC"}``? &name=`sortbyT`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"pagetitle":"DESC", "heroTitle":"DESC"}``? &name=`sortbyT`]]
                            &where=`[[!getUrlParam:notempty=`[{"parent:=":[[!++topic_parent_id]]}, {"pagetitle:LIKE": "%[[!getUrlParam? &name=`searchTopic`]]%", "AND:context_key:LIKE":"[[+contextKey]]" },{ "OR:refText:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" }]`? &name=`search`]] `
                            ]]
                            `]]

                            [[!getUrlParam:empty=`
                            <div class="col-xs-12">
                                <div class="text-center mt30">
                                    <a class="showMore">[[!%asi.show_more? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-down"></i></a>
                                    <a class="showLess">[[!%asi.show_less? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-up"></i></a>
                                </div>
                            </div>
                            `]]
                        </div>
                    </div>
                    <div id="tabTopicsList" class="tab-pane fade [[!getUrlParam:is=`list`:then=`active in`:else=``? &name=`viewT`]]">
                        [[+context.topic_parent_id]]
                        <div class="row">
                            [[!#GET.searchTopic:notempty=`

                            [[!pdoResources?
                            &parents=`[[+context.topic_parent_id]]`
                            &tpl=`exploreListTpl`
                            &limit=`0`

                            &includeTVs=`heroTitle,refImage60,refText,refType,showInList`
                            &processTVs=`refImage60`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`newest`:then=`&sortby=`{"publishedon":"DESC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`oldest`:then=`&sortby=`{"publishedon":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"pagetitle":"ASC", "heroTitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"pagetitle":"DESC", "heroTitle":"DESC"}``? &name=`sortbyD`]]

                            &where=`[{"pagetitle:LIKE":"%[[#GET.searchTopic]]%","OR:refText:LIKE":"%[[#GET.searchTopic]]%","AND:context_key:LIKE":"[[+contextKey]]","AND:parent:=":"[[+context.topic_parent_id]]"}]`
                            ]]
                            `]]
                            [[!#GET.searchTopic:empty=`
                            [[pdoResources?
                            &parents=`[[+context.topic_parent_id]]`
                            &tpl=`exploreListTpl`
                            &limit=`0`
                            &includeTVs=`heroTitle,refImage60,refText,refType,showInList`
                            &processTVs=`refImage60`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`a-z`:then=`&sortby=`{"heroTitle":"ASC", "pagetitle":"ASC"}``? &name=`sortbyT`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"heroTitle":"DESC", "pagetitle":"DESC"}``? &name=`sortbyT`]]
                            &where=`[[!getUrlParam:notempty=`[{"parent:=":[[!++topic_parent_id]]}, {"pagetitle:LIKE": "%[[!getUrlParam? &name=`searchTopic`]]%", "AND:context_key:LIKE":"[[+contextKey]]" },{ "OR:refText:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" }]`? &name=`search`]] `
                            ]]
                            `]]

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

<script>
    window.addEventListener("load", function(){
        var url = window.location.href;
        if(url.includes('searchTopic=')){
            [[-$('a[href="#tabTopics"]').tab('show');]]
            $('html, body').animate({scrollTop: $('#exploreTabs').offset().top -160 }, 'fast');

        } else if(url.includes('?tab=documents')){
            $('a[href="#tabDocuments"]').tab('show');
            $('html, body').animate({scrollTop: $('#exploreTabs').offset().top -160 }, 'fast');
        }
        else if(url.includes('search=')){
            $('html, body').animate({scrollTop: $('#exploreTabs').offset().top -160 }, 'fast');
        }

        if ($('.clear_search.topic a').length > 0) {
            var searchUrlRemove = window.location.href;
            var mainUrl = url.split('?')[0];
            var params = getQueryParams(window.location.search);
            if("searchTopic" in params) {
                if(params.searchTopic != null) {

                    //var targetBlocks = document.getElementById("exploreTabs").getElementsByClassName("searchMore")[0];
                    //for(let tbI = 0; i < targetBlocks.length; tbI++){
                    //    targetBlocks[tbI].className = "searchMoreDisabled";
                    //}
                    
                }
            } else if("search" in params) {
                if(params.search != null) {
                    //var targetBlocks = document.getElementById("exploreTabs").getElementsByClassName("searchMore")[0];
                    //for(let tbI = 0; tbI < targetBlocks.length; tbI++){
                    //   targetBlocks[tbI].className = "searchMoreDisabled";
                    //}
                    
                }
            }
            
            $('.clear_search.topic a').attr('href', mainUrl+'?searchTopic=&sortbyT=a-z');
            $('.clear_search.documents a').attr('href', mainUrl+'?search=&sortbyD=newest');

        }


        $( "#a_view_list" ).on( "click", function() {
            $( "#viewD_input" ).val("list");
            var href = $('#a_sorting_d1').attr('href');
            $('#a_sorting_d1').attr('href', href.replace("viewD=full","viewD=list"));
            $('#a_sorting_d2').attr('href', href.replace("viewD=full","viewD=list"));
            $('#a_sorting_d3').attr('href', href.replace("viewD=full","viewD=list"));
            $('#a_sorting_d4').attr('href', href.replace("viewD=full","viewD=list"));
        } );
        $( "#a_view_full" ).on( "click", function() {
            $( "#viewD_input" ).val("full");
            var href = $('#a_sorting_d1').attr('href');
            $('#a_sorting_d1').attr('href', href.replace("viewD=list","viewD=full"));
            $('#a_sorting_d2').attr('href', href.replace("viewD=list","viewD=full"));
            $('#a_sorting_d3').attr('href', href.replace("viewD=list","viewD=full"));
            $('#a_sorting_d4').attr('href', href.replace("viewD=list","viewD=full"));
        } );
        
        $( "#a_view_t_list" ).on( "click", function() {
            $( "#viewT_input" ).val("list");
            var href = $('#a_sorting_t1').attr('href');
            $('#a_sorting_t1').attr('href', href.replace("viewT=full","viewT=list"));
            $('#a_sorting_t2').attr('href', href.replace("viewT=full","viewT=list"));
        } );
        $( "#a_view_t_full" ).on( "click", function() {
            $( "#viewT_input" ).val("full");
            var href = $('#a_sorting_t1').attr('href');
            $('#a_sorting_t1').attr('href', href.replace("viewT=list","viewT=full"));
            $('#a_sorting_t2').attr('href', href.replace("viewT=list","viewT=full"));
        } );

    });

</script>

</body>
</html>
