<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    @auth
        <p>You are logged in</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log out</button>
        </form>    
    @else
        <div style="border: 3px solid black; padding: 1em; width: 300px;">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name = "name" type="text" placeholder="Name">
                <input name = "email" type="text" placeholder="Email">
                <input name = "password" type="password" placeholder="password">
                <button style="background-color: aquamarine">Register</button>

            </form>
        </div>
        
        <div style="border: 3px solid black; padding: 1em; width: 300px;">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name = "loginname" type="text" placeholder="Name">
                <input name = "loginpassword" type="password" placeholder="password">
                <button style="background-color: aquamarine">Register</button>

            </form>
        </div>
    @endauth
        
</body>
</html>