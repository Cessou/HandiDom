<?php include("navs.php"); ?>  
<html>
<body>
<?php if(empty($_POST)): ?>
<?php  

    
	if (isset($_GET['date']))
  {
		$today = $_GET['date'];
	}
	else 
	{
		$today = date("Y-m-d"); 
	}
?>  
  <main role="main" class="container">         
    <div class="col-md-8 order-md-1">
          <h4 class="offset-md-5 mb-2">&Eacute;vénement</h4><br>
          <form class="needs-validation" action="addevent.php" method="post" enctype="multipart/form-data">
            <div class="row">
				<div class="col-md-6 mb-3">
					<label for="firstName">Titre de l'événement</label>
					<input name="titre"  class="form-control" id="firstName" required>
				</div>
				<div class="col-md-6 mb-3">
					<label for="firstName">Date de l'événement</label>
					<input  type="date" name="date"  class="form-control" value="<?php echo $today ;?>" required>
				</div>
            </div> 
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="firstName">Début l'événement</label>
					<input  type="time" name="starttime"   class="form-control" value="15:00" required>
				</div>
				<div class="col-md-6 mb-3">
					<label for="firstName">Fin de l'événement</label>
					<input  type="time" name="endtime"  class="form-control" value="19:00" required>
				</div>
            </div>
			<div class="row">
				<div class="col-md-12 mb-3">
			  		<label for="firstName">Détails de l'événement</label>
					<textarea class="form-control" name="detail" rows="3" ></textarea>
				</div>
            </div>
      <div class="row">
        <div class="col-md-12">
          <label >Pictogramme</label>
        </div> 
        <div class="col-md-12">
          <div class="form-check form-check-inline">
            <label class="picto hover"><img src="img/icons/1.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="1" checked></label>
            <label class="picto hover"><img src="img/icons/2.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="2" ></label>
            <label class="picto hover"><img src="img/icons/3.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="Radios" value="3" ></label>
            <label class="picto hover"><img src="img/icons/4.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="4" ></label>
            <label class="picto hover"><img src="img/icons/5.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="5" ></label>
            <label class="picto hover"><img src="img/icons/6.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="6" ></label>
            <label class="picto hover"><img src="img/icons/7.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="7" ></label>
            <label class="picto hover"><img src="img/icons/8.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="8" ></label>
          </div>
        </div> 
        <div class="col-md-12">
          <div class="form-check form-check-inline">
            <label class="picto hover"><img src="img/icons/9.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="9" ></label>
            <label class="picto hover"><img src="img/icons/10.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="10" ></label>
            <label class="picto hover"><img src="img/icons/11.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="11" ></label>
            <label class="picto hover"><img src="img/icons/12.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="12" ></label>
            <label class="picto hover"><img src="img/icons/13.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="13" ></label>
            <label class="picto hover"><img src="img/icons/14.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="14" ></label>
            <label class="picto hover"><img src="img/icons/15.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="15" ></label>
            <label class="picto hover"><img src="img/icons/16.png" width="50" height = "48">&nbsp;<input class="form-check-input" type="radio" name="picto" value="16" ></label>
          </div>
        </div> 
      </div>
        <hr class="mb-4">
          <div class="row justify-content-between">
            <div class="col-md-4 offset-md-8"> 
              <a href="agenda.php"><button type="button" class="btn btn-secondary btn-lg">Retour </button></a>
              <button type="submit" class="btn btn-dark btn-lg">Valider </button>        
            </div> 
            </div> 
          </form> 
  <?php else: ?>              
<?php
    include("bdd.php"); //BDD

    if (isset($_POST['titre'])) 
    { 

    $titre = $_POST['titre'];
	  $titre = ucfirst($titre);	 
    $detail = $_POST['detail'];
	  $detail = ucfirst($detail);	
	  $date = $_POST['date'] ; 
    $picto = $_POST['picto'] ; 
	  $starttime = $_POST['starttime']; 
	  $endtime = $_POST['endtime']; 
	  $start = $date . " ". $starttime ;
	  $end = $date . " ". $endtime ;

      $req = $bdd->prepare('INSERT INTO events SET name = :name, description = :description, start = :start, end = :end, picto = :picto');
      $req->execute(array(

    'name' => $titre,
    'description' => $detail,
	  'start' => $start,
	  'end' => $end,
    'picto' => $picto,

    ));
        ?>
        <script type="text/javascript"> alert("Evénement ajouté") </script>
        <?php
        header('Refresh:0.5; url=agenda.php');

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
