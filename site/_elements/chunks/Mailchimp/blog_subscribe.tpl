<style>
    form.standard.blog_subscribe_form p.formError {color: #FFF;}
</style>
[[!+blog_subscribe_text]]
<form class="standard blog_subscribe_form">
    <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]:</p>
    <p class="formError" data-error="blog_subscribe_email"><i class="fas fa-exclamation-triangle"></i> [[!%asi.err_msg_enter_valid_email? &topic=`forms` &namespace=`asi`]]</p>
    <div class="inputWrapper required">
        <input type="text" name="email" data-input="blog_subscribe_email" placeholder="[[!%asi.input_ph_email_address? &topic=`input` &namespace=`asi`]]">
    </div>
    <a class="button blue border full" data-action="blog_subscribe">[[!%asi.action_subscribe? &topic=`actions` &namespace=`asi`]]</a>
    <a data-trigger="blog_subscribe_success" href="#blogSubscribePopup" data-toggle="modal"></a>
</form>