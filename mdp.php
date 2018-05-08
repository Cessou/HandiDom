<div class="container">
  <div class="row">
    <?php include("header.php"); ?>  
  </div>
<body class="margin">
<?php 

    include("bdd.php"); //BDD

    $req = $bdd->prepare('SELECT email FROM ihm');
    $req->execute();
    $resultat = $req->fetch(); 
    $email = $resultat['email'] ;
    
    if(empty($_POST)): ?>
        <div class="row">
        <form method="post" class="form-signin">
          <div class="square">
            <h3> Mot de passe oublié</h3>
            </br>
            <p id="noalign" > Adresse e-mail :</p>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse e-mail" required autofocus>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
          </div>
        </form>
        </div>
    <?php 
    elseif ($_POST['email']==$email): ?>    
         <div class="row">
          <form method="post" class="form-signin">
            <div class="square">
             <a href="index.php" class="nounderline" > <button type="button" class="btn btn-lg btn-success btn-block"> 
              <?php
                if(isset($_POST['email']))
                  print('Un e-mail à était envoyé à </br><strong>').($_POST['email']).('</strong>');
				  session_start();
                  $_SESSION['email'] = $email;
				  $code = "";
				  for($i=0; $i<8; $i++){
					$code .=  mt_rand(0,9);
				  }
				  $_SESSION['code'] = $code;
				  $req = $bdd->prepare('UPDATE ihm SET code = :code');
				  $req->execute(array('code' => $code));
				  $header="Mime version: 1.0\r\n";
				  $header.='From:"HandiDom"<handidom2018@gmail.com>'."\n";
				  $header.='Content-Type:text/html; charset="utf-8"'."\n";
				  $header.='Content-Transfer-Encoding: 8bit';
				  $message='
					<html>
						<head>
							<title> Notifiation - HandiDom</title>
							<meta charser="utf-8" />
						</head>
						<body>
						<div style="background-color:#343a40;">
							<h1 style="text-align: center;font-family:Lato,sans-serif;font-size: 420%;color: #ffff;">HandiDom</h1>
								<div style="font-size:12px;background-color:#f5f5f5;text-align:justify;border-radius:5px;margin-left: 30%;margin-right: 30%; padding: 1%;">
								Bonjour, <br>
								Une demande de réinitialisation de mot de passe pour votre compte a été faite. <br> 
								<div style="text-align:center;font-size:14px;"><a href="file:///C:\wamp64\www\recuperation.php?code='.$code.'"><br>	
								Cliquez ici pour réinitialiser votre mot de passe</div></a>
								<div style="font-size:10px;"><br><br>
								ou, en cas de problème, copier/coller le lien ci-dessous dans la barre de navigation:<br> 
								127.0.0.1/recuperation.php?code='.$code.'
								</div>
								</div>
								<br><br>
						</div>
						</body>
					</html>';
					mail($email, 'Récupération du mot de passe', $message, $header);
					header('Refresh:2; url=index.php');
              ?>
              </button>  </a>    
          </div>
          </form>
        </div>
    <?php 
    else :?>
        <div class="row">
        <form method="post" class="form-signin">
          <div class="square">
            <button type="button" class="btn btn-lg btn-danger btn-block"> 
            Email incorrect 
            </button>
            </br>
            <p id="noalign" > Adresse e-mail :</p>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Adresse e-mail" required autofocus>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
          </div>
        </form>
        </div>
  <?php endif; ?>
</div>
</body>
</html>