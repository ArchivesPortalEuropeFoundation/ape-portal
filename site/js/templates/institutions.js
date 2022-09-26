if ($('#instTpl').length !== 0) {
    (function () {

        $('.moreListAM').each(function () {
            var list = $(this);
            var items = list.find('.item').size();
            var more = list.find('.showMore');
            var less = list.find('.showLess');
            var x = 3;
            var y = 3;
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

        $(".switchModals").click(function (e) {
            $("#bookmarkPopup").modal('hide');
            setTimeout(function () {
                $("#bookmarkAddedPopup").modal('show');
            }, 800);
            e.preventDefault();
        });

        
        var id = 1;
        var short_label = $('[data-switch-branch="1"]').attr('data-short-label');
        var long_name = $('[data-switch-branch="1"]').text();

        if ($('.branch').length <= 1) {
            $('.branch_switch').hide();
        }
        if (long_name.length > 0) {
            $('[data-populate="branch_name"]').text(long_name);
            $('[data-switch-branch="1"]').parent().parent().find('.title').text(short_label);
        }
        $('[data-branch]').each(function () {
            $(this).hide();
        });
        $('[data-branch="' + id + '"]').show();
    })();
}

function seeMoreMaterials(classKey) {
    $('.' + classKey + '.displayLinkSeeMore').hide();
    $('.' + classKey + '.displayLinkSeeLess').show();
    $('.' + classKey + '.longDisplay').slideDown({
        start: function () {
            $(this).css({
                display: "block"
            })
        }
    });
}


function seeLessMaterials(classKey) {
    $('.' + classKey + '.displayLinkSeeMore').show();
    $('.' + classKey + '.displayLinkSeeLess').hide();

    $('.' + classKey + '.longDisplay').slideUp();
}

function seeMore(classKey, branch) {
    
    if(branch != null) {
        $('[data-branch="' + branch + '"] .' + classKey + ' .displayLinkSeeMore').hide();
        $('[data-branch="' + branch + '"] .' + classKey + ' .displayLinkSeeLess').show();
        $('[data-branch="' + branch + '"] .' + classKey + ' .longDisplay').slideDown({
            start: function () {
                $(this).css({
                    display: "flex"
                })
            }
        });
    } else {
        $('.' + classKey + ' .displayLinkSeeMore').hide();
        $('.' + classKey + ' .displayLinkSeeLess').show();
        $('.' + classKey + ' .longDisplay').slideDown({
            start: function () {
                $(this).css({
                    display: "flex"
                })
            }
        });
    }
}

function seeLess(classKey, branch) {
    if(branch != null) {
        $('[data-branch="' + branch + '"] .' + classKey + ' .displayLinkSeeMore').show();
        $('[data-branch="' + branch + '"] .' + classKey + ' .displayLinkSeeLess').hide();

        $('[data-branch="' + branch + '"] .' + classKey + ' .longDisplay').slideUp();
    } else {
        $('.' + classKey + ' .displayLinkSeeMore').show();
        $('.' + classKey + ' .displayLinkSeeLess').hide();

        $('.' + classKey + ' .longDisplay').slideUp();
    }

}
