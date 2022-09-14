<div id="helpSlidein">
    <div class="inner">
        <a class="toggleHelp"><i class="far fa-times"></i></a>
        <span class="loader">[[$loadingSVG]]</span>
        <div class="header">
            <div class="selectDropdown closes">
    		    <div class="title">[[!%asi.title_choose_help_topic? &topic=`default` &namespace=`asi`]]</div>
    			<div class="inner">
    				[[TaggerGetTags? &groups=`2` &rowTpl=`taggerHelpDropdownTpl` &sort=`{"rank": "ASC"}`]]
    			</div>
    		</div>
            <div id="helpContent">
                <div class="inner">
                    <h2>[[!#82.tv.helpTopicTitle:default=`[[%asi.title_ape_help_guide? &topic=`default` &namespace=`asi`]]`]]</h2>
            		<div class="content">
            		    [[#82.tv.helpTopicContent]]
            		</div>    
        		</div>
            </div>
        </div>
        <div class="helpNav">
            <div class="searchTopics">
                <h3>[[!%asi.title_choose_help_topic? &topic=`default` &namespace=`asi`]]</h3>
                <form class="searchLight">
                    <div class="inputWrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="[[!%asi.input_ph_find_help_on? &topic=`input` &namespace=`asi`]]">
                    </div>
                </form>
            </div>
            [[TaggerGetTags? &groups=`2` &rowTpl=`taggerHelpCategoryTpl` &sort=`{"rank": "ASC"}`]]
            <a class="returnLink helpLink return" href="[[~82]]"><i class="far fa-angle-left"></i> [[!%asi.action_return_to_help_topics? &topic=`actions` &namespace=`asi`]]</a>
        </div>
    </div>
</div>