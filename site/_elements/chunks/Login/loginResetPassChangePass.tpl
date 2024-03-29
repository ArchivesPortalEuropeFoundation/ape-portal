<p class="text-center">[[!%asi.title_pwd_reset? &topic=`account` &namespace=`asi`]]</p>


[[!+logcp.error_message:notempty=`<p style="color: red;">[[+logcp.error_message]]</p>`]]

<form class="standard" action="[[~[[*id]]]]" method="post">
    <input type="hidden" name="nospam:blank" value="" />
    <input type="hidden" name="lp" value="[[!+logcp.lp]]"/>
    <input type="hidden" name="lu" value="[[!+logcp.lu]]"/>

    <div class="inputWrapper required">
        <label for="password_new">[[!%login.password_new]]
            <span class="error">[[+logcp.error.password_new]]</span>
        </label>
        <input type="password" name="password_new:required" id="password_new" value="[[+logcp.password_new]]" />
    </div>

    <div class="inputWrapper required">
        <label for="password_new_confirm">[[!%login.password_new_confirm]]
            <span class="error">[[+logcp.error.password_new_confirm]]</span>
        </label>
        <input type="password" name="password_new_confirm:required" id="password_new_confirm" value="[[+logcp.password_new_confirm]]" />
    </div>

    <br class="clear" />

    <div class="form-buttons">
        <input type="submit" name="logcp-submit" value="[[!%login.change_password]]" />
    </div>
</form>
