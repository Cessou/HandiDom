<?php

session_start();
if(empty($_SESSION['id'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: http://127.0.0.1/index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="icon" sizes="16x16" href="img/favicon.ico">
        <title>HandiDom</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
         <!-- Custom this -->
        <link href="css/style.css" rel="stylesheet">

        <link href="css/dashboard.css" rel="stylesheet">

    </head>
  <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">&nbsp;&nbsp;Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item" id="decal">
            <a id="nodiv" class="nav-link" href="agenda.php">Agenda&nbsp;</a>
          </li>
          <li class="nav-item">
            <a id="nodiv" class="nav-link" href="phone.php">Softphone</a>
          </li>

        </ul>
              <ul class="navbar-nav px-3">
        <li class="nav-item">
          <a class="nav-link" href='logout.php' >Sign out &nbsp;<img src="/img/svg/logout.png" class="oticon" ></a>
        </li>
      </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-1 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  Martin
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  Guillaume
                </a>
                <hr />
              </li>
               <li class="nav-bot">
                <a class="nav-link" href='setting.php'>Setting &nbsp;<img src="/img/svg/gear.svg" class="oticon" ></a>
              </li>
            </ul>
          </div>
        </nav>
  </body>
</html>
