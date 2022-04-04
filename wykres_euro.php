<?php

$connect = mysqli_connect('localhost','root','','waluty');
$wynik = $connect->query("SELECT * FROM EUR");

$dataPoints = array();

foreach($wynik as $d){
	$dana['label']=$d['data'];
	$dana['y']=$d['kurs'];
	$dataPoints[]=$dana;
}

$connect->close();
?>

<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	//theme: "light2",
	axisX:{

	},
	axisY:{
		title: "kurs",
		valueFormatString: "0.0#"
	},
	data: [{
		type: "line",
        lineThickness: 2,
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 80%; margin: auto; font-family: 'Courier New', Courier, monospace;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  