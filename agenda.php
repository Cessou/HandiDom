<html>  
<body>
	<div class="container">
      <div class="row">
        <?php include("navs.php"); ?>  
      </div>
	<div class="row">
<?php 
    require "src/month.php";
	  require "src/events.php";

    $events = new Events();
	  $month = new Month($_GET['month'] ?? null,  $_GET['year'] ?? null);
    $start = $month->getStartingDay();
    $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
    $weeks = $month->getWeeks();
    $end = clone $start;
    $end->modify("+". (6 + 7 * ($weeks - 1)) . "days");
    $events = $events->getEventsBetweenByDay($start, $end);

    include("bdd.php"); //BDD

    $req = $bdd->prepare('SELECT id FROM agenda');  
    $req->execute();	
	  $donnees = $req->fetch(); 
    //$id = $donnees['id'];      
?>
<div class="d-flex col-md-12">
    <div class="col-md-10">
        <h4 class="offset-md-5"><?php echo $month->toString();  ?></h4>
        <hr>
    </div>
	 <div class="col-md-1">
		<a href="/addevent.php" class="btn btn-secondary"><img  src="/img/svg/plus.svg" class="invert" ></a>
	</div>
    <div class="col-md-2 ">
        <a href="/agenda.php?month=<?php echo sprintf('%02d', $month->previousMonth()->month); ?>&year=<?php echo $month->previousMonth()->year; ?>" class="btn btn-dark"><img src="/img/svg/chevron-left.svg" class="invert"></a>
        <a href="/agenda.php?month=<?php echo sprintf('%02d', $month->nextMonth()->month); ?>&year=<?php echo $month->nextMonth()->year; ?>" class="btn btn-dark"><img  src="/img/svg/chevron-right.svg" class="invert" ></a>
</div>
</div>

<table class="calendar__table">  
    <tr class="thead" height="5%">
        <th>Lundi</th>
        <th>Mardi</th>
        <th>Mercredi</th>
        <th>Jeudi</th>
        <th>Vendredi</th>
        <th>Samedi</th>
        <th>Dimanche</th>
    </tr> 
<?php for ($i = 0; $i < $weeks; $i++): ?>
    <tr>
    <?php 
	foreach($month->days as $k => $day): 
        $date = clone $start; 
        $date->modify("+" . ($k + $i * 7) . " days");
		$eventsForDay = $events[$date->format('Y-m-d')] ?? [];
		$isToday = date('Y-m-d') === $date->format('Y-m-d');
    if (isset($_GET['year'])) 
    {
       $dates= $_GET['year']. '-' . $_GET['month'] . '-' . $date->format('d');
    }
    else 
    {
      $dates = date("Y-m") . "-" . $date->format('d'); 
    }
    ?> 
        <td style="cursor:pointer" onclick="location.href='agendaday.php?date=<?php echo $dates; ?>'" class="<?php echo $isToday ? "is-today" : ''; ?><?php echo $month->withinMonth($date) ? '' : "calendar__othermonth"; ?> hover">
            <div class="calendar__day">
              <a class="nounderline" href="addevent.php?date=<?php echo $dates; ?>" >
                <?php echo $date->format('d'); ?>
              </a>
            </div>
			<br>
			<?php foreach ($eventsForDay as $event): ?>
			<div class="calendar__event">
			<u>
			<?php  echo (new DateTime($event['start']))->format('H:i'); ?> - <?php echo (new DateTime($event['end']))->format('H:i');?></u> :
			<a href="editevent.php?id=<?php echo $event['id']; ?>">
			<?php echo $event['name'] ; ?></a>
			</div>
			<?php endforeach; ?>
        </td>			 
        <?php endforeach; ?>
    </tr>
<?php endfor; ?>
</table>

</div>
<?php
    if (isset($_GET['del'])) 
    { 
      $del = $_GET['del'];
      $req = $bdd->prepare('DELETE FROM `agenda` WHERE `agenda`.`id` = :del');
      $req->execute(array('del' => $del));
      ?>      
      <script type="text/javascript"> alert("Evénement supprimé") </script>
	  <meta http-equiv="refresh" content="0.1; URL=agenda.php">
        <?php
    }
?> 	
</body>
</div>
</html>