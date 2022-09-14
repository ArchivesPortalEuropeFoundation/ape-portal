<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

<section id="innerHero" class="mb0">
    <div class="container">
        [[$breadcrumbs]]
        <div class="content">
            <h1>[[*heroTitle:notempty=`[[*heroTitle]]`:default=`[[*pagetitle]]`]]</h1>
            [[*heroText]]
        </div>
    </div>
</section>

[[*latestNewsShow:is=`yes`:then=`[[$blogSlider]]`]]
		
[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

[[$blogSliderScript]]

	</body>
</html>