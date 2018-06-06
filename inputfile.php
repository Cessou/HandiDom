<?php
    $allowed_filetypes = array('.JPG', '.jpg', '.jpeg', '.JPEG', '.gif','.bmp','.png','.PNG'); // Fichiers passant la validation.
    $max_filesize = 1097152; // taille du paquet max
    $upload_path = './img/profil/'; // Directory.
    $filename = $_FILES['monfichier']['name']; // Nom du fichier
    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Recuperation de l'extension
    $filesize = $_FILES['monfichier']['size']; // recuperation de la taille
    $filetmp = $_FILES['monfichier']['tmp_name']; // recuperation de l'emplacement temporaire


// On verifie si le type de fichier va bien
if(!in_array($ext,$allowed_filetypes))
   {
    ?>      
        <script type="text/javascript"> alert("Pas de photo ajouté : Extension incorrect") </script>
    <?php
    }
  
// On regarde la taille du fichier
if(($_FILES['monfichier']['size']) > $max_filesize)
   {
    ?>      
        <script type="text/javascript"> alert("Pas de photo ajouté : Image trop volumineuse") </script>
        <?php
      }
// On verifie si on peut ecrire dans le repertoire de destination
if(!is_writable($upload_path))
   {
    ?>     
        <script type="text/javascript"> alert("Erreur pas de photo ajouté") </script>
        <?php
   }
// On upload
if(move_uploaded_file($filetmp,$upload_path . $id.'.jpg'))
    {
      echo 'Erreur'; 
    } 
?>