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
        [[*whoWeAreTitle:notempty=`<h2 class="text-center mb20">[[*whoWeAreTitle]]</h2>`]]
        [[*whoWeAreText:notempty=`
        <div class="content text-center mb30">
            [[*whoWeAreText]]
        </div>
        `]]
        <ul class="nav-tabs buttons mb0" id="navTabsSlider">
            [[TaggerGetTags? &parents=`[[*id]]` &groups=`1` &rowTpl=`taggerTabNavTpl` &sort=`{"rank": "ASC"}`]]
        </ul>
    </div>
</section>

<div class="tab-content">
    [[TaggerGetTags? &parents=`[[*id]]` &groups=`1` &rowTpl=`taggerMembersTabTpl` &sort=`{"rank": "ASC"}`]]
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

[[TaggerGetTags? &parents=`[[*id]]` &groups=`1` &rowTpl=`taggerMembersPopupTpl` &sort=`{"rank": "ASC"}`]]

[[$scripts]]

[[$blogSliderScript]]

<script>
    $(document).ready(function(){
        $('.membersTab').each(function() {
            var popupID = $(this).attr('data-popup');
            $(this).find('a.bioLink').attr('href', '#membersPopup' + popupID);
        });

        var memberID;
        $('.member a.bioLink').on('click', function() {
            memberID = $(this).attr('data-member');
        });

        [[TaggerGetTags? &parents=`[[*id]]` &groups=`1` &rowTpl=`taggerMembersScriptsTpl` &sort=`{"rank": "ASC"}`]]

        // Add correct numbering
        $('.membersMobileSlider').each(function(){
            var counter = 1;
            $(this).children('div').each(function(){
                $(this).find('a.bioLink').attr( 'data-member', counter);
                counter++;
            });
        });

    });
    var url = window.location.href;
    if(url.includes('?tab=ambassador')){
        $('a[href="#tab1"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    } else if(url.includes('?tab=content-provider')){
        $('a[href="#tab2"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    } else if(url.includes('?tab=country-manager')){
        $('a[href="#tab3"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    } else  if(url.includes('?tab=associate')){
        $('a[href="#tab4"]').tab('show');
        $('html, body').animate({scrollTop: $('#navTabsSlider').offset().top -220 }, 'slow');
    }
</script>
</body>
</html>