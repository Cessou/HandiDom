<html>  
<body>
	<div class="container">
      <div class="row">
        <?php include("navs.php"); ?>  
      </div>
	<div class="row">
<?php 
    require "src/month.php";
    $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $jours = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');  
    if (isset($_GET['date'])) 
    {
       $dates= $_GET['date'];
       $dates = explode("-", $dates);
       $date= $_GET['date'];
    }
    else 
    {
      $dates=array(date("Y"),date("m"),date("d")); 
      $date= date("Y-m-d");   
    }
    $mois=intval($dates[1]-1);
    $nextday =  $dates[0] ."-". $dates[1] ."-". ($dates[2]+1);
    $previousday =  $dates[0] ."-". $dates[1] ."-". ($dates[2]-1);
    $maxday = cal_days_in_month(CAL_FRENCH, intval($dates[1]), intval($dates[0]));
    $prevmaxday = $maxday-1;
    if (($dates[2]) == $maxday)
    {
        $nextday =  $dates[0] ."-". sprintf('%02d', ($dates[1]+1)) ."-". (01);    
    }
    if (($dates[2]) == 01)
    {
        $previousday =  $dates[0] ."-". ($dates[1]-1) ."-". ($dates[2]-1);  
        $previousday =  $dates[0] ."-". sprintf('%02d', ($dates[1]-1)) ."-". ($maxday-1);
    }
    if (($dates[1] + $dates[2]) == $maxday)
    {
        $nextday =  $dates[0] ."-". sprintf('%02d', ($dates[1]+1)) ."-". (01);    
    }
?>

<div class="d-flex col-md-12">
    <div class="col-md-6">
        <h4 class="offset-md-5"><?php echo $dates[2].' '. $months[$mois] . ' ' . $dates[0]; ?></h4>
        <hr>
    </div>
	 <div class="col-md-1">
		<a href="/addevent.php?date=<?php echo $date; ?>"" class="btn btn-secondary"><img  src="/img/svg/plus.svg" class="invert" ></a>
	</div>
    <div class="col-md-2 ">
        <a href="/agendaday.php?date=<?php echo $previousday; ?>" class="btn btn-dark"><img src="/img/svg/chevron-left.svg" class="invert"></a>
        <a href="/agendaday.php?date=<?php echo $nextday; ?>" class="btn btn-dark"><img  src="/img/svg/chevron-right.svg" class="invert" ></a>
</div>
</div>
<div class="col-md-8">
<table class="table table-striped">
  <thead>
    <tr class="theader">
      <th scope="col" width=15%>Heure</th>
      <th scope="col">Evenement</th>
    </tr>
  </thead>
</table>
<div style="height:550px; overflow:auto; "> 
<table class="table table-striped">
<?php for ($i = 0; $i < 24; $i++): ?>
    <tr class="center hover">
      <th width=15% ><?php echo sprintf('%02d', $i) . "h" ; ?></th>
      <td></td>
    </tr>
<?php endfor; ?>
</table>
</div>
</div>
</body>
</html>