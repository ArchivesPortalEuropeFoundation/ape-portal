<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

<section id="innerHero">
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[*articleTitle:notempty=`[[*articleTitle]]`:default=`[[*pagetitle]]`]]</h1>
        </div>
        <span class="blogDate"><i class="far fa-calendar-alt"></i> [[*publishedon:strtotime:date=`%d-%m-%Y`]]</span>
    </div>
</section>

<section class="noTopMargin">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div id="article">
                    [[*articleIntro:notempty=`
                    <div class="content mb20">
                        [[*articleIntro]]
                    </div>
                    `]]
                    [[*authorShow:is=`yes`:then=`
                    <div class="author">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="vCentre">
                                    <div class="inner">
                                        <img src="[[*authorImage:notemmpty=`[[*authorImage]]`:default=`assets/images/default_portrait.png`]]">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="vCentre">
                                    <div class="inner content">
                                        <h5>[[!%asi.title_by_author? &topic=`default` &namespace=`asi`]]</h5>
                                        [[*authorBio]]
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `]]
                    <div class="content">
                        [[*articleContent]]
                    </div>
                    <hr>
                    <div class="siblings">
                        [[pdoNeighbors?
                          &tplWrapper=`@INLINE [[+prev]][[+next]]`
                          &tplPrev=`@INLINE <span class="prev"><a href="/[[+uri]]"><i class="far fa-angle-left mr"></i> [[!%asi.pg_previous? &topic=`default` &namespace=`asi`]]</a></span>`
                          &tplNext=`@INLINE <span class="next"><a href="/[[+uri]]">[[!%asi.pg_next? &topic=`default` &namespace=`asi`]] <i class="far fa-angle-right ml"></i></a></span>`
                        ]]
                    </div>
                    <div class="shareDropdown">
                        <span class="title"><i class="fas fa-share-alt"></i>[[!%asi.tools_share? &topic=`default` &namespace=`asi`]]</a></span>
                        <div class="inner">
                            <a href="[[++sharing_facebook]]" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="[[++sharing_twitter]]" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="[[++sharing_linkedin]]" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
                            <a href="[[++site_url]][[~[[*id]]]]" class="copyUrl"><i class="fas fa-link"></i> <span>[[!%asi.tools_copy_link? &topic=`default` &namespace=`asi`]]</span></a>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-md-3 mmt70">
                <div class="row">
                    <div class="col-sm-6 col-md-12">
                        <div class="blogSearch">
                            <h4>[[!%asi.title_search_the_blog? &topic=`default` &namespace=`asi`]]</h4>
                            [[!SimpleSearchForm?
                              &landing=`13`
                              &tpl=`blogSearchFormTpl`
                              &searchIndex=`blogSearch`
                            ]]
                        </div>                        
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <div class="blogTags">
                            <h3>[[!%asi.title_categories? &topic=`default` &namespace=`asi`]]</h3>
                            [[!TaggerGetTags? &groups=`3` &rowTpl=`taggerBlogCatsTpl` &sort=`{"rank": "ASC"}` &limit=`5`]]
                            [[!TaggerGetTags? &groups=`3` &rowTpl=`taggerBlogCatsTpl` &sort=`{"rank": "ASC"}` &offset=`5` &limit=`100` &toPlaceholder=`moreTags`]]
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
                    [[#13.tv.blogSubscribe]]
                    <form class="standard">
                        <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]:</p>
                        <div class="inputWrapper required">
                            <input type="text" name="email" placeholder="[[!%asi.input_ph_email_address? &topic=`input` &namespace=`asi`]]">
                        </div>
                        <a class="button blue border full" href="#blogSubscribePopup" data-toggle="modal">[[!%asi.action_subscribe? &topic=`actions` &namespace=`asi`]]</a>
                    </form>
                </div>
                <div class="blogEvents">
                    <h3>[[!%asi.title_events? &topic=`default` &namespace=`asi`]]</h3>
                    [[pdoResources?
                      &parents=`116`
                      &tpl=`sidebarEventTpl`
                      &limit=`2`
                      &sortby=`{"eventStart":"DESC", "eventCountry":"[[+usrCountry]]"}`
                      &includeTVs=`eventTitle,eventStart,eventEnd,eventCountry`
                    ]]
                    [[- <a class="button blue full" href="[[~116]]">[[!%asi.action_view_calendar? &topic=`actions` &namespace=`asi`]]</a> ]]
                </div>
            </div>            
        </div>
    </div>
</section>
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$blogSubscribePopup]]

[[$scripts]]

	</body>
</html>