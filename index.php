    <div class="container">
      <div class="row">
        <?php include("header.php"); ?>  
      </div>
  <body class="margin">
    <form class="form-signin" action="index.php" method="post">
      <div class="square">
      <h2><u>Connexion</u></h2>
      </br>
      <p id="noalign" > Mot de passe :</p>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required>
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Connexion">
      </br>
      <a href="mdp.php" class="link">Mot de passe oublié ?</a> 
      </div>
    </form> 
    <?php
     include("bdd.php"); //BDD
    //  hashage du post
    if (isset($_POST['pass'])) 
    { 
     $password = sha1($_POST['pass']); 
    
    //recuperation de la bdd
    $req = $bdd->prepare('SELECT id, pass FROM ihm ');
    $req->execute();
    $resultat = $req->fetch();
    
    $mdp = $resultat['pass'] ;
    
    if (!$resultat)
    {
    echo 'Mauvais identifiant ou mot de passe !';
    }

    else
    {
    if ($mdp == $password) 
      {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        header ('Location: home.php');
      }
    else 
      { 
?>      
        <script type="text/javascript"> alert("Mot de passe incorrect ") </script>
<?php
      }
    }
    } 
?>
  </div>
  </body>
</html>
