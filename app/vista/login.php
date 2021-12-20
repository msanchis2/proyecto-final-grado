<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo 'css/'.Config::$mvc_login_css ?>">
    <title>Login</title>
</head>
<body>
    <header>
        <h1>Welcome to IES Abastos classroom reservation website</h1>
    </header>

    <main>
    <div class="login">
        <h2>Log in</h2>
        <form action="index.php?ctl=login" method="POST" name="login">
                <input type="text" name="email" placeholder="name.surname">
                <input type="password" name="pass" placeholder="Password">
                <input type="submit" name="login" id="login" value="Log in"><br>
                <input type="checkbox" name="recordar">Remember my username<br>
                <input type="submit" name="forgot" id="a" value="Forgot your password?"><br>
        </form>
    </div>

    <div class="signup">
        <h2>New user? Sign up</h2>
    </div>

    <div class="signupform">
        <form action="index.php?ctl=login" method="POST" name="registerform" enctype="multipart/form-data">
         
            <p>
                <input type="text" name="nombre" placeholder="Name">
                <input type="text" name="apellido" placeholder="Surname">
            </p>
            <p>
                <input type="password" name="pass" placeholder="Password">
                <input type="password" name="pass2" placeholder="Confirm Password">
            </p>
            <p>
                <label>Profile pic:</label><br>
                <input type="file" name="imagen">
            </p>
            <p>
                <input type="submit" name="signup" value="Sign up">
            </p>
            <p>Your email will be linked as your name.surname@iesasbatos.org</p>
        </form>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script src="js/logscript.js"></script>

</body>
</html>