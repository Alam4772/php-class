<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration</title>
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
    <form class="form" action="{{ url('user/register-post') }}" method="POST">
        @csrf
        <h2>User Registration</h2>
        <div class="form-group">
            <input placeholder="First Name" name="student[first_name]" type="text" id="" class="form-control">
        </div>
        <div class="form-group">
            <input placeholder="Last Name" name="student[last_name]" type="text" id="" class="form-control">
        </div>
        <div class="form-group">
            <input placeholder="Email" name="user[email]" type="email" id="" class="form-control">
        </div>
        <div class="form-group">
            <input placeholder="Mobile Number" name="student[mobile_number]" min="1" type="number" id="" class="form-control">
        </div>
        <div class="form-group" style="text-align: right;">
            <button>Register</button>
        </div>
    </form>
</body>
</html>
