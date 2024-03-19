<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .socialite {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .socialite a {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .socialite a:nth-child(1) {
            background-color: #3b5998; /* Facebook blue */
            color: #fff;
        }

        .socialite a:nth-child(2) {
            background-color: #db4437; /* Google red */
            color: #fff;
        }

        .socialite a:nth-child(3) {
            background-color: #333; /* GitHub black */
            color: #fff;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form action="#" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

<div class="socialite">
    <a href="{{route('login.facebook')}}">facebook</a>
    <a href="{{route('login.google')}}">google</a>
    <a href="{{route('login.github')}}">github</a>
</div>
</div>

</body>
</html>
