<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo 'css/' . Config::$mvc_layout_css ?>">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="../web/js/layoutscript.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <img class="imgnav" src="../app/vista/img/logo.jpg" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=calendario">Calendar </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=reservas">My reservations </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=admin">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=aulas">Classrooms</a>
        </li>
      </ul>
      <span class="navbar-text">
        <img class="imgnav" src="../app/vista/imgUsers/<?php echo $_SESSION['imgname']; ?>">
      </span>
      <span class="navbar-text">
        <form method='POST' action='index.php?ctl=logout'><input type='submit' name='logout' value='Log out'></form>
      </span>
    </div>
  </nav>
  <div id="contenido">
    <?php echo $contenido ?>
  </div>
  <div id="footer">- pie de página -</div>
</body>

</html>