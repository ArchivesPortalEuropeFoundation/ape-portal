<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

[[$innerHero]]

[[+alternatingContent1:notempty=`
<section class="noTopMargin alternatingContent">
    <div class="container">
	    [[getImageList?
	      &tvname=`hAlternatingContent`
	      &tpl=`alternatingContentATpl`
	      &tpl_n2=`alternatingContentBTpl`
	      &toPlaceholder=`alternatingContent1`
	    ]]
	    [[+alternatingContent1]]
	</div>
</section>
`]]
	
[[+columnBanner:notempty=`	
<section class="columnBanner [[*columnBannerColour]]">
    <div class="container">
        <div class="row">
            [[getImageList?
              &tvname=`columnBanner`
              &tpl=`columnBannerTpl`
              &toPlaceholder=`columnBanner`
            ]]
            [[+columnBanner]]
        </div>
    </div>
</section>
`]]

[[+alternatingContent2:notempty=`
<section class="standard alternatingContent">
    <div class="container">
	    [[getImageList?
	      &tvname=`hAlternatingContent2`
	      &tpl=`alternatingContentBTpl`
	      &tpl_n2=`alternatingContentATpl`
	      &toPlaceholder=`alternatingContent2`
	    ]]
	    [[+alternatingContent2]]
	</div>
</section>
`]]

[[+infoDropdowns:notempty=`
<section class="noBottomMargin">
    <div class="container">
        <div class="content text-center">
            [[*dropdownsTitle:notempty=`<h2>[[*dropdownsTitle]]</h2>`]]
            [[*dropdownsTopContent:notempty=`[[*dropdownsTopContent]]`]]
        </div>
        <div class="row">
            [[getImageList?
              &tvname=`infoDropdowns`
              &tpl=`infoDropdownTpl`
              &toPlaceholder=`infoDropdowns`
            ]]
            [[+infoDropdowns]]
        </div>
        [[*dropdownsBottomContent:notempty=`<div class="content text-center mt60">[[*dropdownsBottomContent]]</div>`]]
    </div>
</section>
`]]

[[*latestNewsShow:is=`yes`:then=`[[$blogSlider]]`]]

[[$siblingButtons]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

[[$blogSliderScript]]

	</body>
</html>