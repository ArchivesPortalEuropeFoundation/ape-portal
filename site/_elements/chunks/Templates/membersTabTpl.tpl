    <div id="tab[[+idx]]" class="membersTab tab-pane fade[[+idx:is=`1`:then=`  active in`]]" data-popup="[[+idx]]">
        <section class="noTopMargin">
            <div class="container">
                <div class="row membersMobileSlider" id="membersMobileSlider[[+idx]]">
                    
                    [[pdoResources?
                      &parents=`[[*id]]`
                      &tpl=`memberBlockTpl`
                      &limit=`0`
                      &sortby=`{"menuindex":"ASC"}`
                      &includeTVs=`memberName,memberImage,memberPosition,memberArchival,memberCountry,memberIntro,memberWebsite,memberFeatured`
                      &processTVs=`memberImage`
                      &where=`[[!TaggerGetResourcesWhere? &tags=`[[+alias]]` &where=`{"memberFeatured": "yes"}`]]`
                    ]]
                    
                    [[pdoResources?
                      &parents=`[[*id]]`
                      &tpl=`memberBlockTpl`
                      &limit=`0`
                      &sortby=`{"menuindex":"ASC"}`
                      &includeTVs=`memberName,memberImage,memberPosition,memberArchival,memberCountry,memberIntro,memberWebsite,memberFeatured`
                      &processTVs=`memberImage`
                      &where=`[[!TaggerGetResourcesWhere? &tags=`[[+alias]]` &where=`{"memberFeatured:IS": null}`]]`
                    ]]
                    
                </div>
                <div class="counter">0/0</div>
            </div>
        </section>
    </div>