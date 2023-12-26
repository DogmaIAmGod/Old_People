<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="login-container">
        <form action="{{ route('validateLogin') }}" class="login-form" method="POST">
            {{ csrf_field() }}

            <h2>Login</h2>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

            <input type="submit" name="submit" value="login" class="login">
            <span class="register">Register: </span><a class="register" href="/register">Click here</a>
    </div>
</body>
</html>

