(function($, RedactorPlugins) {
    RedactorPlugins.clips = {
        init: function()
        {

            if(this.opts.clipsJson) {
                var _clips = $.parseJSON( this.opts.clipsJson) || null;
                if(_clips && _clips.length) {
                    var _clipsCount = $('.clipsmodal').size();
                    var _modalId = "clipsmodal-" + _clipsCount;
                    var _clipsmodal = $('<div id="' + _modalId + '" class="clipsmodal" style="display:none"><section><ul class="redactor_clips_box"></ul></section></div>');
                    $.each(_clips, function(i, item) {
                        var _li = $('<li><a href="" class="redactor_clip_link"' + ((item.advanced == 1) ? ' data-advanced="1"' : '') + '></a><div class="redactor_clip" style="display:none"></div></li>');
                        _li.children('a').html(item.title);
                        _li.children('.redactor_clip').html(item.clip);
                        _clipsmodal.find('ul.redactor_clips_box').append(_li);
                    });
                    $('body').append(_clipsmodal);
                }
            }


            var callback = $.proxy(function() {
                $('#redactor_modal').find('.redactor_clip_link').each($.proxy(function(i, s) {
                    $(s).click($.proxy(function() {
                        this.insertClip($(s).next().html(),$(s).data('advanced') == 1);
                        return false;

                    }, this));
                }, this));

                this.selectionSave();
                this.bufferSet();

            }, this );
            this.buttonAdd('clips', 'Clips', function(e) {
                this.modalInit('Clips', '#' + _modalId, 500, callback);
            });
        },
        insertClip: function(html,advanced) {
            this.selectionRestore();
            if(advanced) {
                this.insertHtmlAdvanced($.trim(html));
                this.sync(); // #hotpatch
            } else {
                this.insertHtml($.trim(html));
            }
            this.modalClose();
        }
    };
})(jQuery, window.RedactorPlugins || {});
