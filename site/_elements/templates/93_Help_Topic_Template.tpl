[[TaggerGetTags? &resources=`[[*id]]` &rowTpl=`taggerAliasTpl` &toPlaceholder=`category`]]            
[[pdoResources?
  &parents=`82`
  &tpl=`helpTopicBreadcrumbTpl`
  &limit=`1`
  &includeTVs=`helpTopicIsIntro`
  &where=`[[!TaggerGetResourcesWhere? &tags=`[[!+category]]` &where=`{"helpTopicIsIntro": "yes"}`]]`
  &toPlaceholder=`catLink`
]]            
            
            <div id="helpContent">
                <div class="inner">
                    <h2>[[*helpTopicTitle:notempty=`[[*helpTopicTitle]]`:default=`[[*pagetitle]]`]]</h2>
            		[[pdoCrumbs?
            		  &from=`82`
            		  &exclude=`82`
                      &outputSeparator=`<i class="far fa-angle-right"></i>`
                      &tplWrapper=`@INLINE
                          <div class="crumbBar">
                              <a class="helpLink return" href="[[~82]]">Help</a>
                              <i class="far fa-angle-right"></i>
                              [[*helpTopicIsIntro:isnot=`yes`:then=`[[!+catLink]] <i class="far fa-angle-right"></i>`]]
                              [[+output]]
                          </div>
                      `
                      &tplCurrent=`@INLINE <span>[[+menutitle]]</span>`
                    ]]
            		<div class="content">
            		    [[*helpTopicContent]]
            		</div>
        		</div>
            </div>