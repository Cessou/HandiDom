 <?php include("navs.php"); ?>  
<html>
<body>
    <main role="main" class="container">
      <div class="starter-template">        
   <table class="table" >
    <thead class="thead-light">
    <tr>
      <th scope="col">Contact</th>
      <th scope="col">Photo</th>
      <th scope="col">Fréquence d'appel</th>
      <th scope="col">Numéro</th>
      <th scope="col">Modifier</th>
    </tr>
  </thead>
  <tbody class="valign">
<?php

    include("bdd.php"); //Connexion à la BDD
    $id_user = $_GET['user'];
    $reponse = $bdd->query("SELECT * FROM contacts WHERE id_user = '{$id_user}' AND activer = 1"); //Récupération de la table phone    $req->execute(array('id' => $id));
    while ($donnees = $reponse->fetch())
    {
    $id = $donnees['id'];
    $nom = $donnees['nom'];
    $prenom = $donnees['prenom'];
    $frequence = $donnees['frequence'];
    $activer = $donnees['activer'];
    $numero = $donnees['numero'];
    ?>
    <tr class="hover">
		<th><?php echo "$prenom" . " $nom"; ?></th>
		<td><div class="profile-media__item" style="background: url(img/profil/<?php echo $id;?>.jpg) center / cover"></div></td>
		<td><button type="button" class="btn" id="bw" disabled><?php echo $frequence;?></button></td>
		<td><button type="button" class="btn" id="bw" disabled><?php echo $numero; ?></button></td>
		<td>
			<a href='editcontact.php?user=<?php echo $_GET["user"] ?>&id=<?php echo $id; ?>'><img src="/img/svg/pencil.svg"></a>&nbsp;
			<a href='phone.php?user=<?php echo $_GET["user"] ?>&del=<?php echo $id; ?>'><img src="/img/svg/trashcan.svg"></a>
		</td>
    </tr>
    <?php
    }
    $reponse->closeCursor(); // Termine le traitement de la requête
    ?>  
  </tbody>
</table>
            <hr class="mb-4">
            <div class="col-md-2 offset-md-10">
            <a href="addcontact.php?user=<?php echo $_GET["user"] ?>"> <button type="button" class="btn btn-dark btn-lg">Ajouter</button></a>                      
			</div> 
      </div>
<?php
    if (isset($_GET['del'])) 
    { 
      $del = $_GET['del'];
      $req = $bdd->prepare('UPDATE `handidom`.`contacts` SET activer = 0 WHERE `contacts`.`id` = :del');
      $req->execute(array('del' => $del));
      ?>      
      <script type="text/javascript"> alert("Contact supprimé") </script>
	  <meta http-equiv="refresh" content="0.5; URL=phone.php?user=<?php echo $_GET["user"] ?>">
      <?php
    }
?>  
  </body>
</html>