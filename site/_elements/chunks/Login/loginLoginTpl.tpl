                <form class="standard login" action="[[~[[*id]]]]" method="post">
                    [[+errors]]
                    <p class="fieldLabel">[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*</p>
                    <div class="inputWrapper required">
                        <input type="text" name="username" placeholder="[[!%asi.label_email_address? &topic=`label` &namespace=`asi`]]*">
                    </div>
                    <p class="fieldLabel">Password*</p>
                    <div class="inputWrapper required">
                        <input type="password" name="password" placeholder="Password*">
                    </div>
                    <input type="hidden" name="returnUrl" value="[[+request_uri]]">
                    <input type="hidden" name="service" value="login">
                    <div class="text-center">
                        <input type="submit" value="Login" class="blue" name="Login">
                    </div>
                    <a class="forgotPassword" href="[[~136]]"><strong>I've forgotten my password</strong></a>
                </form>