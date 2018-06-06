 <?php include("navs.php"); ?>  
<html>
<body>
    <main role="main" class="container">
      <div class="container">
      <div class="page-header">
      <h1>Bienvenue</h1>
      <hr class="mb-4">
      <br>
      </div>   
      <img class="logo" src="img/logo.png" alt="Logo HandiDom" width=8%> 
      </div>
      <br>
      <br>
        <div class="form-center">
        <div class="row">
        <?php include("bdd.php"); //BDD   
        $req = $bdd->query('SELECT * FROM user');
        while ($data = $req->fetch())
        {
        $id = $data['id'];
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        ?>
          <a href="agenda.php?user=<?php echo "$id"; ?>" class="nounderline" >
          <div class="card">
            <img class="card-img-top" src="/img/user/profil<?php echo "$id"; ?>.PNG" alt="Card image cap">
            <h5><?php echo "$prenom" . " $nom"; ?></h5>
          </div>
          </a>
        <?php
        }
        $req->closeCursor(); ?>  
        </div>  
        </div>
  
</body>
</html>

              

