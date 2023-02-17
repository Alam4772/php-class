<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate Password</title>
    <style>
        body {

            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-group {

            margin-bottom: 15px;
        }

        .form-control {

            padding: 10px;
            width: 100%;
        }

        .form button {
            background: green;
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form class="form" action="{{ url('password/save') }}/{{ $token }}" method="POST">
        @csrf
        <h2>Generate Password</h2>
        <div class="form-group">
            <input placeholder="Enter Password..." name="user[password]" type="password" id="" class="form-control">
        </div>
        <div class="form-group">
            <input placeholder="Confirm Entered Password..." name="confirm_password" type="password" id="" class="form-control">
        </div>
        <div class="form-group" style="text-align: right;">
            <button>Save</button>
        </div>
    </form>
</body>
</html>
