                        <div class="slide">
                            <div class="caption">
                                <p>[[+caption]]</p>
                            </div>
                            <div class="icons">
                                [[+copyOverride:is=`Yes`:then=`
                                    [[+copyLogos:is=`none`:then=`
                                        [[+copyIcons:contains=`cc-pd.`:then=`
                                        <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconPDTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-pd"></i>
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-zero.`:then=`
                                        <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconZeroTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-zero"></i>
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-by.`:then=`
                                        <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconByTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-bysa.`:then=`
                                        <span class="[[++copy_icon_bysa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYSATooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-sa"></i>
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-bynd.`:then=`
                                        <span class="[[++copy_icon_bynd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNDTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-bync.`:then=`
                                        <span class="[[++copy_icon_bync_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-byncsa.`:then=`
                                        <span class="[[++copy_icon_byncsa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCSATooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-sa"></i>
                                        </span>
                                        `]]
                                        [[+copyIcons:contains=`cc-byncnd.`:then=`
                                        <span class="[[++copy_icon_byncnd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCNDTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </span>
                                        `]]
                                    `]]
                                    [[+copyLogos:is=`non-com`:then=`<img class="[[++copy_logo_noncom_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNonComTooltip" src="assets/images/RS-NoC-NC.png">`]]
                                    [[+copyLogos:is=`eu-orphan`:then=`<img class="[[++copy_logo_euorphan_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEuOrphanTooltip" src="assets/images/RS-InC-OW-EU.png">`]]
                                    [[+copyLogos:is=`other`:then=`<img class="[[++copy_logo_other_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoOtherTooltip" src="assets/images/RS-NoC-OKLR.png">`]]
                                    [[+copyLogos:is=`in-copy`:then=`<img class="[[++copy_logo_incopy_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoInCopyTooltip" src="assets/images/RS-InC.png">`]]
                                    [[+copyLogos:is=`not-eval`:then=`<img class="[[++copy_logo_noteval_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNotEvalTooltip" src="assets/images/RS-CNE.png">`]]
                                    [[+copyLogos:is=`edu-use`:then=`<img class="[[++copy_logo_eduuse_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEduUseTooltip" src="assets/images/RS-InC-EDU.png">`]]
                                `:else=`
                                    [[*docCopyLogos:is=`none`:then=`
                                [[*docCopyIcons:contains=`cc-pd.`:then=`
                                <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconPDTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-pd"></i>
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-zero.`:then=`
                                <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconZeroTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-zero"></i>
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-by.`:then=`
                                <span class="[[++copy_icon_by_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconByTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-bysa.`:then=`
                                <span class="[[++copy_icon_bysa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYSATooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-sa"></i>
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-bynd.`:then=`
                                <span class="[[++copy_icon_bynd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNDTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-bync.`:then=`
                                <span class="[[++copy_icon_bync_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-byncsa.`:then=`
                                <span class="[[++copy_icon_byncsa_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCSATooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-sa"></i>
                                        </span>
                                `]]
                                [[*docCopyIcons:contains=`cc-byncnd.`:then=`
                                <span class="[[++copy_icon_byncnd_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyIconBYNCNDTooltip">
                                            <i class="fab fa-creative-commons"></i>
                                            <i class="fab fa-creative-commons-by"></i>
                                            <i class="fab fa-creative-commons-nc"></i>
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </span>
                                `]]
                                    `]]
                                    [[*docCopyLogos:is=`non-com`:then=`<img class="[[++copy_logo_noncom_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNonComTooltip" src="assets/images/RS-NoC-NC.png">`]]
                                    [[*docCopyLogos:is=`eu-orphan`:then=`<img class="[[++copy_logo_euorphan_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEuOrphanTooltip" src="assets/images/RS-InC-OW-EU.png">`]]
                                    [[*docCopyLogos:is=`other`:then=`<img class="[[++copy_logo_other_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoOtherTooltip" src="assets/images/RS-NoC-OKLR.png">`]]
                                    [[*docCopyLogos:is=`in-copy`:then=`<img class="[[++copy_logo_incopy_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoInCopyTooltip" src="assets/images/RS-InC.png">`]]
                                    [[*docCopyLogos:is=`not-eval`:then=`<img class="[[++copy_logo_noteval_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoNotEvalTooltip" src="assets/images/RS-CNE.png">`]]
                                    [[*docCopyLogos:is=`edu-use`:then=`<img  class="[[++copy_logo_eduuse_tooltip:notempty=`tipIcon`]]" data-tooltip-content="#copyLogoEduUseTooltip"src="assets/images/RS-InC-EDU.png">`]]
                                `]]
                            </div>
                        </div>