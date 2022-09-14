<form class="standard loginFPForm" action="[[~[[*id]]]]" method="post">
    [[+loginfp.errors]]
    <p class="fieldLabel">[[%login.username]]</p>
    <div class="inputWrapper">
        <input class="loginFPUsername" type="text" name="username" value="[[+loginfp.post.username]]" />
    </div>
    <p>[[%login.or_forgot_username]]</p>
    <p class="fieldLabel">[[%login.email]]</p>
    <div class="inputWrapper">
        <input class="loginFPEmail" type="text" name="email" value="[[+loginfp.post.email]]" />
    </div>
    <input type="hidden" name="returnUrl" value="[[+request_uri]]">
    <input type="hidden" name="service" value="login">
    <input class="returnUrl" type="hidden" name="returnUrl" value="[[+loginfp.request_uri]]" />
    <input class="loginFPService" type="hidden" name="login_fp_service" value="forgotpassword" />
    <div class="text-center">
        <input type="submit" class="blue" name="login_fp" value="[[%login.reset_password]]" />
    </div>
</form>