<?php
  include("connect.php");
  include('lock.php'); 
  $name="Graph";
?>

<?php 
  if(isset($_GET["team_number"])){
    $team_number=$_GET["team_number"];
    if(!empty($team_number)){
      $q = "SELECT * FROM data WHERE team_num = '{$team_number}';";
      $result = mysqli_query($conn, $q);
    }
    
    while($row = mysqli_fetch_assoc($result)){
      $data[] = $row;
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $name?></title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="1.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css.css">

        <script src="amcharts/amcharts.js" type="text/javascript"></script>
        <script src="amcharts/serial.js" type="text/javascript"></script>

        <script>
            var chart;
            var graph;

            AmCharts.ready(function () {

                var chartData = <?php echo json_encode($data);?>


                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "match_num";


                // GRAPH
                graph = new AmCharts.AmGraph();
                graph.title = "Auto";
                graph.valueField = "auto";
                graph.bullet = "round";
                graph.bulletSize = 8;
                graph.bulletBorderColor = "#FFFFFF";
                graph.bulletBorderAlpha = 1;
                graph.bulletBorderThickness = 2;
                graph.lineThickness = 2;
                graph.balloonText = "Match: [[category]]<br>Auto:[[value]]%";
                chart.addGraph(graph);


                graph1 = new AmCharts.AmGraph();
                graph1.title = "Drive";
                graph1.valueField = "drive";
                graph1.bullet = "round";
                graph1.bulletSize = 8;
                graph1.bulletBorderColor = "#FFFFFF";
                graph1.bulletBorderAlpha = 1;
                graph1.bulletBorderThickness = 2;
                graph1.lineThickness = 2;
                graph1.balloonText = "Match: [[category]]<br>Drive:[[value]]%";
                chart.addGraph(graph1);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chartCursor.valueLineEnabled = true;
                chartCursor.valueLineBalloonEnabled = true;
                chart.addChartCursor(chartCursor);


                var legend = new AmCharts.AmLegend();
                legend.marginLeft = 110;
                legend.useGraphSettings = true;
                chart.addLegend(legend);

                chart.categoryAxis.parseDates= false;

                // WRITE
                chart.write("chartdiv");
            });

        </script>
    </head>

    <body>
        <?php include("navbar.php") ?>
        <div class="container">
          <div id="top"></div>
          <h1>Graph</h1>
          <div class="row">
            <form method="get"> 
                Team Number: <input type="text" name="team_number" value=<?php echo isset($team_number) ?  $team_number :  "";?>>
                <input type="submit" Value="GO!" class="btn btn-lg btn-success">
              </form>
            </div>
          <div id="chartdiv" style="width:100%; height:400px;"></div>
        </div>
        
    </body>

</html>