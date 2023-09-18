<header[[*headerSearchShow:isnot=`Yes`:then=` class="noSearch"`]][[*template:in=`10,11,12,15,16,17`:then=` class="noSearch"`]]>
<div class="container" data-name="header_all">
    <div class="row">
        <div class="col-md-3">
            <a class="logo" href="[[~[[++site_start]]]]"><img src="assets/images/logo.jpg"></a>
            [[!+user.logged_in:eq=`1`:then=`<span class="accountButton"><i class="fas fa-user"></i></span>`]]
            <span class="mobileButton"><i class="fas fa-bars"></i></span>
        </div>
        <div class="col-md-9">
            <div class="tools">
               [[- <div class="item">
                    <form class="search" action="/advanced-search/search-in-archives/" method="get">
                        [[++tt_search_main:notempty=`
                        <div class="tipIcon" data-tooltip-content="#searchMainTooltip">
                            <i class="far fa-question-circle"></i>
                        </div>
                        `]]
                        <input type="text" class="searchField" name="term" data-input="search_term_top" placeholder="[[!%asi.input_ph_search_all_content? &topic=`input` &namespace=`asi`]]" autocomplete="off">
                        <div class="checkboxes">
								<span class="checkbox">
									<input type="checkbox" name="containsdigital[]" value="true">
									[[!%asi.show_digital_objs? &topic=`search` &namespace=`asi`]]
								</span>
                            <span class="checkbox">
									<input type="checkbox" name="separate[]" value="true">
									[[!%asi.label_search_each_term_sep? &topic=`label` &namespace=`asi`]]
								</span>
                        </div>
                        <input type="submit">
                        <span class="hideSearch"><a><i class="fas fa-eye-slash"></i> [[!%asi.action_hide_search? &topic=`actions` &namespace=`asi`]]</a></span>
                        <div class="suggestions" data-interface="suggestions_top">

                            <h5>[[!%asi.search_sections? &topic=`search` &namespace=`asi`]]:</h5>
                            <div data-populate="section_suggest"></div>
                            <hr>

                            <h5>[[!%asi.search_spelling? &topic=`search` &namespace=`asi`]]:</h5>
                            <div data-populate="spelling_suggest"></div>
                            <hr>

                            <h5>[[!%asi.search_topics? &topic=`search` &namespace=`asi`]]:</h5>
                            <div data-populate="topic_suggest"></div>
                            <hr>

                        </div>
                        <span class="clearSearch"><i class="fas fa-times"></i></span>
                    </form>
                </div>
                <div class="item fades fadesF">
                    <div class="selectDropdown">
                        <div class="title">[[!%asi.[[+language]]? &topic=`language` &namespace=`asi`]]</div>
                        <div class="inner">
                            
                            <a data-change-language="EN" href="#">[[!%asi.eng? &topic=`language` &namespace=`asi`]]</a>
                            <a data-change-language="FR" href="#">[[!%asi.fra? &topic=`language` &namespace=`asi`]]</a>
                            <a data-change-language="DE" href="#">[[!%asi.ger? &topic=`language` &namespace=`asi`]]</a>
                            <a data-change-language="ES" href="#">[[!%asi.spa? &topic=`language` &namespace=`asi`]]</a>
                        </div>
                    </div>
                </div>]]

                [[!+user.logged_in:eq=`1`:then=`
                <!-- account menu -->
                <div class="item fades">
                    <div class="accountNav">
                        <div class="title">
                            <i class="fas fa-user"></i> [[!%asi.my_account? &topic=`account` &namespace=`asi`]] <i
                                class="far fa-angle-down"></i>
                        </div>
                        <div class="inner">
                            [[-[[!getUserFirstName]]]]
                            <ul>
                                <li><a href="[[~[[BabelTranslation:default=`72`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`72`]]]]">[[!%asi.dashboard? &topic=`account` &namespace=`asi`]]</a></li>
                                <li><a href="[[~[[BabelTranslation:default=`73`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`73`]]]]">[[!%asi.saved_searches? &topic=`account` &namespace=`asi`]]</a></li>
                                <li><a href="[[~[[BabelTranslation:default=`74`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`74`]]]]">[[!%asi.action_get_api_key? &topic=`actions` &namespace=`asi`]]</a></li>
                                <li><a href="[[~[[BabelTranslation:default=`75`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`75`]]]]">[[!%asi.settings_and_preferences? &topic=`default` &namespace=`asi`]]</a></li>
                                <li><a href="[[~[[BabelTranslation:default=`79`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`79`]]? &service=logout]]">[[!%asi.logout? &topic=`account` &namespace=`asi`]]</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                `:else=`
                <div class="item fades">
                </div>
                <div class="item fades[[*id:is=`78`:then=` active`]]">
                    <a href="[[~78]]"><i class="mr fas fa-sign-in"></i> [[!%asi.action_create_account? &topic=`actions` &namespace=`asi`]]</a>
                </div>
                <div class="item fades[[*id:is=`79`:then=` active`]]">
                    <a href="[[~79]]"><i class="mr fas fa-user"></i> [[!%asi.label_login? &topic=`label` &namespace=`asi`]]</a>
                </div>

                `]]
                

            </div>
        </div>
    </div>
</div>
</header>

<div id="navBar">
    <div class="container">
        <nav id="navPrimary">
            <ul>
                <li><a href="[[~[[++site_start]]]]"><i class="fas fa-home"></i></a></li>
                [[pdoMenu?
                &parents=`0`
                &context=`web`
                &level=`3`
                &resources=`-1`
                &tplOuter=`@INLINE [[+wrapper]]`
                &tplInner=`@INLINE <ul[[+classes]]>[[+wrapper]]</ul>`
                &parentClass=`parent`
                &useWeblinkUrl=`0`
                ]]
                <li><a class="toggleHelp">[[!%asi.help? &topic=`default` &namespace=`asi`]]</a></li>
            </ul>
        </nav>
    </div>
</div>

<nav id="navMobile">
    <div class="navContainer">
        <span class="mobileButton"><i class="far fa-times"></i></span>
       [[- <div class="selectDropdown">
            <div class="title">[[!%asi.eng? &topic=`language` &namespace=`asi`]]</div>
            <div class="inner">
                <a href="#">[[!%asi.fra? &topic=`language` &namespace=`asi`]]</a>
                <a href="#">[[!%asi.ger? &topic=`language` &namespace=`asi`]]</a>
                <a href="#">[[!%asi.spa? &topic=`language` &namespace=`asi`]]</a>
            </div>
        </div>]]
        <ul class="pinkBG">
            [[pdoMenu?
            &parents=`0`
            &level=`2`
            &resources=`8,9,10`
            &limit=`0`
            &tplOuter=`@INLINE [[+wrapper]]`
            &tplInner=`@INLINE <ul[[+classes]]><span class="mobileButton"><i class="far fa-times"></i></span><li class="back"><a><i class="far fa-angle-left"></i> [[!%asi.back? &topic=`actions` &namespace=`asi`]]</a></li><li class="title"><a href="#">[[+menutitle]]</a></li>[[+wrapper]]</ul>`
        &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]]>[[+refMobileIcon]] [[+menutitle]]</a>[[+wrapper]]</li>`
        &tplInnerRow=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>`
        &tplParentRow=`@INLINE <li[[+classes]]><a>[[+refMobileIcon]] [[+menutitle]]</a>[[+wrapper]]</li>`
        &parentClass=`parent`
        &useWeblinkUrl=`0`
        &includeTVs=`refMobileIcon`
        ]]
        </ul>
        <ul class="blueBG">
            [[pdoMenu?
            &parents=`0`
            &level=`2`
            &resources=`-1,-8,-9,-10`
            &limit=`0`
            &tplOuter=`@INLINE [[+wrapper]]`
            &tplInner=`@INLINE <ul[[+classes]]><span class="mobileButton"><i class="far fa-times"></i></span><li class="back"><a><i class="far fa-angle-left"></i> [[!%asi.back? &topic=`actions` &namespace=`asi`]]</a></li><li class="title"><a href="#">[[+menutitle]]</a></li>[[+wrapper]]</ul>`
        &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]]>[[+refMobileIcon]] [[+menutitle]]</a>[[+wrapper]]</li>`
        &tplInnerRow=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>`
        &tplParentRow=`@INLINE <li[[+classes]]><a>[[+refMobileIcon]] [[+menutitle]]</a>[[+wrapper]]</li>`
        &parentClass=`parent`
        &useWeblinkUrl=`0`
        &includeTVs=`refMobileIcon`
        ]]
        </ul>
        <ul>
            <li class="parent">
                <a><i class="fas fa-life-ring"></i> [[!%asi.help? &topic=`default` &namespace=`asi`]]</a>
                <ul>
                    <span class="mobileButton"><i class="far fa-times"></i></span>
                    <li class="back"><a><i class="far fa-angle-left"></i> [[!%asi.back? &topic=`actions` &namespace=`asi`]]</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-comment"></i> [[!%asi.action_nav_contact? &topic=`actions` &namespace=`asi`]]</a></li>
            <li><a href="https://deprecated.archivesportaleurope.net/sign-in"><i class="fas fa-sign-in"></i> [[!%asi.action_create_account? &topic=`actions` &namespace=`asi`]]</a></li>
            <li><a href="https://deprecated.archivesportaleurope.net/sign-in"><i class="fas fa-user"></i> [[!%asi.label_login? &topic=`label` &namespace=`asi`]]</a></li>
        </ul>
    </div>
</nav>

[[!+user.logged_in:eq=`1`:then=`
<!-- account mobile menu -->
<nav id="navAccountMobile">
    <span class="closeIcon accountButton"><i class="far fa-times"></i></span>
    <h3>[[!%asi.my_account? &topic=`account` &namespace=`asi`]]</h3>
    <ul>

        [[pdoMenu?
        &parents=`72`
        &level=`3`
        &resources=`-1,-76`
        &tplOuter=`@INLINE [[+wrapper]]`
        &tplInner=`@INLINE <ul[[+classes]]>[[+wrapper]]</ul>`
    &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]]>[[+refMobileIcon]] [[+menutitle]]</a>[[+wrapper]]</li>`
    &parentClass=`parent`
    &useWeblinkUrl=`0`
    &includeTVs=`refMobileIcon`
    ]]

        [[!+user.is_admin:eq=`1`:then=`
            <li><a href="/manager"><i class="fas fa-edit"></i> Visit MODX manager</a></li>
        `]]
        <li><a href="[[~[[BabelTranslation:default=`79`? &contextKey=`[[+contextKey:default=`web`]]` &resourceId=`79`]]? &service=logout]]"><i class="fas fa-sign-out-alt"></i> [[!%asi.logout? &topic=`account` &namespace=`asi`]]</a></li>
    </ul>
</nav>
`]]
