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
            <li class="active"><a href="#tabDocuments" data-tabID="10" data-toggle="tab">[[!%asi.title_highlights? &topic=`default` &namespace=`asi`]]</a></li>
            <li><a href="#tabTopics" data-tabID="20" data-toggle="tab">[[!%asi.tab_topics? &topic=`default` &namespace=`asi`]]</a></li>
        </ul>
        <a class="anchor" id="tabSection"></a>
        <div class="tab-content">
            <div id="tabDocuments" class="tab-pane fade active in">
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
                                <span class="clear_search topic"><a href=""><i class="fas fa-times"></i></a></span>
                                <input type="text" name="search" placeholder="[[!%asi.input_ph_find_featured_doc? &topic=`input` &namespace=`asi`]]" value="[[!getUrlParam? &name=`search`]]">
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-7 col-md-5 col-md-offset-3">
                        <div class="view">
                            <strong>[[!%asi.view_doc_label? &topic=`default` &namespace=`asi`]]: </strong>
                            <ul class="nav-tabs">
                                <li class="active"><a href="#tabDocumentsFull" data-tabID="10" data-toggle="tab"><i class="fas fa-images"></i></a></li>
                                <li><a href="#tabDocumentsList" data-tabID="11" data-toggle="tab"><i class="fas fa-list"></i></a></li>
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


                                    <a href="[[~[[*id]]]]&sortbyD=newest[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]]#tabSection">[[!%asi.order_new_first? &topic=`filters` &namespace=`asi`]]</a>
                                    <a href="[[~[[*id]]]]&sortbyD=oldest[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]]#tabSection">[[!%asi.order_old_first? &topic=`filters` &namespace=`asi`]]</a>
                                    <a href="[[~[[*id]]]]&sortbyD=a-z[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]]#tabSection">[[!%asi.filter_name_a_z? &topic=`filters` &namespace=`asi`]]</a>
                                    <a href="[[~[[*id]]]]&sortbyD=z-a[[!getUrlParam:ne=``:then=`&search=[[!getUrlParam? &name=`search`]]`? &name=`search`]]#tabSection">[[!%asi.filter_name_z_a? &topic=`filters` &namespace=`asi`]]</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div id="tabDocumentsFull" class="tab-pane fade active in">

                        <div class="row moreList">

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


                            [[!getUrlParam:empty=`
                            <div class="col-xs-12">
                                <div class="text-center mt30">
                                    <a class="showMore">[[!%asi.show_more? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-down"></i></a>
                                    <a class="showLess">[[!%asi.show_less? &topic=`actions` &namespace=`asi`]] <i class="far fa-angle-up"></i></a>
                                </div>
                            </div>`]]
                        </div>
                    </div>
                    <div id="tabDocumentsList" class="tab-pane fade">
                        <div class="row">
                            [[!pdoResources?
                            &parents=`[[+context.highlight_parent_id]]`
                            &tpl=`exploreListTpl`
                            &limit=`0`
                            &includeTVs=`heroTitle,refText,showInList`
                            &tvFilters=`showInList==yes`
                            [[!getUrlParam:is=``:or:is=`newest`:then=`&sortby=`{"publishedon":"DESC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`oldest`:then=`&sortby=`{"publishedon":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"heroTitle":"ASC", "pagetitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"heroTitle":"DESC", "pagetitle":"DESC"}``? &name=`sortbyD`]]
                            &where=`[[!getUrlParam:notempty=`[{"parent:=":[[!++highlight_parent_id]]}, {"pagetitle:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" },{ "OR:refText:LIKE": "%[[!getUrlParam? &name=`search`]]%", "AND:context_key:LIKE":"[[+contextKey]]" }]`? &name=`search`]] `
                            ]]
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabTopics" class="tab-pane fade">
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
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-7 col-md-5 col-md-offset-3">
                        <div class="view">
                            <strong>[[!%asi.view_doc_label? &topic=`default` &namespace=`asi`]]: </strong>
                            <ul class="nav-tabs">
                                <li class="active"><a href="#tabTopicsFull" data-tabID="20" data-toggle="tab"><i class="fas fa-images"></i></a></li>
                                <li><a href="#tabTopicsList" data-tabID="21" data-toggle="tab"><i class="fas fa-list"></i></a></li>
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
                                    <a href="[[~[[*id]]]]&sortbyT=a-z&search=[[!getUrlParam? &name=`search`]]#tabSection">[[!%asi.filter_name_a_z? &topic=`filters` &namespace=`asi`]]</a>
                                    <a href="[[~[[*id]]]]&sortbyT=z-a&search=[[!getUrlParam? &name=`search`]]#tabSection">[[!%asi.filter_name_z_a? &topic=`filters` &namespace=`asi`]]</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tabTopicsFull" class="tab-pane fade active in">
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
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"heroTitle":"ASC", "pagetitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"heroTitle":"DESC", "pagetitle":"DESC"}``? &name=`sortbyD`]]

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
                            [[!getUrlParam:is=``:or:is=`a-z`:then=`&sortby=`{"heroTitle":"ASC", "pagetitle":"ASC"}``? &name=`sortbyT`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"heroTitle":"DESC", "pagetitle":"DESC"}``? &name=`sortbyT`]]
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
                    <div id="tabTopicsList" class="tab-pane fade">
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
                            [[!getUrlParam:is=`a-z`:then=`&sortby=`{"heroTitle":"ASC", "pagetitle":"ASC"}``? &name=`sortbyD`]]
                            [[!getUrlParam:is=`z-a`:then=`&sortby=`{"heroTitle":"DESC", "pagetitle":"DESC"}``? &name=`sortbyD`]]

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
        if(url.includes('?searchTopic')){
            $('a[href="#tabTopics"]').tab('show');
            $('html, body').animate({scrollTop: $('#exploreTabs').offset().top -160 }, 'fast');

        } else if(url.includes('?tab=documents')){
            $('a[href="#tabDocuments"]').tab('show');
            $('html, body').animate({scrollTop: $('#exploreTabs').offset().top -160 }, 'fast');
        }
        else if(url.includes('?search')){
            $('html, body').animate({scrollTop: $('#exploreTabs').offset().top -160 }, 'fast');
        }

        if ($('.clear_search.topic a').length > 0) {
            var searchUrlRemove = window.location.href;
            var mainUrl = url.split('?')[0];
            var params = getQueryParams(window.location.search);
            if("searchTopic" in params) {
                if(params.searchTopic != null) {

                    var targetBlocks = document.getElementById("exploreTabs").getElementsByClassName("searchMore")[0];
                    for(let tbI = 0; i < targetBlocks.length; tbI++){
                        
                        targetBlocks[tbI].className = "searchMoreDisabled";
                    }
                    
                }
            } else if("search" in params) {
                if(params.search != null) {
                    var targetBlocks = document.getElementById("exploreTabs").getElementsByClassName("searchMore")[0];
                    for(let tbI = 0; i < targetBlocks.length; tbI++){
                        
                        targetBlocks[tbI].className = "searchMoreDisabled";
                    }
                    
                }
            }
            
            
            
            $('.clear_search.topic a').attr('href', mainUrl+'?searchTopic=');
        }

    });

</script>

</body>
</html>