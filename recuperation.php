<div class="container">
  <div class="row">
    <?php include("header.php"); ?>  
  </div>
<body class="margin">
<?php 

    include("bdd.php"); //BDD
	session_start();
    $code = $_SESSION['code'];
	$email = $_SESSION['email'];
	
    if(empty($_GET))
	{
		header('Location: http://127.0.0.1/index.php');
	}	
    elseif (isset($_GET['code'])) 
	{ 
		if(($_GET['code']) == $code )
		{ ?>
		<div class="row">
			<form method="post" class="form-signin">
			<div class="square">
				<h3> Mot de passe oublié</h3>
				</br>
				<p id="noalign" >Nouveau mot de passe :</p>
				<input name="pass" type="password" class="form-control" placeholder="*******" pattern=".{5,}"   required title="5 caractères minimum" autofocus><br>
				<p id="noalign" >Confirmer le mot de passe :</p>
				<input name="passconf" type="password" class="form-control" placeholder="*******" required><br>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
			</div>
			</form>
        </div>
		<?php
		}
		elseif (($_GET['code']) != $code)
		{
		header('Location: http://127.0.0.1/index.php'); 
		}
        if(isset($_POST['pass']))
		{	
			if (($_POST['pass']) == ($_POST['passconf']))
				{			
				$pass = sha1($_POST['pass']);
				$code = '';
				for($i=0; $i<8; $i++){
				$code .=  mt_rand(0,9);}
				var_dump($_POST['passconf']);
				$req = $bdd->prepare('UPDATE ihm SET pass = :pass WHERE email = :email');
				$req->execute(array('pass' => $pass, 'email' => $email));
				$req = $bdd->prepare('UPDATE ihm SET code = :code WHERE email = :email');
				$req->execute(array('code' => $code, 'email' => $email)); ?>
				<script type="text/javascript"> alert("Mot de passe modifié") </script>
				<?php
				header('Refresh:0.5; url=index.php');
				}
			else 
				{ 
				 printf("Les mots de passe ne sont pas identiques");
				}
		}
	}
	
        ?>
</div>
</body>
</html>