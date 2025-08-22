<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Your Password</title>

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
        .title{
            color: #fa6f43;
        }

        .logo{
            margin: 2rem 0;
            width: 100%;
    
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #fa6f43;
            color: #F8F8FF;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 20px;
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

            .btn {
                padding: 10px 20px;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        {{-- <img src='{{@asset('backend/vendors/images/mainLogo2.png')}}' alt="ThinkVerse Logo" class="logo"> --}}
        <h2 class="title">Password Reset Request</h2>
        <p>Hello, {{$user->name}}</p>
        <p>You recently requested to reset your password. Click the button below to reset it.</p>
        <a href="{{$actionLink}}" target="_blank" class="btn">Reset Password</a>
        <p>This link is valid for only 15 minutes.</p>
        <p>If you didn't request this, you can safely ignore this email.</p>
        <p>ThinkVerse Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{date('Y')}} ThinkVerse. All Rights Reserved.</p>
    </div>
</body>

</html>
