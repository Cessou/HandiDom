<?php

session_start();
if(empty($_SESSION['id'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: index.php');
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
<?php 
$active1 = $_SERVER['PHP_SELF'] === "/agenda.php";
$active2 = $_SERVER['PHP_SELF'] === "/phone.php";
?>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">&nbsp;&nbsp;Home <span class="sr-only">(current)</span></a>
          </li>
          <?php 
          if(!empty($_GET['user']))
          { ?>
          <li class="nav-item <?php echo $active1 ? "active" : ''; ?>" id="decal">
            <a class="nav-link" href="agenda.php?user=<?php echo $_GET["user"] ?>">Agenda&nbsp;</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $active2 ? "active" : ''; ?>" href="phone.php?user=<?php echo $_GET["user"] ?>">Contacts</a>
          </li>
          <?php } ?>
        </ul>
        <?php 
          if(empty($_GET['user']))
          { ?>
        <div class="collapse navbar-collapse justify-content-md-center" >
        <ul class="navbar-nav justify-content-md-center"">
        <li class="nav-item">
          <a class="nav-link" href='accueil.php'>Streaming&nbsp;<img class="invert2" src="/img/svg/device-camera-video.svg" ></a>
        </li>
        </ul>
        </div>
        <?php } ?>
        <ul class="navbar-nav px-3">
        <li class="nav-item">
          <a class="nav-link" href='logout.php'>Sign out &nbsp;<img src="/img/svg/logout.png" ></a>
        </li>
      </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-1 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky top">
            <ul class="nav flex-column">
            <?php include("bdd.php"); //BDD   
              $req = $bdd->query('SELECT * FROM user');
              while ($data = $req->fetch())
              {
              $id = $data['id'];
              $nom = $data['nom'];
              $prenom = $data['prenom']; 

              if(!empty($_GET['user'])){
                $active = $_GET["user"] === $data['id'];
              }
              else{
                $active = false;
              }
              ?>
          <li class="nav-item">
                <a class="nav-link <?php echo $active ? "font-weight-bold" : ''; ?>"  href="agenda.php?user=<?php echo "$id"; ?>" >
                <?php echo "$prenom"; ?>
                </a>
              </li>
            <?php
            }
            $req->closeCursor(); ?>  
               <li class="nav-bot">
                <hr />
                <a class="nav-link" href='setting.php'>Setting &nbsp;<img src="/img/svg/gear.svg"></a>
              </li>
            </ul>
          </div>
        </nav>
  </body>
</html>
