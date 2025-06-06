<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="margin: 0; padding: 0; background: #ffffff; font-family: Inter, sans-serif;">
<div style="max-width: 358px; margin: 0 100px; padding: 29px 16px; text-align: center;">

    <!-- Logo -->
    <img src="{{ asset('assets/images/logo.png') }}" alt="tapeetap"
         style="height: 35px; margin-bottom: 24px;">

    <!-- Header -->
    <p style="font-size: 14px; line-height: 19px; margin: 0 0 24px;font-weight:500;">
        Forgot your password?<br/>
        It happens to the best of us.
    </p>

    <!-- Box with Button -->
    <div style="background-color: #f6f6f6; padding: 30px; margin-bottom: 24px;">
        <p style="font-size: 14px; line-height: 19px; margin: 0 0 24px;">
            To reset your password, click the button below. This link expires in 60 minutes.
        </p>
        <a href="{{ $url }}"
           style="display: inline-block; padding: 10px 45px; background-color: #161616; color: #ffffff; text-decoration: none; font-size: 12px; line-height: 12px; border-radius: 7px;">
            Reset My Password
        </a>
    </div>

    <!-- Footer Info -->
    <p style="font-size: 13px; color: #9D9DA1; line-height: 17px; margin: 0 0 24px; text-align:left;">
        If this request wasn’t made by you, please ignore this email. Keep your login details private to protect your
        account.
        <br/>
        <br/>
        Have questions or need help? Reach out anytime at support@tapeetap.com
    </p>

    <p style="font-size: 11px; color: #171717; margin: 0;">&copy; {{ date('Y') }} Tapeetap. All Rights Reserved</p>
</div>
</body>
</html>
