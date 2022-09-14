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

[[!getImageList?
    &tvname=`projectsBlocks`
    &tpl=`projectsBlocksTpl`
    &toPlaceholder=`projectsBlocks`
]]

[[!+projectsBlocks:isnotempty=`
<section class="noBottomMargin">
    <div class="container">
        <div class="content text-center">
            [[*projectsTitle:notempty=`<h2>[[*projectsTitle]]</h2>`]]
            [[*projectsTopContent:notempty=`<div class="mb40">[[*projectsTopContent]]</div>`]]
        </div>
        <div class="row centred">
            [[+projectsBlocks]]
        </div>
        [[*projectsBottomContent:notempty=`<div class="content text-center">[[*projectsBottomContent]]</div>`]]
    </div>
</section>`]]

[[*latestNewsShow:is=`yes`:then=`[[$blogSlider]]`]]

[[$siblingButtons]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

[[$blogSliderScript]]

	</body>
</html>