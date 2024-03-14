<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Center the form */
        .reset-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Style form elements */
        form {
            border: 2px solid #f1f1f1;
            padding: 20px;
            max-width: 300px;
            background-color: #fff;
            border-radius: 5px;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #04AA6D;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
        }

        button:hover {
            background-color: #038055;
        }

        /* Additional styling as needed */

    </style>
    <title>Reset Password</title>
</head>
<body>
<div class="reset-container">
    <form action="{{route('postResetPass')}}" method="post">
        @csrf
        <p>Reset password? Enter your email:</p>
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter your email" name="email" required>
        <button type="submit">Reset</button>
        <button type="submit"><a href="{{route('getLogin')}}">back to login</a></button>
    </form>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
</div>
</body>
</html>

