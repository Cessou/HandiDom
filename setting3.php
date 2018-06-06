<?php include("navs.php"); ?>  
<html>
<body>
    <main role="main" class="container">
    <div class="col-md-8 order-md-1">
      <div class="d-flex col-md-12">
          <h2 class="mb-3">Paramètres</h2>
        <div class="offset-md-7 col-md-1">
          <a href="/setting2.php" class="btn btn-dark"><img src="/img/svg/chevron-left.svg" class="invert"></a>
        </div>

      </div>
         <?php
        include("bdd.php"); //BDD
        $request = $bdd->prepare('SELECT pass FROM admin');
        $request->execute();
        $resultat = $request->fetch(); 
        $mdp = $resultat['pass'] ;

        $req = $bdd->query('SELECT * FROM user WHERE id = 1');
        $req->execute();
        $data = $req->fetch(); 
        $prenom1 = $data['prenom'] ;
        $nom1 = $data['nom'] ;
        $id1 = $data['id'] ;

        $req = $bdd->query('SELECT * FROM user WHERE id = 2');
        $req->execute();
        $data = $req->fetch(); 
        $prenom2 = $data['prenom'] ;
        $nom2 = $data['nom'] ;
        $id2 = $data['id'] ;
        ?> 
          <hr class="mb-4">
          <div class="row"> <h3 class="col-md-7">Photo résidents</h3> <!-- <h3 class="col-lg-5">Modifier le mot de passe</h3> --></div>
          <br>
          <form class="needs-validation" action="setting2.php" method="post">
            <div class="mb-3">
              <div class="row">
              <div class="col-md-6 mb-3">
                <h5><?php echo $prenom1; ?></h5>
              </div>
              <div class="col-md-6 mb-3">
                <h5><?php echo $prenom2; ?></h5>
              </div>
              </div>
          <div class="row">
            <div class="col-md-6">
              <label for="country">Upload</label>
              <div class="input-group mb-3">
                <input type="file" name="fichier1">
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="country">Upload</label>
              <div class="input-group mb-3">
                <input type="file" name="fichier2">
              </div>
            </div>
              <div class="col-md-6">
                <label for="cc-number">Photo</label>
                <div class="profile-media_item" style="background: url(img/user/profil1.png)"></div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="cc-number">Photo</label>
                <div class="profile-media_item" style="background: url(img/user/profil2.png)"></div>
              </div>
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
    
    $res = $bdd->query('SELECT COUNT(id) FROM user');
    $nb = $res->fetch();
    $nb = $nb[0];
var_dump($nb);
if (isset($_POST['pass'])) { 

    $password = sha1($_POST['pass']); 

    if (!$resultat)
    {
    echo 'Mauvais identifiant ou mot de passe !';
    }

    else
    {
    if ($mdp == $password) 
      { 

      for ($i=1; $i<=$nb; $i++) {
        $prenom = $_POST['prenom'.$i]; 
        $nom= $_POST['nom'.$i];
        //remplacer photo
        }
 
        ?>  

        <script type="text/javascript"> alert("Modifications validé") </script>
        <meta http-equiv="refresh" content="0.5; URL=setting3.php">
<?php
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
