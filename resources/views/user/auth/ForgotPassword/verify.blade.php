<!doctype html>

<html lang="en">

<head>
    <title>Xác nhận email</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .verfify-mail-blue {
            background-color: #4BD5CA;
            margin: 0 10px;
            height: 100px;
        }
        .verfify-mail-gray {
            background-color: #f1f1f1;
            margin: 0 10px;
            text-align: center;
        }
        .verfify-mail-gray .verfify-mail-white {
            background-color: #fff;
            height: 150px;
        }
        .verfify-mail-gray .verfify-mail-white p {
            padding: 20px
        }
        .verfify-mail-gray .verfify-mail-white input {
            padding: 10px 100px;
            background-color: #4BD5CA;
            color: #fff;
            font-style: bold;
            border: none;
        }
    </style>
</head>

<body>
    <section>
        <div class="verfify-mail-blue"></div>
        <div class="verfify-mail-gray">
            <div class="verfify-mail-white">
                <p>Vui lòng thay đổi mật khẩu của bạn</p>
                {!! Form::open(['method' => 'GET', 'route' => 'forgot_password.change_password']) !!}
                    {!! Form::hidden('email', $email) !!}
                    {!! Form::submit('Đổi mật khẩu') !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="verfify-mail-blue"></div>
    </section>
</body>

</html>
