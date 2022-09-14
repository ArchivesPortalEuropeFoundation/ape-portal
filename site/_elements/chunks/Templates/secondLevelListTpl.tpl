<section class="halfTopMargin">
    <div class="container">
        [[+title:notempty=`<div class="content text-center">
            <h2 class="mb30">[[+title]]</h3>
        </div>
        `]]
        <div class="row">
            [[pdoResources?
              &parents=`[[+id]]`
              &tpl=`childLinkBlockTpl`
              &depth=`0`
              &sortby=`{"menuindex":"ASC"}`
              &includeTVs=`heroTitle,refText,refHide`
              &where=`{"refHide:IS": null}`
            ]]
        </div>
    </div>
</section>