	<div id="tab[[+idx]]" class="tab-pane fade[[+idx:is=`1`:then=` active in`]]">
	    [[+text1:notempty=`
	    <section class="standard">
    	    <div class="container">
    	        <div class="content text-center">
    	            [[+text1]]
    	        </div>
    	    </div>
	    </section>
	    `]]
	    
[[getImageList?
  &value=`[[+banner]]`
  &bannerCount=`[[+bannerCount]]`
  &tpl=`columnBannerMigxTpl`
  &toPlaceholder=`columnBanner[[+idx]]`
]]	    
	    [[+columnBanner[[+idx]]:notempty=`
	    <section class="columnBanner [[+bannerColour]]">
            <div class="container">
                <div class="row">
                    [[+columnBanner[[+idx]]]]
                </div>
            </div>
        </section>
        `]]
        
[[!getImageList?
  &value=`[[+blocks]]`
  &tpl=`projectsBlocksMigxTpl`
  &toPlaceholder=`textBlocks[[+idx]]`
]]        
        [[!+textBlocks[[+idx]]:notempty=`
        <section class="standard">
            <div class="container">
                [[+text2:notempty=`
                <div class="content text-center mb40">
                    [[+text2]]
                </div>
                `]]
                <div class="row">
                    [[+textBlocks[[+idx]]]]  
                </div>
                [[+text3:notempty=`
                <div class="content text-center">
                    [[+text3]]
                </div>
                `]]
            </div>
        </section>
        `]]
        
    </div>