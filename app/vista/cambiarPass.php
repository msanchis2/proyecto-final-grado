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
        <h1>Change ypur password</h1>
    </header>

    <main>
    <div class="login">
        <form action="index.php?ctl=cambiarPass" method="POST" name="login">
                <input type="password" name="pass" placeholder="New password">
                <input type="password" name="pass2" placeholder="Confirm">
                <input type="submit" name="change" value="Submit"><br>
        </form>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script src="js/logscript.js"></script>

</body>
</html>