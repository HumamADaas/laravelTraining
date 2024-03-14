<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        h2 {
            color: #0074D9;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button[type="submit"] a {
            text-decoration: none; /* Remove underline */
            color: #fff; /* Set text color to white */
            background-color: #0074D9;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            display: inline-block;
        }

        button[type="submit"] a:hover {
            background-color: #0056b3; /* Change background color on hover */
        }

    </style>
</head>
<body>
<h2>Password Reset</h2>
Hi {{$user->name}},
{{$token}}
<br>
<form id="password-reset-form">
    <button type="submit"><a href="{{ route('VNP',['token'=>$token]) }}" >Reset Password</a></button>
</form>
<h3>Thank you</h3>
</body>
</html>
