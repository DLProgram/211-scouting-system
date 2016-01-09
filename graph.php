<?php
  include("connect.php");
  include('lock.php'); 
  $name="Team Data"
?>

<?php 
  if(isset($_GET["team_number"])){
    $team_number=$_GET["team_number"];
    if(!empty($team_number)){
      $q = "SELECT * FROM data WHERE team_num = '{$team_number}' ORDER BY match_num ;";
      $result = mysqli_query($conn, $q);
    }
    $lift_count = 0;
    $not_lift_count = 0;

    $lifted_count = 0;
    $not_lifted_count = 0;
    while($row = mysqli_fetch_assoc($result)){
      if($row["lift"] == 1){
        $lift_count++;
      }elseif ($row["lift"] == 0) {
        $not_lift_count++;
      }

      if($row["lifted"] == 1){
        $lifted_count++;
      }elseif ($row["lifted"] == 0) {
        $not_lifted_count++;
      }

      $data[] = $row;
    }
    $lift_data["name"] = "Lift";
    $lift_data["value"] = $lift_count;
    
    $not_lift_data["name"] = "Not Lift";
    $not_lift_data["value"] = $not_lift_count;

    $lift_pie_data[] = $not_lift_data;
    $lift_pie_data[] = $lift_data;

    $lifted_data["name"] = "Lifted";
    $lifted_data["value"] = $lifted_count;
    
    $not_lifted_data["name"] = "Not Lifted";
    $not_lifted_data["value"] = $not_lifted_count;

    $lifted_pie_data[] = $not_lifted_data;
    $lifted_pie_data[] = $lifted_data;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $name?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" href="1.ico" type="image/x-icon">

    <script src="amcharts/amcharts.js" type="text/javascript"></script>
    <script src="amcharts/serial.js" type="text/javascript"></script>
    <script src="amcharts/pie.js" type="text/javascript"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var chart;
        var graph;

        AmCharts.ready(function () {

            var chartData = <?php echo json_encode($data);?>;


            // SERIAL CHART
            chart = new AmCharts.AmSerialChart();
            chart.dataProvider = chartData;
            chart.categoryField = "match_num";
            chart.startDuration = 0.3; 

            var valueAxis1 = new AmCharts.ValueAxis();
            valueAxis1.axisThickness = 2;
            valueAxis1.gridAlpha = 0;
            valueAxis1.maximum = 100;
            valueAxis1.minimum = 0;
            chart.addValueAxis(valueAxis1);

            var valueAxis2 = new AmCharts.ValueAxis();
            valueAxis2.position = "right"; 
            valueAxis2.gridAlpha = 0;
            valueAxis2.axisThickness = 2;
            valueAxis2.maximum = 1;
            valueAxis2.minimum = 0;
            chart.addValueAxis(valueAxis2);


            // GRAPH
            graph = new AmCharts.AmGraph();
            graph.title = "Auto";
            graph.type = "smoothedLine";
            graph.valueAxis = valueAxis1;
            graph.valueField = "auto";
            graph.bullet = "round";
            graph.bulletSize = 8;
            graph.bulletBorderColor = "#FFFFFF";
            graph.bulletBorderAlpha = 1;
            graph.bulletBorderThickness = 2;
            graph.lineThickness = 4;
            graph.balloonText = "Match: [[category]]<br>Auto:[[value]]%";
            chart.addGraph(graph);


            graph1 = new AmCharts.AmGraph();
            graph1.title = "Drive";
            graph1.type = "smoothedLine";
            graph1.valueAxis = valueAxis1;
            graph1.valueField = "drive";
            graph1.bullet = "round";
            graph1.bulletSize = 8;
            graph1.bulletBorderColor = "#FFFFFF";
            graph1.bulletBorderAlpha = 1;
            graph1.bulletBorderThickness = 2;
            graph1.lineThickness = 4;
            graph1.balloonText = "Match: [[category]]<br>Drive:[[value]]%";
            chart.addGraph(graph1);

            graph = new AmCharts.AmGraph();
            graph.title = "Lift";
            graph.type = "step"; 
            graph.lineThickness = 5;
            graph.valueAxis = valueAxis2;
            graph.valueField = "lift";
            graph.balloonText = "Match: [[category]]<br>Lift:[[value]]";
            chart.addGraph(graph);

            graph = new AmCharts.AmGraph();
            graph.title = "Lifted";
            graph.type = "step"; 
            graph.lineThickness = 5;
            graph.valueAxis = valueAxis2;
            graph.valueField = "lifted";
            graph.balloonText = "Match: [[category]]<br>Lifted:[[value]]";
            chart.addGraph(graph);

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



            var liftPieData = <?php echo json_encode($lift_pie_data);?>

            pieChart = new AmCharts.AmPieChart();
            pieChart.dataProvider = liftPieData;
            pieChart.titleField = "name";
            pieChart.valueField = "value";
            pieChart.outlineColor = "#FFFFFF";
            pieChart.outlineAlpha = 0.8;
            pieChart.outlineThickness = 2;
            pieChart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            pieChart.depth3D = 15;
            pieChart.angle = 30;

            var liftedPieData = <?php echo json_encode($lifted_pie_data);?>

            pieChart1 = new AmCharts.AmPieChart();
            pieChart1.dataProvider = liftedPieData;
            pieChart1.titleField = "name";
            pieChart1.valueField = "value";
            pieChart1.outlineColor = "#FFFFFF";
            pieChart1.outlineAlpha = 0.8;
            pieChart1.outlineThickness = 2;
            pieChart1.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            pieChart1.depth3D = 15;
            pieChart1.angle = 30;

            // WRITE
            pieChart1.write("liftedchartdiv");
            pieChart.write("liftchartdiv");
            chart.write("chartdiv");

        });

    </script>
  </head>
  <body>
    <?php include("navbar.php") ?>
    <div id="top"></div>
    <div class="container">
      <h1>Team Data</h1>
      <div class="row">
        <form method="get"> 
            Team Number: <input type="text" name="team_number" value=<?php echo isset($team_number) ?  $team_number :  "";?>>
            <input type="submit" Value="GO!" class="btn btn-lg btn-success">
          </form>
        </div>
        <div class="row">
          <div id="chartdiv" style="width:100%; height:400px;"></div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div id="liftchartdiv" style="width:100%; height:400px;"></div>
          </div>
          <div class="col-md-6">
            <div id="liftedchartdiv" style="width:100%; height:400px;"></div>
          </div>
        </div>
          
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>