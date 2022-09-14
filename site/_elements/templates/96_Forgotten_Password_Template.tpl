<!DOCTYPE html>
<html lang="[[!++cultureKey]]">
<head>
    [[$head]]
</head>
<body>
[[$header]]

[[$innerHero]]

<section class="halfTopMargin">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                [[-[[!ResetPassword? &loginResourceId=`79`&tpl=`lgnForgotPassTpl`]]]]
                [[!ForgotPassword?
                    &loginResourceId=`79`
                    &resetResourceId=`442`
                    &tpl=`lgnForgotPassTpl` 
                    &emailTpl=`email_forgottenPassword`
                    &sentTpl=`lgnForgotPassSentTpl`
                    &emailSubject=`Reset your password with [[++site_name]]`
                    
                ]]
            </div>
        </div>
    </div>
</section>


[[$footer]]

[[$banners]]

[[$tooltips]]

[[$scripts]]

</body>
</html>