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
                <p class="text-center">[[!%asi.page_acc_required_err_msg? &topic=`account` &namespace=`asi`]]</p>
                [[!Login?
                    &loginTpl=`loginLoginTpl`
                    &logoutTpl=`loginLogoutTpl`
                    &errTpl=`loginErrTpl`
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