<?php include("navs.php"); ?>  
<html>
<body>
<?php if(empty($_POST)): ?>
<main role="main" class="container">
    <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Contact</h4>
          <form class="needs-validation" action="addcontact.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Prénom</label>
                <input name="prenom" class="form-control" id="firstName" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Nom <span class="text-muted">(Optionnel)</span></label>
                <input name="nom" class="form-control" id="lastName" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
              <label for="num">Numéro</label>
              <input name="numero" pattern="^0[1-9]([ ]?[0-9]{2}){4}$" class="form-control" placeholder="06 54 32 10 98" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              <label for="country">Upload</label>
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="monfichier" required>
                  <label class="custom-file-label" >Choisir un fichier</label>
                </div>
              </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="fred">Fréquence d'appels <span class="text-muted">(par semaine)</span></label>
                <select class="custom-select d-block w-50" id="selec" name="frequence">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select> 
              </div>
            </div>
            <hr class="mb-4">
              <div class="row justify-content-between">
            <div class="col-md-4 offset-md-8">
              <a href="phone.php"><button type="button" class="btn btn-secondary btn-lg">Retour </button></a>
              <button type="submit" class="btn btn-dark btn-lg">Valider </button>        
            </div> 
            </div> 
          </form>
  <?php else: ?>              
<?php
    
    include("bdd.php"); //BDD

    if (isset($_POST['prenom'])) 
    { 

     $prenom = $_POST['prenom']; 
     $nom = $_POST['nom'];
     $num = $_POST['numero'];  
	 $idphoto = substr ($num, -3);
     $numero=str_replace(' ','',$num);
     $numero = substr($numero,1);  // modification numero pour basse de donnée
     $frequence = $_POST['frequence'];

    $allowed_filetypes = array('.JPG', '.jpg', '.jpeg', '.JPEG', '.gif','.bmp','.png','.PNG'); // Fichiers passant la validation.
    $max_filesize = 524200000; // taille du paquet max
    $upload_path = './img/profil/'; // Directory.
    $prenom = $_POST['prenom']; 
    $filename = $_FILES['monfichier']['name']; // Nom du fichier
    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Recuperation de l'extension

// On verifie si le type de fichier va bien
if(!in_array($ext,$allowed_filetypes))
   {
    ?>      
        <script type="text/javascript"> alert("Pas de photo ajouté") </script>
    <?php
    }
  
// On regarde la taille du fichier
if(filesize($_FILES['monfichier']['tmp_name']) > $max_filesize)
   die('?>      
        <script type="text/javascript"> alert("Image trop volumineuse") </script>
        <?php');
  
// On verifie si on peut ecrire dans le repertoire de destination
if(!is_writable($upload_path))
   die('?>      
        <script type="text/javascript"> alert("Formulaire incorrect") </script>
        <?php');

// On upload
if(move_uploaded_file($_FILES['monfichier']['tmp_name'],$upload_path . $prenom. $idphoto . '.jpg'))
    {
      echo '<p> Too bad, Ca plante... </p>'; //  Erreur pdt le transfert :(.
      } 

      $req = $bdd->prepare('INSERT INTO phone(prenom, nom, numero, frequence) VALUES(:prenom, :nom, :numero, :frequence)');

      $req->execute(array(

    'prenom' => $prenom,

    'nom' => $nom,

    'numero' => "+33".$numero,

    'frequence' => $frequence,

    ));
        ?>
        <script type="text/javascript"> alert("Contact ajouté") </script>
        <?php
        header('Refresh:0.5; url=phone.php');

      }
    else 
      { 
        ?>      
        <script type="text/javascript"> alert("Formulaire incorrect") </script>
        <?php
      } 
?>
    </div>
      <?php endif; ?>
  </body>
</html>
