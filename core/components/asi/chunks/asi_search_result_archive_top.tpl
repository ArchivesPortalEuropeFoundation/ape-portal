<h1>[[!+archive.title:striptags]]</h1>

[[!+archive.subtitle_date:notempty=`<span class="date">
                <i class="far fa-calendar-alt"></i> [[!+archive.subtitle_date]]
            </span>`]]
[[!+archive.eadid:notempty=`<span class="ref">
                <strong>[[!%asi.title_reference? &topic=`default` &namespace=`asi`]]:</strong>
                [[!+archive.eadid]]
            </span>`]]
<div class="buttons">
    <a class="button blue visible-xs visible-sm toggleSlideUp viewContext" href="#affix"><i class="fas fa-sitemap"></i>[[!%asi.view_context? &topic=`default` &namespace=`asi`]]</a>
    <a class="button blue visible-xs visible-sm toggleSlideUp" href="#optionsSlideUp"><i class="fas fa-cogs"></i></a>
    [[- <a class="button blue hidden-xs hidden-sm" href="#bookmarkPopup" data-trigger="save_bookmark"><i class="fas fa-bookmark"></i> [[!%asi.action_bookmark? &topic=`actions` &namespace=`asi`]]</a>]]
    <a class="button blue hidden-xs hidden-sm" href="#suggestionPopup" data-trigger="suggestion"><i class="fas fa-pencil"></i> [[!%asi.action_make_a_suggestion? &topic=`actions` &namespace=`asi`]]</a>
    <a class="button blue aLink hidden-xs hidden-sm" onclick="contactInstitutionClick()"><i class="fas fa-comment"></i> [[!%asi.action_contact_institution? &topic=`actions` &namespace=`asi`]]</a>
    <div class="buttonDropdown">
        <a class="button blue"><i class="fas fa-share-alt"></i><span class="hidden-xs"> [[!%asi.tools_share? &topic=`default` &namespace=`asi`]]</span></a>
        <div class="inner">
            <a href="[[!++sharing_facebook_content]]" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="[[!++sharing_twitter_content]]" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="[[++sharing_linkedin_content]]" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a>
            <a href="[[!+sharing_uri_unescaped]]" class="copyUrl"><i class="fas fa-link"></i> <span>[[!%asi.tools_copy_link? &topic=`default` &namespace=`asi`]]</span></a>
        </div>
    </div>
    [[-<div class="buttonDropdown">
        <a class="button blue"><i class="fas fa-download"></i><span class="hidden-xs"> [[!%asi.tools_download_link? &topic=`default` &namespace=`asi`]]</span></a>
        <div class="inner">
            <a href="[[!download_pdf_link]]" target="_blank"><i class="fas fa-file-download"></i> [[!%asi.action_download_pdf? &topic=`actions` &namespace=`asi`]]</a>
            <a><i class="fas fa-file-export"></i> [[!%asi.tools_export? &topic=`default` &namespace=`asi`]]</a>
            <a href="#" onclick="window.print();"><i class="fas fa-print"></i> [[!%asi.tools_print? &topic=`default` &namespace=`asi`]]</a>
        </div>
    </div>]]
</div>
[[!+archive.original_link:notempty=`<a class="originalLink" href="[[!+archive.original_link]]" target="_blank">[[!+archive.original_link_text]] <i class="far fa-external-link-alt ml"></i></a>`]]

<div style="text-align: left">
    [[$suggestionPopup]]
</div>

<script>
    listenForSuggestion();
    listenForDropdownButtons();

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

    $('.enableSubmit').change(function () {
        var form = $(this).parents('form');
        var subButton = $(form).find('input[type="submit"]');
        if ($(this).is(':checked')) {
            $(subButton).removeClass('disabled');
        } else {
            $(subButton).addClass('disabled');
        }
    });

    $('#setRecipient a.button').click(function () {
        var recipient = $(this).attr('id');
        var input = $('form').find('input[name="recipient"]');
        $(input).val(recipient);
    });

    $('a.button.toggle').click(function () {
        $(this).siblings('.active').removeClass('active');
        $(this).toggleClass('active');
    });
    
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

</script>
