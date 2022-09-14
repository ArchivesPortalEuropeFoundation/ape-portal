<li class="mg-video mg-video-[[+service]]">
    [[- If you want to show the Vimeo video directly, you use something like this:
    <div class="flex-video widescreen [[+service]]">
        <iframe class="mg-video mg-video-[[+service]]" width="[[+width]]" height="[[+height]]"
                src="//player.vimeo.com/video/[[+video_id]]" frameborder="0"></iframe>
    </div>
    Otherwise, the file_url and mgr_thumb contain the thumbnail for the video. ]]

    <a href="[[+view_url]]" title="[[+name:htmlent]]">
        <img src="[[+mgr_thumb]]" class="img-polaroid" alt="[[+name:htmlent]]">
    </a>
</li>