<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <title>HandiDom</title>

    </head>


    <body>
    	<?php include("entete.php"); ?>
        <div class="centre">
        <form action="cible.php" method="post">
        <p> Identifiant </p>
        <input class="inp" type="text" name="pseudo"/>
        <p> Mot de passe </p>
        <input class="inp" type="password" name="pass"/>
        </br>
        </br>
        <input class="log" type="submit" value="Se connecter" />
        </form>
      	<a href="mdp.php" class="link">Mot de passe oublié ?</a> </br></br>

        </div>
    </body>

 </html>