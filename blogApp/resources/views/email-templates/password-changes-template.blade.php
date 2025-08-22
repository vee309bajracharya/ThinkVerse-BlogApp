<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password Changed Successfully</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: oklch(0.97 0.0352 61.56);
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #F8F8FF;
            padding: 40px 20px;
            border-radius: 8px;
        }

        .title {
            color: #fa6f43;
        }

        .logo {
            margin: 2rem 0;
            width: 100%;
        }

        .info {
            background-color: #fff0eb;
            padding: 10px;
            border-left: 4px solid #fa6f43;
            margin: 20px 0;
            font-family: monospace;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666666;
            padding: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px 10px;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        {{-- <img src='http://thinkverse.test/backend/vendors/images/mainLogo2.png' alt="ThinkVerse Logo" class="logo"> --}}
        <h2 class="title">Password Changed Successfully</h2>
        <p>Hello, {{$user->name}}</p>
        <p>This is a confirmation that your password was successfully changed.</p>

        {{-- <div class="info">
            <p><strong>Username/Email:</strong> {{$user->username}} or {{$user->email}}</p>
            <p><strong>Password:</strong>{{$new_password}}</p>
        </div> --}}

        <p>If you did not make this change, please reset your password immediately or contact our support team.</p>
        <p>ThinkVerse Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{date('Y')}} ThinkVerse. All Rights Reserved.</p>
    </div>
</body>

</html>
