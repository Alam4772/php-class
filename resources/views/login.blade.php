<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <style>
        body {

            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {

            padding: 25px;
            box-shadow: 0px 0px 5px 0px grey;
        }

        .form-group {

            margin-bottom: 15px;
        }

        .form-control {

            padding: 10px;
            font-size: 20px;
        }

        .login-button {

            background: green;
            padding: 15px 30px;
            color: white;
            border: none;
            text-transform: uppercase;
            font-size: 15px;
            cursor: pointer;
        }
    </style>
</head>
    <body>
        <form action="{{ url('user/dologin') }}" method="POST">
            @csrf
            @if($errors->any())
                <h4 style="text-align: center; color: red;">{{$errors->first()}}</h4>
            @endif
            <h1 style="text-align: center;">Login</h1>
            <div class="form-group">
                <input name="email" type="email" name="" id="" class="form-control" placeholder="email">
            </div>
            <div class="form-group">
                <input name="password" type="password" name="" id="" class="form-control" placeholder="password">
            </div>
            <div class="form-group" style="text-align: right;">
                <span>
                    <button type="submit" class="login-button">Login</button>
                </span>
            </div>
        </form>
    </body>
</html>
