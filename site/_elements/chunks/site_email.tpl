<html lang="[[!++cultureKey]]" style="margin:0">
<head>
    <style>
        body {
            margin:0;
        }
    </style>
</head>
<body style="margin:0">
<table class="body">
    <tr>
        <td>
            <table class="outer_bg">
                <tr>
                    <td>
                        <table class="email head-wrap">
                            <tr>
                                <td></td>
                                <td class="header container">
                                    <div class="content">
                                        <table>
                                            <tr>
                                                <td>
                                                    <a href="[[++site_url]]">
                                                        <img class="image_logo" src="[[++email_logo]]" alt="[[++site_name]] logo"/>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                        <table class="email body-wrap">
                            <tr>
                                <td></td>
                                <td class="container">
                                    <div class="content">
                                        <table>
                                            <tr>
                                                <td class="content">
                                                    [[+content]]
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                        <table class="email footer-wrap">
                            <tr>
                                <td></td>
                                <td class="container">
                                    <div class="content">
                                        <table>
                                            <tr>
                                                <td align="center">
                                                    <p>&copy; [[++site_name]] [[current_year]][[++contact_number:isnotempty=` | [[++contact_number]]`]][[++contact_email:isnotempty=` | <a href="mailto:[[++contact_email]]">[[++contact_email]]</a>`]]</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>