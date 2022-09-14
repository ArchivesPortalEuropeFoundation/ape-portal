<script type="text/javascript" src="[[+assets_url]]mgr/js/lib/jquery.latest.js[[+version_string]]"></script>
<script type="text/javascript" src="[[+assets_url]]mgr/js/lib/dependencies.min.js[[+version_string]]"></script>
<script type="text/javascript">
var underscore = _.noConflict();
var mg$ = $.noConflict();
</script>
<script type="text/javascript" src="[[+assets_url]]mgr/js/backbone/app.min.js[[+version_string]]"></script>
<script type="text/javascript" src="[[+assets_url]]mgr/js/backbone/tags.min.js[[+version_string]]"></script>
<script type="text/javascript">
    mg$(document).ready(function($) {
        MODx.on("ready", function() {
            $.ajaxSetup({
                beforeSend:function(xhr, settings){
                    if(!settings.crossDomain) {
                        xhr.setRequestHeader('modAuth',MODx.siteId);
                    }
                }
            });

            window.appView = window.appView || new moreGallery.ImageAppView({
                el: $('#mgresource-backbone'),
                permissions: [[+permissions_json]]
            });
            appView.render();
        });
   });
</script>
