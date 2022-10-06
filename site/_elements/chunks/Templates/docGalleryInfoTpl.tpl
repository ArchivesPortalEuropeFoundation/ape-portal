                        <div class="slide">
                            <div class="caption">
                                <p>[[+caption]]</p>
                            </div>
                            <div class="icons">
                                [[+copyOverride:is=`Yes`:then=`
                                    [[+copyLogos:is=`none`:then=`
                                        [[+copyIcons:contains=`cc-pd.`:then=`
                                        <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconPDTooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-publicdomain.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-pd"></i>]]
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-zero.`:then=`
                                        <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconZeroTooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-cc-zero.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-zero"></i>]]
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-by.`:then=`
                                        <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconByTooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-by.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>]]
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-bysa.`:then=`
                                        <span class="[[++copy_icon_bysa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYSATooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-by-sa.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-sa"></i>]]
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-bynd.`:then=`
                                        <span class="[[++copy_icon_bynd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNDTooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-by-nd.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nd"></i>]]
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-bync.`:then=`
                                        <span class="[[++copy_icon_bync_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCTooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-by-nc.eu.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>]]
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-byncsa.`:then=`
                                        <span class="[[++copy_icon_byncsa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCSATooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-by-nc-sa.eu.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-sa"></i>]]
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-byncnd.`:then=`
                                        <span class="[[++copy_icon_byncnd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCNDTooltip">
                                            <img style="width: 100px" src="assets/images/licences/CC-by-nc-nd.eu.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-nd"></i>]]
                                        </span>
                                        `]]
                                    `]]
                                    [[+copyLogos:is=`non-com`:then=`<img style="width: 100px"  class="[[++copy_logo_noncom_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNonComTooltip" src="assets/images/licences/RS-NoC-NC.png">`]]
                                    [[+copyLogos:is=`eu-orphan`:then=`<img style="width: 100px"  class="[[++copy_logo_euorphan_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEuOrphanTooltip" src="assets/images/licences/RS-InC-OW-EU.png">`]]
                                    [[+copyLogos:is=`other`:then=`<img style="width: 100px"  class="[[++copy_logo_other_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoOtherTooltip" src="assets/images/licences/RS-NoC-OKLR.png">`]]
                                    [[+copyLogos:is=`in-copy`:then=`<img style="width: 100px"  class="[[++copy_logo_incopy_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoInCopyTooltip" src="assets/images/licences/RS-InC.png">`]]
                                    [[+copyLogos:is=`not-eval`:then=`<img style="width: 100px"  class="[[++copy_logo_noteval_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNotEvalTooltip" src="assets/images/licences/RS-CNE.png">`]]
                                    [[+copyLogos:is=`edu-use`:then=`<img style="width: 100px"  class="[[++copy_logo_eduuse_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEduUseTooltip" src="assets/images/licences/RS-InC-EDU.png">`]]
                                `:else=`
                                    [[*docCopyLogos:is=`none`:then=`
                                [[*docCopyIcons:contains=`cc-pd.`:then=`
                                <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconPDTooltip">
                                    <img style="width: 100px" src="assets/images/licences/CC-publicdomain.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-pd"></i>]]
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-zero.`:then=`
                                <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconZeroTooltip">
                                    <img style="width: 100px" src="assets/images/licences/CC-cc-zero.png"/>
                                           [[- <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-zero"></i>]]
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-by.`:then=`
                                <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconByTooltip">
                                    <img style="width: 100px" src="assets/images/licences/CC-by.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>]]
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-bysa.`:then=`
                                <span class="[[++copy_icon_bysa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYSATooltip">
                                     <img style="width: 100px" src="assets/images/licences/CC-by-sa.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-sa"></i>]]
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-bynd.`:then=`
                                <span class="[[++copy_icon_bynd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNDTooltip">
                                    <img style="width: 100px" src="assets/images/licences/CC-by-nd.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nd"></i>]]
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-bync.`:then=`
                                <span class="[[++copy_icon_bync_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCTooltip">
                                    <img style="width: 100px" src="assets/images/licences/CC-by-nc.eu.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>]]
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-byncsa.`:then=`
                                <span class="[[++copy_icon_byncsa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCSATooltip">
                                    <img style="width: 100px" src="assets/images/licences/CC-by-nc-sa.eu.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-sa"></i>]]
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-byncnd.`:then=`
                                <span class="[[++copy_icon_byncnd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCNDTooltip">
                                    <img style="width: 100px" src="assets/images/licences/CC-by-nc-nd.eu.png"/>
                                            [[-<i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-nd"></i>]]
                                        </span>
                                `]]
                                    `]]
                                    [[*docCopyLogos:is=`non-com`:then=`<img style="width: 100px"  class="[[++copy_logo_noncom_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNonComTooltip" src="assets/images/licences/RS-NoC-NC.png">`]]
                                    [[*docCopyLogos:is=`eu-orphan`:then=`<img style="width: 100px"  class="[[++copy_logo_euorphan_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEuOrphanTooltip" src="assets/images/licences/RS-InC-OW-EU.png">`]]
                                    [[*docCopyLogos:is=`other`:then=`<img style="width: 100px"  class="[[++copy_logo_other_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoOtherTooltip" src="assets/images/licences/RS-NoC-OKLR.png">`]]
                                    [[*docCopyLogos:is=`in-copy`:then=`<img style="width: 100px"  class="[[++copy_logo_incopy_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoInCopyTooltip" src="assets/images/licences/RS-InC.png">`]]
                                    [[*docCopyLogos:is=`not-eval`:then=`<img style="width: 100px"  class="[[++copy_logo_noteval_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNotEvalTooltip" src="assets/images/licences/RS-CNE.png">`]]
                                    [[*docCopyLogos:is=`edu-use`:then=`<img style="width: 100px"   class="[[++copy_logo_eduuse_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEduUseTooltip"src="assets/images/licences/RS-InC-EDU.png">`]]
                                `]]
                            </div>
                        </div>
