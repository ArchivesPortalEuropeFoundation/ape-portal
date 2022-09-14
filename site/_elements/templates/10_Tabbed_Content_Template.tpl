<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
	<head>
[[$head]]
	</head>
	<body>
[[$header]]

[[$innerHero]]

[[getImageList?
  &tvname=`hAlternatingContent`
  &tpl=`alternatingContentATpl`
  &tpl_n2=`alternatingContentBTpl`
  &toPlaceholder=`alternatingContent1`
]]

[[+alternatingContent1:notempty=`
<section class="noTopMargin alternatingContent">
    <div class="container">
	    [[+alternatingContent1]]
	</div>
</section>
`]]

<section class="noBottomMargin">
    <div class="container">
        [[*joinUsTabsTitle:notempty=`
        <div class="content text-center mb30">
            <h3>[[*joinUsTabsTitle]]</h3>
        </div>
        `]]
        <ul class="nav-tabs buttons mb0" id="navTabsSlider">
    		[[getImageList?
    		  &tvname=`joinUsTabs`
    		  &tpl=`joinUsTabNavTpl`
    		]]
    	</ul>
    </div>
</section>

<div class="tab-content">
    [[getImageList?
      &tvname=`joinUsTabs`
      &tpl=`joinUsTabsTpl`
    ]]
    </div>
</div>

[[getImageList?
  &tvname=`hAlternatingContent2`
  &tpl=`alternatingContentATpl`
  &tpl_n2=`alternatingContentBTpl`
  &toPlaceholder=`alternatingContent2`
]]

[[+alternatingContent2:notempty=`
<section class="standard alternatingContent">
    <div class="container">
	    [[+alternatingContent2]]
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
<script>
    var url = window.location.href;
    if(url.includes('?tab=registered-user')){
        $('a[href="#tab1"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    } else if(url.includes('?tab=ambassador')){
        $('a[href="#tab2"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    } else if(url.includes('?tab=content-provider')){
        $('a[href="#tab3"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    } else if(url.includes('?tab=country-manager')){
        $('a[href="#tab4"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    } else  if(url.includes('?tab=associate')){
        $('a[href="#tab5"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    }
</script>
	</body>
</html>
