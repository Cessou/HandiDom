 <?php include("navs.php"); ?>  
<html>
<body>
<?php 
    include("bdd.php"); //BDD  

     if (isset($_GET['id']))
    {
    $id = $_GET['id'];
    $id_user = $_GET['user'];
    //recuperation de la bdd
    $req = $bdd->prepare('SELECT * FROM contacts WHERE `contacts`.`id` = :id');
    $req->execute(array('id' => $id));
    $donnees = $req->fetch(); 
    $idreq = $donnees['id'];
    $nomreq = $donnees['nom'];
    $prenomreq = $donnees['prenom'];
    $frequencereq = $donnees['frequence'];
    $numeroreq = $donnees['numero'];
    $MonMembreExiste = $req->rowCount();
    }
  if(empty($_GET['id'])): 
  $id_user = $_GET['user'];
  header('Location: phone.php?user='.$id_user);
  else: ?>      
  <main role="main" class="container">         
    <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Contact</h4>
          <form class="needs-validation" action="editcontact.php?user=<?php echo $_GET["user"] ?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Prénom</label>
                <input name="prenom" value="<?php echo $prenomreq;?>" class="form-control" id="firstName" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Nom <span class="text-muted">(Optionnel)</span></label>
                <input name="nom" value="<?php echo $nomreq;?>" class="form-control" id="lastName" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
              <label for="num">Numéro</label>
              <input class="form-control" pattern="^0[1-9]([ ]?[0-9]{2}){4}$" name="numero" value="<?php $rest = substr($numeroreq, -9); echo '0'.$rest ;?>" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              <label for="country">Upload</label>
              <div class="input-group mb-3">
                  <input type="file" name="monfichier">
              </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="fred">Fréquence d'appels <span class="text-muted">(par semaine)</span></label>
                <select class="custom-select d-block w-50" id="selec" name="frequence">
                  <option value="<?php echo $frequencereq;?>"selected hidden><?php echo $frequencereq;?></option>
                  <option >1</option>
                  <option >2</option>
                  <option >3</option>
                  <option >4</option>
                  <option >5</option>
                  <option >6</option>
                  <option >7</option>
                  <option >8</option>
                  <option >9</option>
                  <option >10</option>
                </select> 
              </div>
              <div class="col-md-6">
                <label for="cc-number">Photo</label>
                <div class="profile-media_item" style="background: url(img/profil/<?php echo $idreq;?>.jpg) center / cover"></div>
              </div>
            </div> 
            <input type="hidden" name="id" value="<?php echo $idreq;?>" />
            <hr class="mb-4">
              <div class="row justify-content-between">
            <div class="col-md-4 offset-md-8">
              <a href="phone.php?user=<?php echo $_GET["user"] ?>"><button type="button" class="btn btn-secondary btn-lg">Retour </button></a>
              <button type="submit" class="btn btn-dark btn-lg">Valider </button>        
            </div> 
            </div> 
          </form> 
          <?php endif; ?>             
<?php
    if (isset($_POST['prenom'])) 
    { 
    
     $id = $_POST['id'];
     $prenom = $_POST['prenom']; 
     $nom = $_POST['nom'];
     $num = $_POST['numero'];  
     $numero=str_replace(' ','',$num);
     $numero = substr($numero,1);  // modification numero pour basse de donnée
     $frequence = $_POST['frequence'];

    include("inputfile.php"); //input file

      $req = $bdd->prepare('UPDATE contacts SET prenom = :prenom, nom = :nom, numero = :numero, frequence = :frequence WHERE id = :id'); 
      $req->execute(array(

    'prenom' => $prenom,
 
    'nom' => $nom,

    'numero' => "+33".$numero,

    'frequence' => $frequence,

    'id' => $id,

    ));
        ?>
       <script type="text/javascript"> alert("Contact mit à jour") </script>
        <?php
      header('Refresh:0.5; url=phone.php?user='.$id_user);
}    

?>
    </div> 

  </body>
</html>