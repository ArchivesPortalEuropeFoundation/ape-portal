$(window).scroll(function () {

    var scroll = $(window).scrollTop();

    if ($(window).width() > 991) {
        if (scroll > 90) {
            $('body').addClass('sticky');
            setTimeout(function () {
                $('header').not('.noSearch').addClass('slideOut')
            }, 500);
        } else {
            $('body').removeClass('sticky');
            $('header').removeClass('slideOut');
            $('header .search .checkboxes').removeClass('appear');
            $('header .search').addClass('noTransition');
            setTimeout(function () {
                $('header .search').removeClass('noTransition')
            }, 500);
        }
    }

    if ($(window).width() < 992 && $('.altSlideOut').length > 0) {
        if (scroll > 90) {
            $('body').addClass('stickyM');
            if ($('.altSlideOut').hasClass('replace')) {
                $('header').addClass('retract');
            }
        } else {
            $('body').removeClass('stickyM');
            if ($('.altSlideOut').hasClass('replace')) {
                $('header').removeClass('retract');
            }
        }
    }
});


$(document).ready(function () {

    // language
    $('[data-change-language]').on('click', function (event) {
        event.preventDefault();
        var new_lan = $(this).data('change-language'),
            loc = window.location.href,
            arr = loc.split('?'),
            sep = '?';

        // check for paramaters
        if (arr.length > 1 && arr[1] !== '') {
            sep = '&'
        }

        location.replace(loc+sep+'lang='+new_lan);
    });


// SLIDERS
    $("#homeDocumentsSlider").slick({
        autoplay: false,
        arrows: true,
        speed: 400,
        draggable: false,
        dots: true,
        fade: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: false,
        variableWidth: false,
        prevArrow: '<span class="prev"><i class="fas fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fas fa-angle-right"></i></span>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
    });

    $("#homeTopicsSlider").slick({
        autoplay: false,
        arrows: true,
        speed: 400,
        draggable: false,
        dots: true,
        fade: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: false,
        variableWidth: false,
        prevArrow: '<span class="prev"><i class="fas fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fas fa-angle-right"></i></span>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
    });

    $('a[href="#tabTopics"]').on('shown.bs.tab', function () {
        $('#homeTopicsSlider').slick('refresh');
        $('#homeTopicsSlider .linkBlock .details').matchHeight();
    });

    $('a[href="#tabDocuments"]').on('shown.bs.tab', function () {
        $('#homeDocumentsSlider').slick('refresh');
        $('#homeDocumentsSlider .linkBlock .details').matchHeight();
    });

    $("#homeCountrySlider").slick({
        autoplay: false,
        arrows: true,
        speed: 400,
        draggable: false,
        dots: true,
        fade: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: false,
        variableWidth: false,
        prevArrow: '<span class="prev"><i class="fas fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fas fa-angle-right"></i></span>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
    });

    $("#otherDocsSlider").slick({
        autoplay: false,
        arrows: true,
        speed: 400,
        draggable: false,
        dots: true,
        fade: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
        variableWidth: false,
        prevArrow: '<span class="prev"><i class="fas fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fas fa-angle-right"></i></span>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
    });

    $('.contentDropdown .title.galleryDropdown').click(function () {
        setTimeout(function () {
            $('#documentGallerySlider').slick('refresh');
            $('#documentCaptionSlider').slick('refresh');
        }, 100);
    });


   

    if ($(window).width() < 992) {
        $("#navTabsSlider").slick({
            autoplay: false,
            arrows: true,
            speed: 400,
            draggable: false,
            dots: false,
            fade: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false,
            variableWidth: false,
            prevArrow: '<span class="prev"><i class="far fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="far fa-angle-right"></i></span>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }]
        });
    }

    $('#navTabsSlider a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
        var parent = $(this).parent();
        $('#navTabsSlider li').removeClass('active');
        parent.addClass('active');
    });

    if ($(window).width() < 768) {
        $('#navTabsSlider:not(.difM) a').each(function () {
            var text = $(this).text();
            var shortText = jQuery.trim(text).substring(0, 10).trim(this) + "...";
            $(this).text(shortText);
        });
    }

    $("#blogFeaturedSlider").slick({
        autoplay: true,
        autoplaySpeed: 8000,
        arrows: false,
        speed: 1200,
        draggable: false,
        dots: true,
        fade: true,
        infinite: false,
        variableWidth: false
    });

// NAVIGATION

    $("a.aLink").click(function (e) {
        $("html, body").animate({
            scrollTop: $($.attr(this, "href")).offset().top
        }, 500);
        e.preventDefault();
    });

    $('#navPrimary > ul > li.parent').hover(function () {
        $(this).children('ul').stop().slideToggle(300, 'swing');
    });


    var navLevel = 1;

    $('.mobileButton').click(function () {
        if ($('#navMobile').is('.open')) {
            $('body').removeClass('preventScroll');
            $('.navContainer').addClass('level1');
            $('.navContainer').removeClass('level2');
            $('.navContainer').removeClass('level3');
            $('#navMobile ul').removeClass('open');
            $('#navMobile').removeClass('open');
            navLevel = 1;
        } else {
            $('#navMobile').addClass('open');
            $('body').addClass('preventScroll');
        }
    });

    $("#navMobile li.parent > a").click(function () {
        $(this).siblings('ul').addClass('open');
        navLevel++;
        if (navLevel == 2) {
            $('.navContainer').removeClass('level3');
            $('.navContainer').addClass('level2');
        }
        if (navLevel == 3) {
            $('.navContainer').removeClass('level2');
            $('.navContainer').addClass('level3');
        }
    });

    $("#navMobile li.back > a").click(function () {
        navLevel--;
        if (navLevel == 2) {
            $('.navContainer').removeClass('level3');
            $('.navContainer').addClass('level2');
        }
        if (navLevel == 1) {
            $('.navContainer').removeClass('level2');
        }
        var closing = this;
        setTimeout(function () {
            $(closing).parent('li').parent('ul').removeClass('open');
        }, 500);
    });

    $("#navMobile span.back").click(function () {
        $(this).parent("ul").removeClass("open");
    });

    $('.accountButton').click(function () {
        $('#navAccountMobile').toggleClass('open');
    });


// SEARCH FORMS


    $('header .search input[type="text"]').click(function () {
        if ($('header').not('.expandSearch') && !$('body').is('.sticky')) {
            $('header').addClass('expandSearch');
        } else if ($('header .search .checkboxes').not('.appear') && $('body').is('.sticky')) {
            $('header .search .checkboxes').addClass('appear');
        }
    });

    $('header .search .hideSearch').click(function () {
        $('header').removeClass('expandSearch');
        $('header .search .suggestions').removeClass('open');
    });

    $('form.search input[type="text"]').on('input', function () {
        var form = $(this).parent('form');
        var value = $(this).val();
        if (value.length > 3) {
            $(form).children('.suggestions').addClass('open');
            $(form).children('.clearSearch').addClass('shown');
        } else {
            $(form).children('.suggestions').removeClass('open');
            $(form).children('.clearSearch').removeClass('shown');
        }
    });

    $('form.search .clearSearch').click(function () {
        var form = $(this).parent('form');
        $(form).children('.searchField').val('');
        $(form).children('.suggestions').removeClass('open');
        $(form).children('.clearSearch').removeClass('shown');
    });

    $('form.search input[type="submit"]').hover(function () {
        $(this).parent('form').toggleClass('submitHover');
    });

    $('.createCollection h5').click(function () {
        $(this).children('i').toggleClass('fa-plus fa-minus');
        $(this).siblings('.inner').slideToggle(300, 'swing');
    });

    $('.expandAdv').click(function () {
        $('#advSearchControls').slideToggle(500, 'swing');
        if ($(this).is('.active')) {
            $(this).removeClass('active');
            $(this).children('span').text('Show');
            if ($(window).width() > 767) {
                $('#searchContainer .search').removeClass('expanded');
            }
        } else {
            $(this).addClass('active');
            $(this).children('span').text('Hide');
            if ($(window).width() > 767) {
                $('#searchContainer .search').addClass('expanded');
            }
        }
    });

    $('.expandAdvP').click(function () {
        $('#advSearchControlsP').slideToggle(500, 'swing');
        if ($(this).is('.active')) {
            $(this).removeClass('active');
            $(this).children('span').text('Show');
        } else {
            $(this).addClass('active');
            $(this).children('span').text('Hide');
        }
    });

    $('.hideAdv').click(function () {
        $('#advSearchControls').slideToggle(500, 'swing');
        if ($('.expandAdv').is('.active')) {
            $('.expandAdv').removeClass('active');
            $('.expandAdv').children('span').text('Show');
        } else {
            $('.expandAdv').addClass('active');
            $('.expandAdv').children('span').text('Hide');
        }
    });

    if ($(window).width() < 768) {
        $('#searchContainer input.searchField').click(function () {
            $('#searchContainer .search').addClass('mobileExpand');
            $('#searchContainer .search').addClass('expanded')
        });
        $('#searchContainer .reduceSearch').click(function () {
            $('#searchContainer .search').removeClass('mobileExpand');
            $('#searchContainer .search').removeClass('expanded')
            if ($('.expandAdv').is('.active')) {
                $('.expandAdv').removeClass('active');
                $('.expandAdv').children('span').text('Show');
                $('#advSearchControls').slideToggle(500, 'swing');
            }
        });
    }

    $('.dateSearch input[name="exactDate"]').on('change', function () {
        if ($(this).is(':checked')) {
            $('.dateSearch').addClass('exact');
        } else {
            $('.dateSearch').removeClass('exact');
        }
    });

    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            url = urlparts[0] + '?' + pars.join('&');
            return url;
        } else {
            return url;
        }
    }


    if ($('.clear_search a').length > 0) {
        var searchUrlRemove = window.location.href;
        $('.clear_search a').attr('href', removeURLParameter(searchUrlRemove, 'search'));
    }


    $('#dateFrom').datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
            date: 'far fa-calendar-alt',
            up: 'far fa-angle-up',
            down: 'far fa-angle-down',
            previous: 'far fa-angle-left',
            next: 'fa far-angle-right'
        }
    });

    $('#dateTo').datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
            date: 'far fa-calendar-alt',
            up: 'far fa-angle-up',
            down: 'far fa-angle-down',
            previous: 'far fa-angle-left',
            next: 'fa far-angle-right'
        }
    });

    $('#exactStart').datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
            date: 'far fa-calendar-alt',
            up: 'far fa-angle-up',
            down: 'far fa-angle-down',
            previous: 'far fa-angle-left',
            next: 'fa far-angle-right'
        }
    });

    $('#exactEnd').datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
            date: 'far fa-calendar-alt',
            up: 'far fa-angle-up',
            down: 'far fa-angle-down',
            previous: 'far fa-angle-left',
            next: 'fa far-angle-right'
        }
    });

    $('.toggleFilters').click(function () {
        $('body').toggleClass('preventScroll');
        $('#filterSidebar').toggleClass('open');
    });

// VARIOUS DROPDOWNS


    $('.selectDropdown > .title').click(function () {
        var parent = $(this).parent();
        $(parent).toggleClass('open');
        $(parent).children('.inner').slideToggle(300, 'swing');
    });

    $('.selectDropdown.closes > .inner a').click(function () {
        var parent = $(this).parents('.selectDropdown');
        $(parent).toggleClass('open');
        $(parent).children('.inner').slideToggle(300, 'swing');
    });

    $("body").on("click", '.contentDropdown > .title', function (event) {
        var parent = $(this).parent();
        $(parent).toggleClass('open');
        $(parent).children('.inner').slideToggle(300, 'swing');
    });

    $('.infoDropdown').click(function () {
        var parent = $(this);
        $(parent).toggleClass('open');
        $(parent).children('.inner').slideToggle(300, 'swing');
    });

    $('.shareDropdown .title').click(function () {
        $(this).parent().toggleClass('open');
    });

    $('.projectsBlock .show').click(function () {
        var parent = $(this).parents('.projectsBlock');
        $(parent).toggleClass('open');
        $(parent).find('.inner').slideToggle(300, 'swing');
    });

    $('.accountNav .title').click(function () {
        $(this).parent().toggleClass('open');
        $('header .fadesF').toggleClass('faded');
    });

    $('.moreDropdown > .title').click(function () {
        var parent = $(this).parent();
        if ($(parent).is('.open')) {
            $(parent).removeClass('open');
            $(this).text('More')
        } else {
            $(parent).addClass('open');
            $(this).text('Less')
        }
    });

    $('.moreDropdownS > .title').click(function () {
        var parent = $(this).parent();
        if ($(parent).is('.open')) {
            $(parent).removeClass('open');
            $(this).text('Show more')
        } else {
            $(parent).addClass('open');
            $(this).text('Show less')
        }
    });

    $('.hiddenContent > .title').click(function () {
        var parent = $(this).parent();
        $(parent).toggleClass('open');
        $(parent).children('.inner').slideToggle(300, 'swing');
    });

    $('.moreBefore').click(function () {
        var content = $(this).siblings('.moreBeforeContent');
        if ($(content).is('.open')) {
            $(content).removeClass('open');
            $(this).html('More before <i class="far fa-angle-down"></i>')
        } else {
            $(content).addClass('open');
            $(this).html('Less before  <i class="far fa-angle-up"></i>')
        }
    });

    $('.moreAfter').click(function () {
        var content = $(this).siblings('.moreAfterContent');
        if ($(content).is('.open')) {
            $(content).removeClass('open');
            $(this).html('More after <i class="far fa-angle-down"></i>')
        } else {
            $(content).addClass('open');
            $(this).html('Less after  <i class="far fa-angle-up"></i>')
        }
    });

    $('.contextDropdown .toggleShow').click(function () {

        // data-override="dont_toggle_show"
        if ($(this).attr("data-override") == "dont_toggle_show") {
            console.log("preventing show...");
            return false;
        }

        var parent = $(this).parents('.title');
        var toggleText = $(this).children('span');
        $(parent).toggleClass('closed');
        $(parent).siblings('.inner').slideToggle(300, 'swing');
        if ($(parent).is('.closed')) {
            $(toggleText).text('Show');
        } else {
            $(toggleText).text('Hide');
        }
    });


    $('.searchExtra .toggleShow').click(function () {
        $(this).parent().toggleClass('open');
    });

    $('#innerHero .buttons .buttonDropdown a.button').click(function () {
        var buttons = $('#innerHero .buttons');
        var inner = $(this).siblings('.inner');
        if ($(this).is('.active')) {
            $(buttons).removeClass('faded');
            $(this).removeClass('active');
        } else {
            $(buttons).addClass('faded');
            $(this).addClass('active');
        }
        $(inner).slideToggle(300, 'swing');
    });

    $('.altSlideOut .buttons .buttonDropdown a.button').click(function () {
        var buttons = $('.altSlideOut .buttons');
        var inner = $(this).siblings('.inner');
        if ($(this).is('.active')) {
            $(buttons).removeClass('faded');
            $(this).removeClass('active');
        } else {
            $(buttons).addClass('faded');
            $(this).addClass('active');
        }
        $(inner).slideToggle(300, 'swing');
    });


    // $('ul.subGroups .openGroup').click(function () {
    //     $(this).parent().toggleClass('open');
    // });

    $('.showHiddenOptions').click(function () {
        $(this).siblings('.hiddenOptions').toggleClass('open');
    });

    $('.editCollection').click(function () {
        var parent = $(this).parents('.contentDropdown');
        if (!$(parent).hasClass('open')) {
            $(parent).addClass('open');
            $(parent).children('.inner').slideDown(300, 'swing');
        }
        $(parent).addClass('edit');
    });

    $('.finishEdit').click(function () {
        var parent = $(this).parents('.contentDropdown');
        if ($(parent).hasClass('open')) {
            $(parent).removeClass('open');
            $(parent).children('.inner').slideUp(300, 'swing');
        }
        $(parent).removeClass('edit');
    });

// TOOLTIPS

    $('.tipIcon').click(function (e) {
        if ($(this).is('.active')) {
            $(this).tooltipster('close');
            $(this).removeClass('active');
        } else {
            $(this).tooltipster('open');
            $(this).addClass('active');
        }
        e.stopPropagation();
    });


    $('.tipIcon').tooltipster({
        plugins: ['sideTip'],
        contentCloning: 'true',
        trigger: 'click',
        interactive: 'true',
        maxWidth: 320,
        minWidth: 200,
        side: ['right', 'left', 'bottom', 'top'],
        repositionOnScroll: 'true',
        trigger: 'custom',
        triggerOpen: {},
        triggerClose: {},
        functionBefore: function (instance, helper) {
            $.each($.tooltipster.instances(), function (i, instance) {
                instance.close();
            });
            $('.tipIcon').removeClass('active');
        },
        functionReady: function () {
            $('.closeIcon').click(function () {
                $('.tipIcon').tooltipster('close');
                $('.tipIcon').removeClass('active');
            });
        }
    });

// HELP SLIDEIN
    $('#helpSlidein').on('click', 'a.helpLink', function (e) {
        e.preventDefault();
        var link = $(this);
        var source = link.attr('href');
        var category = link.attr('data-category');

        $('#helpSlidein').addClass('loading');
        $('#helpSlidein').animate({scrollTop: 0}, 500);
        setTimeout(function () {
            $('.category').removeClass('current');
            $('.category .disabled').removeClass('disabled');
            if (link.is('.return')) {
                $('.helpNav').removeClass('reduced');
            } else {
                $('.' + category).addClass('current');
                $('.helpNav').addClass('reduced');
            }
            ;
            if (link.is('.button')) {
                link.addClass('disabled');
            }
            ;
            $('#helpContent').load(source + ' #helpContent .inner', function () {
                $('#helpSlidein').removeClass('loading');
            });
        }, 500);
    });


// VARIOUS

    $('.content iframe').wrap('<div class="videoContainer" />');

    $('.toggleSlideUp').click(function (e) {
        var whichSlide = $(this).attr('href');
        if ($('#pageOverlay').length == 0) {
            $('body').addClass('preventScroll');
            $('body').append('<div id="pageOverlay"></div>');
            setTimeout(function () {
                $('#pageOverlay').addClass('in')
            }, 10);
            $(whichSlide).addClass('open')
        } else {
            $('body').removeClass('preventScroll');
            $('#pageOverlay').removeClass('in');
            $('.slideUp, .slideIn').removeClass('open')
            setTimeout(function () {
                $('#pageOverlay').remove()
            }, 300);
        }
        e.preventDefault();
    });

    $('.toggleHelp').click(function (e) {
        if ($('#pageOverlay').length == 0) {
            $('body').addClass('preventScroll');
            $('body').append('<div id="pageOverlay"></div>');
            setTimeout(function () {
                $('#pageOverlay').addClass('in')
            }, 10);
            $('#helpSlidein').addClass('open')
        } else {
            $('body').removeClass('preventScroll');
            $('#pageOverlay').removeClass('in');
            $('#helpSlidein').removeClass('open')
            setTimeout(function () {
                $('#pageOverlay').remove()
            }, 300);
        }
        e.preventDefault();
    });

    $('.enableSubmit').change(function () {
        var form = $(this).parents('form');
        var subButton = $(form).find('input[type="submit"]');
        if ($(this).is(':checked')) {
            $(subButton).removeClass('disabled');
        } else {
            $(subButton).addClass('disabled');
        }
    });

    $('a.button.toggle').click(function () {
        $(this).siblings('.active').removeClass('active');
        $(this).toggleClass('active');
    });


    function copyData(id) {
        /* Get the text field */
        var copyText = document.getElementById(id);

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
    }


    $('.copyUrl').click(function (e) {
         e.preventDefault();

        var copIn = document.createElement("input");
        copIn.setAttribute("id", "linkCopy");
        copIn.setAttribute("type", "text");
        copIn.setAttribute("style", "display:none");
        copIn.setAttribute("value", $(this).attr('href'));
        document.body.appendChild(copIn);
        copyData("linkCopy");
        copIn.remove();

        $(this).children('span').append('<i class="fas fa-check" style="margin-left:8px" id="copyCheck"></i>');
        setTimeout(() => {
            document.getElementById('copyCheck').remove();
        }, 3000);
       
    });

    $('.copyAPI').click(function () {
        var key = $('.apiKey').text();
        var $temp = $('<input>');
        $('body').append($temp);
        $temp.val(key).select();
        document.execCommand('copy');
        $temp.remove();
        $('.copied').show();
    });

    $('.promoBanner .closeIcon').click(function () {
        $('.promoBanner').hide();
        // Set the cookie 
        setCookie("promoBanner", $('.promoBanner').attr('id'), 360);
    });

    // Check for promo banner 
    let proBann = getCookie("promoBanner");
    if (proBann != $('.promoBanner').attr('id')) {
        $(".promoBanner").show();
    } 


    $('#welcomePopup a.nextTab').click(function () {
        $('#welcomePopup ul.nav-tabs li:first-child').removeClass('active');
        $('#welcomePopup ul.nav-tabs li:last-child').addClass('active');
    });

    $('.matchHeight').matchHeight();
    $('.linkBlock .details').matchHeight();
    $('.childLinkBlock .text').matchHeight();
    $('.countryItem span.name').matchHeight();
    $('.institutionItem span.name').matchHeight();
    $('.bannerColumn').matchHeight();
    $('.projectsBlock').matchHeight();
    $('.infoDropdownWrapper').matchHeight();

    if ($(window).width() > 991) {
        $('.alternatingContent .vCentre').matchHeight();
        $('.author .vCentre').matchHeight();
    }

    if ($(window).width() > 767) {
        $('.member.normal').matchHeight();
    }

    $('.moreList').each(function () {
        var list = $(this);
        var items = list.find('.item').size();
        var more = list.find('.showMore');
        var less = list.find('.showLess');

        if ($(window).width() < 768) {
            var x = 6;
            var y = 6;
        } else if ($(window).width() > 767 && $(window).width() < 992) {
            var x = 8;
            var y = 8;
        } else {
            var x = 9;
            var y = 9;
        }
        var z = x;

        if (x > items) {
            more.hide();
        }

        $(this).find('.item:lt(' + x + ')').css('display', 'block');

        more.click(function () {
            x = (x + y <= items) ? x + y : items;
            list.find('.item:lt(' + x + ')').css('display', 'block');
            less.show();
            if (x == items) {
                more.hide();
            }
        });

        less.click(function () {
            x = (x - y < z) ? z : x - y;
            list.find('.item').not(':lt(' + x + ')').hide();
            more.show();
            less.show();
            if (x == z) {
                less.hide();
            }
        });
    });

// TAB & SLIDEIN URLS

    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);
        return (results !== null) ? results[1] || 0 : false;
    }

    if ($.urlParam('tab')) {
        $('a[href="#' + $.urlParam('tab') + '"]').tab('show');
    }

    var url = window.location.href;

    if (url.includes('?show=help')) {
        $('#navBar .toggleHelp').click();
    }

// VARIOUS FORM SCRIPTS

    $('#rateForm .rating input').click(function () {
        if ($(this).is('.checked')) {
            $(this).removeAttr('checked');
            $(this).removeClass('checked');
            $('#rateForm input[type="submit"]').addClass('disabled');
        } else {
            $('#rateForm .rating input').removeClass('checked');
            $(this).addClass('checked');
        }
    });

    if ($('#suggestionMessage').length > 0) {
        var quillSuggest = new Quill('#suggestionMessage', {
            theme: 'snow',
            placeholder: 'Provide details'
        });

        quillSuggest.on('text-change', function () {
            var wrapper = $('#suggestionMessage').parent('.inputWrapper');
            var textarea = $('#suggestionMessage').siblings('textarea');
            $(textarea).val(quillSuggest.root.innerHTML);
            if ($(textarea).val() && $(textarea).val() != '<p><br></p>') {
                $(wrapper).addClass('correct');
                $(wrapper).removeClass('error');
                $(wrapper).children('span').remove('.error');
            } else {
                $(wrapper).removeClass('correct');
            }
        });
    }

    $('#suggestionFile').on('change', function () {

        if (this.files) {
            var file = this.files[0];
            var fileName = file.name;
            var valid = ['jpg', 'doc', 'docx', 'pdf'];
            var extension = fileName.substr(fileName.lastIndexOf('.') + 1);
            var errors = 0;

            if (file.size > 2097152) {
                errors++;
            }
            if ($.inArray(extension, valid) == -1) {
                errors++
            }
            if (errors > 0) {
                $(this).wrap('<form>');
                $(this).parent('form').trigger('reset');
                $(this).unwrap();
                $(this).parent().addClass('error');
                $(this).parent().removeClass('hasFile');
                $(this).siblings('label').html('<i class="fas fa-upload"></i> Upload file <span class="valid">(PDF, DOC or JPG - max 2MB)</span>');
            } else {
                $('.uploadWrapper label').html('<span class="uploaded">Uploaded:</span>' + fileName + '<i class="fas fa-sync"></i>');
                $(this).parent().addClass('hasFile');
                $(this).parent().removeClass('error');
            }
        }
    });

    $('.uploadWrapper .remove').click(function () {
        var wrapper = $(this).parent();
        var fileInput = $(wrapper).children('input');
        $(wrapper).removeClass('hasFile');
        $(wrapper).children('label').html('<i class="fas fa-upload"></i> Upload file <span class="valid">(PDF, DOC or JPG - max 2MB)</span>');
        $(fileInput).wrap('<form>');
        $(wrapper).children('form').trigger('reset');
        $(fileInput).unwrap();
    });

    $('#setRecipient a.button').click(function () {
        var recipient = $(this).attr('id');
        var input = $('form').find('input[name="recipient"]');
        $(input).val(recipient);
    });

    $('#rateForm input[name="rating"]').on('change', function (e) {
        if ($('#rateForm input[name="rating"]:checked').val()) {
            $('#rateForm input[type="submit"]').removeClass('disabled');
        }
    });

    $('form input[name="agreeTerms"]').on('change', function (e) {
        var parent = $(this).parents('form');
        var button = $(parent).find('input[type="submit"]');
        if ($(this).is(':checked')) {
            $(button).removeClass('disabled');
        } else {
            $(button).addClass('disabled');
        }
    });

    $('form input[name="confirmDelete"]').on('change', function (e) {
        var parent = $(this).parents('form');
        var button = $(parent).find('input[type="submit"]');
        if ($(this).is(':checked')) {
            $(button).removeClass('disabled');
        } else {
            $(button).addClass('disabled');
        }
    });

    $('form input[name="welcomeTerms"]').on('change', function (e) {
        if ($(this).is(':checked')) {
            $('#welcomePopup a.nextTab, #welcomePopup .nav-tabs li.next').removeClass('disabled');
        } else {
            $('#welcomePopup a.nextTab, #welcomePopup .nav-tabs li.next').addClass('disabled');
        }
    });

    $('a.submit').click(function () {
        $(this).closest('form').submit();
        ;
    });

    $('form select').change(function () {
        $(this).css('color', '#000');
    });

    $('form input[type="text"], form textarea').change(function () {
        var wrapper = $(this).parent('.inputWrapper');
        if ($(this).val()) {
            $(wrapper).addClass('correct');
            $(wrapper).removeClass('error');
            $(wrapper).children('span').remove('.error');
        } else {
            $(wrapper).removeClass('correct');
        }
    });

    $('form').submit(function (e) {

        var errors = 0;
        var error = '<i class="fas fa-exclamation-triangle"></i>';

        $(this).find('.requiredQuill').each(function () {
            var thisField = $(this);
            var input = thisField.find('textarea');

            if (input.val().length == 0) {
                errors++;

                if (thisField.find('span.error').length == 0) {
                    thisField.addClass('error');
                    thisField.append('<span class="error">' + error + '</span>');
                }
            }
        });

        if ($(this).find('#newPassword').length > 0) {
            var newPass = $('#newPassword');
            var confirmPass = $('#confirmPassword');
            var newParent = newPass.parent();
            var confirmParent = confirmPass.parent();
            newParent.removeClass('error errorMatch errorInvalid');
            newPass.siblings('.error').remove();
            confirmParent.removeClass('error errorMatch errorInvalid');
            confirmPass.siblings('.error').remove();

            if (newPass.val().length == 0) {
                newParent.addClass('error');
                newParent.append('<span class="error">' + error + '</span>');
                errors++;
            } else if (newPass.val() !== confirmPass.val()) {
                newParent.addClass('errorMatch');
                newParent.append('<span class="error">' + error + '</span>');
                confirmParent.addClass('errorMatch');
                confirmParent.append('<span class="error">' + error + '</span>');
                errors++;
            } else {
                if (!newPass.val().match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/)) {
                    newParent.addClass('errorInvalid');
                    newParent.append('<span class="error">' + error + '</span>');
                    errors++;
                }
            }
        }

        $(this).find('.required').each(function () {
            var thisField = $(this);
            var input = thisField.find('input');

            if (input.length == 0) {
                input = thisField.find('textarea');

                if (input.length == 0) {
                    input = thisField.find('select');
                }
            }

            if (input.val().length == 0) {
                errors++;

                if (thisField.find('span.error').length == 0) {
                    thisField.addClass('error');
                    thisField.append('<span class="error">' + error + '</span>');
                }
            }
        });

        if (errors > 0) {
            e.preventDefault();
            $(this).find('.formError').show();
            $("html, body").animate({scrollTop: $(this).offset().top - 200}, 300);
        }
    });

    // blog subscribe
    $('[data-action="blog_subscribe"]').click(function (event) {
        event.preventDefault();
        var email_data = $('[data-input="blog_subscribe_email"]').val();
        if (email_data == "") {
            $('[data-error="blog_subscribe_email"]').show();
            return false;
        } else {
            $.ajax({
                method: "POST",
                url: "/mailchimp-ajax/",
                data: {
                    action: "blog_subscribe",
                    email: email_data
                }
            })
                .done(function (data) {
                    console.log('Subscribed to blog newsletter');
                    var response = JSON.parse(data);
                    $('[data-populate="blog_subscribe_email"]').html(email_data);
                    $('[data-trigger="blog_subscribe_success"]').trigger('click');
                    return true;
                })
                .fail(function () {
                    alert("Sorry, there was an error, please check your email and try again.");
                })

        }
    });
});


function contactInstitutionClick() {
    $('html, body').animate({
        scrollTop: $('#contactInstitutionForm').offset().top-50
    }, 1000);
}


// $(window).load(function () {

//     $('.vCentre').addClass('ffFix');

//     if ($(window).width() > 991 && $('#affix').length > 0) {

//         var headerAdjustment = -60;
//         var footerAdjustment = 100;

//         var heroHeight = parseInt($('#innerHero').outerHeight(true), 10);
//         var headerHeight = headerAdjustment + heroHeight + parseInt($('header').outerHeight(true), 10);
//         var footerHeight = footerAdjustment + parseInt($('footer').outerHeight(true), 10);
//         var sideBarHeight = parseInt($('#affix').outerHeight(true), 10);

//         //if ($('#mainContent').length > 0) {
//         //      var mainContent = parseInt($('#mainContent').outerHeight(true), 10);
//         //		} else {
//         //		  var mainContent = 10000;
//         //		}

//         //if (mainContent > sideBarHeight) {
//         $('#affix').affix({
//             offset: {
//                 top: headerHeight,
//                 bottom: footerHeight
//             }
//         });
//         //    }
//     }

// });



 $(document).on('init reInit afterChange', "#documentGallerySlider", function (event, slick, currentSlide, nextSlide) {
        var i = (currentSlide ? currentSlide : 0) + 1;
        $(document).find('.galleryCounter').text(i + '/' + slick.slideCount);
    });

    function initGallerySlider() {
        $(document).find("#documentGallerySlider").slick({
            autoplay: false,
            arrows: true,
            speed: 400,
            draggable: false,
            dots: false,
            fade: false,
            infinite: false,
            variableWidth: false,
            adaptiveHeight: false,
            asNavFor: '#documentCaptionSlider',
            prevArrow: '<span class="prev"><i class="fas fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fas fa-angle-right"></i></span>'
        });
    
    
        $(document).find("#documentCaptionSlider").slick({
            autoplay: false,
            arrows: false,
            speed: 400,
            draggable: false,
            dots: false,
            fade: true,
            infinite: false,
            variableWidth: false
        });
    }
    initGallerySlider();
