<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Form</title>
    <style>
        .logout-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }

    </style>
</head>
<body>
<h1>Hi {{$user->name}}</h1>
<h4>you can logout and check your email</h4>
<form action="{{route('logoutEvent',['id'=>$user->id])}}" method="POST">
    @csrf
    <button type="submit" class="logout-button">Logout</button>
</form>
</body>
</html>
