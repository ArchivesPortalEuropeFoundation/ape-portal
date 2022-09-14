<section class="halfBottomMargin">
    <div class="container">
        <div class="content siblingButtons">
            [[#[[*parent]].tv.siblingButtonsTitle:notempty=`<h2 class="mb40">[[#[[*parent]].tv.siblingButtonsTitle]]</h2>`]]
            [[pdoResources?
              &parents=`[[*parent]]`
              &resources=`-[[*id]],-76`
              &depth=`0`
              &tpl=`siblingButtonTpl`
              &sortby=`{"menuindex":"ASC"}`
              &includeTVs=`refHide`
              &where=`{"refHide:IS": null}`
            ]]
            [[!+user.is_admin:eq=`1`:then=`
            <a class="button blue" href="/manager">Visit MODX manager</a>
            `]]
        </div>
        [[getImageList?
          &docid=`[[*parent]]`
          &tvname=`secondLevelList`
          &tpl=`secondLevelSiblingsTpl`
        ]]
    </div>
</section>