<section class="[[*template:is=`26`:then=`noTopHalfBottomMargin`:else=`halfBottomMargin`]]">
    <div class="container">
        <div class="content siblingButtons">
            [[#[[UltimateParent? &topLevel=`3`]].tv.siblingButtonsTitle:notempty=`<h2 class="mb40">[[#[[UltimateParent? &topLevel=`3`]].tv.siblingButtonsTitle]]</h2>`]]
            [[pdoResources?
              &parents=`[[UltimateParent? &topLevel=`2`]]`
              &resources=`-[[UltimateParent? &topLevel=`4`]]`
              &depth=`0`
              &tpl=`siblingButtonTpl`
              &sortby=`{"menuindex":"ASC"}`
              &includeTVs=`refHide`
              &where=`{"refHide:IS": null}`
            ]]
        </div>
        [[getImageList?
          &docid=`[[UltimateParent? &topLevel=`2`]]`
          &tvname=`secondLevelList`
          &tpl=`secondLevelSiblingsUltimateTpl`
        ]]
    </div>
</section>