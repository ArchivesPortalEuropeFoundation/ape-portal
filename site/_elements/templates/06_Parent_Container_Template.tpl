<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

[[$innerHero]]

[[+alternatingContent:notempty=`
<section class="noTopMargin alternatingContent">
    <div class="container">
	    [[getImageList?
	      &tvname=`alternatingContent`
	      &tpl=`alternatingContentATpl`
	      &tpl_n2=`alternatingContentBTpl`
	      &toPlaceholder=`alternatingContent`
	    ]]
	    [[+alternatingContent]]
	</div>
</section>
`]]
	
<section class="halfBottomMargin">
    <div class="container">
        <div class="row">
            [[pdoResources?
              &parents=`[[*id]]`
              &tpl=`childLinkBlockTpl`
              &depth=`0`
              &sortby=`{"menuindex":"ASC"}`
              &includeTVs=`heroTitle,refText,refHide`
              &where=`{"refHide:IS": null}`
            ]]
        </div>
    </div>
</section>

[[getImageList?
  &tvname=`secondLevelList`
  &tpl=`secondLevelListTpl`
]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

	</body>
</html>