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
                [[!ResetPassword?
                &loginResourceId=`72`
                &tpl=`loginResetPass`
                &placeholderPrefix=`logcp.`
                &changePasswordTpl=`loginResetPassChangePass`
                &expiredTpl=`loginExpired`
                &autoLogin=`1`
                &forceChangePassword=`true`
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