<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body style="margin: 0; padding: 0; background: #fff;">
<div
    style="max-width: 500px; margin: 0 auto; padding: 29px 16px; font-family: Inter, sans-serif; color: #000000; text-align: center;">

    <img src="{{ asset('assets/images/logo.png') }}" alt="tapeetap" style="height: 50px; margin-bottom: 24px;">

    <p style="font-size: 14px; line-height: 19px; margin: 0 0 24px;font-weight:500;">
        Your login information is provided below.<br>
        Please use it to access your account.
    </p>

    <div
        style="background-color: #f6f6f6; padding: 30px; text-align: left; font-size: 16px; line-height: 33px; margin-bottom: 24px;">
        <p style="margin: 0 0 8px;"><span>Username:</span> <a href="mailto:{{ $username }}"
                                                              style="color: #1677F1; text-decoration: none;">{{ $username }}</a>
        </p>
        <p style="margin: 0 0 8px;"><span>Password:</span> {{ $password }}</p>
        <p style="margin: 0;"><a href="{{ $login_link }}" style="color: #1677F1; text-decoration: none;">{{ $login_link }}</a>
        </p>
    </div>

    <p style="font-size: 13px; color: #9D9DA1; line-height: 17px; margin: 0 0 14px; text-align:left;">
        Keep your login details private to protect your account. If this login wasn’t made by you, please ignore this
        email.
        <br/>
        <br/>
        Have questions or need help? Reach out anytime at support@tapeetap.com
    </p>

    <p style="font-size: 11px; color: #171717; margin: 0;">&copy; {{ date('Y') }} Tapeetap. All Rights Reserved</p>
</div>
</body>
</html>

