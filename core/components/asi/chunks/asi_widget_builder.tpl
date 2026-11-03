<style>
    .widgetBuilder h3 { margin-top: 0; }
    .widgetBuilder .wbField { margin-bottom: 20px; }
    .widgetBuilder label { display: block; font-weight: 600; margin-bottom: 6px; }
    .widgetBuilder .wbHelp { margin: 6px 0 0; font-size: 13px; color: #555; }
    .widgetBuilder .wbError { margin: 6px 0 0; font-size: 13px; color: #b00020; }
    .widgetBuilder input[type="text"] { width: 100%; height: 44px; padding: 0 12px; border: 1px solid #aeaeae; font: inherit; }
    .widgetBuilder .wbCheck label { display: inline; font-weight: 400; margin-left: 6px; }
    .widgetBuilder .wbCheck input:disabled + label { color: #888; }
    .widgetBuilder textarea { width: 100%; min-height: 120px; padding: 10px; border: 1px solid #aeaeae; font: 13px/1.4 Menlo, Consolas, monospace; resize: vertical; }
    .widgetBuilder h3 + .wbField { margin-top: 14px; }
    .widgetBuilder .wbCheck input[type="checkbox"] { -webkit-appearance: checkbox !important; appearance: auto !important; position: static; opacity: 1; display: inline-block; width: 18px; height: 18px; margin: 0; vertical-align: middle; }
    .widgetBuilder .wbCopy { margin-top: 10px; padding: 10px 30px; border: 0; background: #b23063; color: #fff; font-size: 16px; font-weight: 600; cursor: pointer; }
    .widgetBuilder .wbCopy:hover { background: #8f2650; }
    .widgetBuilder .wbStatus { display: inline-block; margin-left: 10px; font-size: 13px; }
    .widgetBuilder .wbPreview iframe { display: block; width: 100%; max-width: 480px; border: 0; }
    .widgetBuilder input:focus-visible, .widgetBuilder textarea:focus-visible, .widgetBuilder button:focus-visible { outline: 3px solid #178aa8; outline-offset: 2px; }
</style>
<div class="widgetBuilder" data-widget-builder data-widget-url="[[+widget_url]]"
     data-msg-copied="[[%asi.widget_builder_copied? &topic=`default` &namespace=`asi`]]"
     data-msg-copy-failed="[[%asi.widget_builder_copy_failed? &topic=`default` &namespace=`asi`]]"
     data-iframe-title="[[%asi.search_archives_portal_europe? &topic=`default` &namespace=`asi`]]">
    <div class="row">
        <div class="col-md-6">
            <h3>[[%asi.widget_builder_title? &topic=`default` &namespace=`asi`]]</h3>
            <div class="wbField">
                <label for="wbInstitution">[[%asi.widget_builder_institution? &topic=`default` &namespace=`asi`]]</label>
                <input type="text" id="wbInstitution" list="wbInstitutions" autocomplete="off" aria-describedby="wbInstitutionHelp wbInstitutionError">
                <datalist id="wbInstitutions">[[+options]]</datalist>
                <p class="wbHelp" id="wbInstitutionHelp">[[%asi.widget_builder_institution_help? &topic=`default` &namespace=`asi`]]</p>
                <p class="wbError" id="wbInstitutionError" role="alert" hidden>[[%asi.widget_builder_institution_unknown? &topic=`default` &namespace=`asi`]]</p>
            </div>
            <div class="wbField wbCheck">
                <input type="checkbox" id="wbRecent" disabled>
                <label for="wbRecent">[[%asi.widget_builder_recent? &topic=`default` &namespace=`asi`]]</label>
            </div>
            <div class="wbField">
                <label for="wbCode">[[%asi.widget_builder_code? &topic=`default` &namespace=`asi`]]</label>
                <textarea id="wbCode" readonly aria-describedby="wbCodeHelp"></textarea>
                <p class="wbHelp" id="wbCodeHelp">[[%asi.widget_builder_code_help? &topic=`default` &namespace=`asi`]]</p>
                <button type="button" class="wbCopy" id="wbCopy">[[%asi.widget_builder_copy? &topic=`default` &namespace=`asi`]]</button>
                <span class="wbStatus" id="wbStatus" role="status" aria-live="polite"></span>
            </div>
        </div>
        <div class="col-md-6">
            <h3>[[%asi.widget_builder_preview? &topic=`default` &namespace=`asi`]]</h3>
            <div class="wbPreview" id="wbPreview"></div>
        </div>
    </div>
</div>
<script>
(function () {
    var root = document.querySelector('[data-widget-builder]');
    if (!root) return;

    var widgetUrl = root.getAttribute('data-widget-url');
    var input = document.getElementById('wbInstitution');
    var options = document.querySelectorAll('#wbInstitutions option');
    var error = document.getElementById('wbInstitutionError');
    var recent = document.getElementById('wbRecent');
    var code = document.getElementById('wbCode');
    var copy = document.getElementById('wbCopy');
    var status = document.getElementById('wbStatus');
    var preview = document.getElementById('wbPreview');

    // Heights that fit the content of each variant (the widget is responsive in width)
    var HEIGHT_GENERAL = 175;
    var HEIGHT_INSTITUTION = 340;
    var HEIGHT_RECENT = 620;

    var ids = {};
    for (var i = 0; i < options.length; i++) {
        ids[options[i].value] = options[i].getAttribute('data-id');
    }

    function escapeAttr(value) {
        return String(value).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    var current = null;

    function update() {
        var value = input.value.trim();
        var aiId = value === '' ? null : (ids[value] || null);
        var unknown = value !== '' && aiId === null;

        error.hidden = !unknown;
        input.setAttribute('aria-invalid', unknown ? 'true' : 'false');
        if (unknown) return; // keep the last valid code while the user is typing

        recent.disabled = aiId === null;
        if (aiId === null) recent.checked = false;

        var params = [];
        if (aiId !== null) params.push('ai=' + encodeURIComponent(aiId));
        if (aiId !== null && recent.checked) params.push('recent=1');
        var src = widgetUrl + (params.length ? '?' + params.join('&') : '');
        var height = aiId === null ? HEIGHT_GENERAL : (recent.checked ? HEIGHT_RECENT : HEIGHT_INSTITUTION);

        if (src === current) return;
        current = src;

        var title = root.getAttribute('data-iframe-title');
        code.value = '<iframe src="' + escapeAttr(src) + '" title="' + escapeAttr(title) + '" width="100%" height="' + height + '" style="border:0;max-width:480px" loading="lazy"></iframe>';

        var frame = document.createElement('iframe');
        frame.src = src;
        frame.title = title;
        frame.height = height;
        preview.innerHTML = '';
        preview.appendChild(frame);
        status.textContent = '';
    }

    function copyCode() {
        function done(ok) {
            status.textContent = root.getAttribute(ok ? 'data-msg-copied' : 'data-msg-copy-failed');
        }
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code.value).then(function () { done(true); }, function () { done(false); });
            return;
        }
        code.focus();
        code.select();
        try {
            done(document.execCommand('copy'));
        } catch (e) {
            done(false);
        }
    }

    input.addEventListener('input', update);
    input.addEventListener('change', update);
    recent.addEventListener('change', update);
    copy.addEventListener('click', copyCode);
    code.addEventListener('focus', function () { code.select(); });
    update();
})();
</script>
