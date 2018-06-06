<?php include("navs.php"); ?>  
<html>
<body>
    <main role="main" class="container">
    <div class="col-md-8 order-md-1">
      <div class="d-flex col-md-12">
          <h2 class="mb-3">Paramètres</h2>
        <div class="offset-md-7 col-md-2">
          <a href="/setting.php" class="btn btn-dark"><img src="/img/svg/chevron-left.svg" class="invert"></a>
          <a href="/setting3.php" class="btn btn-dark"><img  src="/img/svg/chevron-right.svg" class="invert" ></a>
        </div>

      </div>
          <hr class="mb-4">
          <div class="row"> <h3 class="col-md-7">Résidents actuel</h3> <!-- <h3 class="col-lg-5">Modifier le mot de passe</h3> --></div>
          <br>
          <form class="needs-validation" action="setting2.php" method="post">
            <div class="mb-3">
              <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Prénom</label>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Nom</label>
              </div>
              </div>
   <?php
        include("bdd.php"); //BDD
        $request = $bdd->prepare('SELECT pass FROM admin');
        $request->execute();
        $resultat = $request->fetch(); 
        $mdp = $resultat['pass'] ;

        $req = $bdd->query('SELECT * FROM user');
        while ($data = $req->fetch())
        {
        $prenom = $data['prenom'] ;
        $nom = $data['nom'] ;
        $id = $data['id'] ;
        ?> 
             <div class="row">
              <div class="col-md-6 mb-3">
                <input name="prenom<?php echo $id;?>" value="<?php echo $prenom;?>" class="form-control" id="firstName" required>
              </div>
              <div class="col-md-6 mb-3">
                <input name="nom<?php echo $id;?>" value="<?php echo $nom;?>" class="form-control" id="lastName" required>
              </div>
            </div>
            <?php
            }

            ?>  
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
        $req = $bdd->prepare('UPDATE user SET nom = :nom , prenom = :prenom WHERE id = :id');
        $req->execute(array(
          'nom' => $nom,
          'prenom' => $prenom,
          'id' => $i));
        }
 
        ?>  

        <script type="text/javascript"> alert("Modifications validé") </script>
        <meta http-equiv="refresh" content="0.5; URL=setting2.php">
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
