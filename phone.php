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
      <!-- <th scope="col">Activer</th> -->
      <th scope="col">Modifier</th>
    </tr>
  </thead>
  <tbody class="valign">
<?php

    include("bdd.php"); //Connexion à la BDD

    $reponse = $bdd->query('SELECT * FROM phone WHERE activer = 1'); //Récupération de la bdd

    while ($donnees = $reponse->fetch())
{
    $id = $donnees['id'];
    $nom = $donnees['nom'];
    $prenom = $donnees['prenom'];
    $frequence = $donnees['frequence'];
    $activer = $donnees['activer'];
    $numero = $donnees['numero'];
	
	
	$idphoto = substr ($numero, -3);
?>

    <tr class="hover">
      <th ><?php echo "$prenom" . " $nom"; ?></th>
      <td><div class="profile-media__item" style="background: url(img/profil/<?php echo $prenom.$idphoto;?>.jpg) center / cover"></div></td>
      <td><button type="button" class="btn" id="bw" disabled><?php echo $frequence;?></button></td>
      <td><button type="button" class="btn" id="bw" disabled><?php echo $donnees['numero']; ?></button></td></td>
      <!-- <td><form method="post" action="gestion_phone.php"> <input name="ok" type="checkbox" <?php echo $check;?> ></form></td> -->
      <td><a href='editcontact.php?contact=<?php echo $prenom; ?>'><img src="/img/svg/pencil.svg" class="oticon" ></a><a href='phone.php?del=<?php echo $id; ?>'><button type="submit" class="btn btn-link"><img src="/img/svg/trashcan.svg" class="oticon" ></button></a></td>
    </tr>
<?php
}
 
$reponse->closeCursor(); // Termine le traitement de la requête
?>  


  </tbody>
</table>
            <hr class="mb-4">
            <div class="col-md-2 offset-md-10">
            <a href="addcontact.php"> <button type="button" class="btn btn-dark btn-lg">Ajouter</button></a>                    
            </div> 
      </div>
<?php
    if (isset($_GET['del'])) 
    { 
      $del = $_GET['del'];
      $req = $bdd->prepare('UPDATE `handidom`.`phone` SET activer = 0 WHERE `phone`.`id` = :del');
      $req->execute(array('del' => $del));
      ?>      
      <script type="text/javascript"> alert("Contact supprimé") </script>
	  <meta http-equiv="refresh" content="0.5; URL=phone.php">
      <?php

    }
?>  
  </body>
</html>