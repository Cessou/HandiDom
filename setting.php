<?php include("navs.php"); ?>  
<html>
<body>
<?php
     include("bdd.php"); //BDD

    $req = $bdd->prepare('SELECT email, pass FROM admin');
    $req->execute();
    $resultat = $req->fetch(); 
    $email = $resultat['email'] ;
    $mdp = $resultat['pass'] ;
    ?> 
    <main role="main" class="container">
    <div class="col-md-8 order-md-1">
      <div class="d-flex col-md-12">
          <h2 class="mb-3">Paramètres</h2>
        <div class="offset-md-8 col-md-1">
          <a href="/setting2.php" class="btn btn-dark"><img  src="/img/svg/chevron-right.svg" class="invert" ></a>
        </div>

      </div>
          <hr class="mb-4">
          <div class="row"> <h3 class="col-md-7">Modifier l'adresse e-mail</h3> <!-- <h3 class="col-lg-5">Modifier le mot de passe</h3> --></div>
          <br>
          <form class="needs-validation" action="setting.php" method="post">
            <div class="mb-3">
              <label for="inputEmail" >Adresse e-mail actuel</label>
              <input class="form-control" placeholder="<?php echo $email;?>" disabled>
            </div>
            <div class="mb-3">
              <label for="email">Nouvelle adresse e-mail</label>
              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="admin@handidom.fr" required>
              <div class="invalid-feedback">
                Merci d'entrer une adresse e-mail valide.
              </div>
            </div>
            <div class="mb-3">
                <label for="inputPassword" >Mot de passe</label>
                <input type="password" name="pass" id="inputPassword" class="form-control" required>
            </div>
            <hr class="mb-4">
            <button class="btn btn-secondary btn-lg btn-block" type="submit">Confirmer</button>
          </form>
      </div>
     <?php   
    //  hashage du post
    if (isset($_POST['pass'])) 
    { 
     $password = sha1($_POST['pass']); 
     $mail = $_POST['email']; 
    
    if (!$resultat)
    {
    echo 'Mauvais identifiant ou mot de passe !';
    }

    else
    {
    if ($mdp == $password) 
      { 
        $req = $bdd->prepare('UPDATE admin SET email = :email');
        $req->execute(array('email' => $mail));
        ?>      
        <script type="text/javascript"> alert("Adresse email modifié") </script>
        <?php
        header('Refresh:0.5; url=setting.php');

      }
    else 
      { 
        ?>      
        <script type="text/javascript"> alert("Mots de passe incorrect") </script>
        <?php
      }
    }
    } 
        ?>
  </div>
  </body>
</html>
