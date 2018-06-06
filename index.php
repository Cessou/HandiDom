<html>
<div class="container">
    <div class="row">
        <?php include("header.php"); ?>  <!- On inclut header qui es l'entete du site ->
    </div>
    <body class="margin">
    <form class="form-signin" action="index.php" method="post">
    <div class="square">
		<h2><u>Connexion</u></h2> <!- Texte Connexion ->
		</br>
		<p id="noalign" > Mot de passe :</p> <!- Texte Mot de passe ->
		<input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required> <!- Champ password ->
		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Connexion"> <!- Bouton connexion ->
		</br>
		<a href="mdp.php" class="link">Mot de passe oublié ?</a>  <!- Lien vers mdp.php ->
    </div>
    </form> 
    <?php
    include("bdd.php"); //Inclut connexion à la BDD
    if (isset($_POST['pass'])) //si un mdp est entré
    { 
    $password = sha1($_POST['pass']); //hashage/cryptage du mdp et enregistrement dans une variable "password"
    $req = $bdd->prepare('SELECT id, pass FROM admin '); //  recuperation du mdp et d'un id de la bdd
    $req->execute();
    $resultat = $req->fetch();
    $mdp = $resultat['pass'] ; //enregistre le mdp recuperer dans la variable "mdp"
    if ($mdp == $password){  //si les mot de passe bdd et entré sont égal
        session_start(); //démarre une session (pour après)
        $_SESSION['id'] = $resultat['id']; //enregistre dans la session un id (pas utile sur cette page)
        header ('Location: home.php'); // redirige vers le second accueil : home.php
      }
    else{ //sinon  
	?>      
        <script type="text/javascript"> alert("Mot de passe incorrect ") </script> <!- Affiche un message ->
	<?php
      }
    }
	?>
</div>
</body>
</html>
