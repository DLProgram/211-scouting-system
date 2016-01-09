<?php
  include("connect.php");
  include('lock.php'); 
  $name="Leaderboard Graph"
?>

<?php 
  function sortsum(){
    global $conn;
    global $data;

    $q = "SELECT * FROM leaderboard ";
    $result = mysqli_query($conn, $q);

    while($row = mysqli_fetch_assoc($result)){
      $data[] = $row;
    }
    if(!empty($data)){
      $sum = array();
      foreach ($data as $key => $value) {
        $sum[$key] = $value['auto'] + $value['drive'];
      }
      array_multisort($sum,SORT_DESC,$data);
    }
    
  }

  function sortdrive(){
    global $conn;
    global $data;
    $q = "SELECT * FROM leaderboard ORDER BY drive DESC;";
    $result = mysqli_query($conn, $q);

    while($row = mysqli_fetch_assoc($result)){
      $data[] = $row;
    }    
  }

  function sortauto(){
    global $conn;
    global $data;

    $q = "SELECT * FROM leaderboard ORDER BY auto DESC;";
    $result = mysqli_query($conn, $q);

    while($row = mysqli_fetch_assoc($result)){
      $data[] = $row;
    }
  }

  if(isset($_GET["order"])){
    if($_GET["order"] == "sum"){
      sortsum();
    }elseif ($_GET["order"] == "drive") {
      sortdrive();
    }elseif ($_GET["order"] == "auto") {
      sortauto();
    }else{
      sortsum();
    }
  }else{
      sortsum();
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

            var chartData = <?php echo json_encode($data);?>

            // SERIAL CHART
            chart = new AmCharts.AmSerialChart();
            chart.dataProvider = chartData;
            chart.categoryField = "team_num";
            chart.startDuration = 1;

            var categoryAxis = chart.categoryAxis;
            categoryAxis.labelRotation = 45;
            categoryAxis.gridPosition = "start";

            var valueAxis = new AmCharts.ValueAxis();
            valueAxis.stackType = "regular";
            valueAxis.gridAlpha = 0.1;
            valueAxis.axisAlpha = 0;
            chart.addValueAxis(valueAxis);


            // GRAPH
            

            graph = new AmCharts.AmGraph();
            graph.title = "Drive";
            graph.labelText = "[[value]]";
            graph.valueField = "drive";
            graph.type = "column";
            graph.lineAlpha = 0;
            graph.fillAlphas = 1;
            graph.balloonText = "<span style='color:#555555;'>[[title]]:[[value]]</span><br><span style='font-size:14px'><b>[[category]]</b></span>";
            chart.addGraph(graph);

            var graph = new AmCharts.AmGraph();
            graph.title = "Auto";
            graph.labelText = "[[value]]";
            graph.valueField = "auto";
            graph.type = "column";
            graph.lineAlpha = 0;
            graph.fillAlphas = 1;
            graph.balloonText = "<span style='color:#555555;'>[[title]]:[[value]]</span><br><span style='font-size:14px'><b>[[category]]</b></span>";
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

            var chartScrollbar = new AmCharts.ChartScrollbar();
            chart.addChartScrollbar(chartScrollbar);

            chart.categoryAxis.parseDates= false;

            // WRITE
            chart.write("chartdiv");
        });

    </script>
  </head>
  <body>
    <?php include("navbar.php") ?>
    <div id="top"></div>
    <div class="container">
      <h1><?php echo $name?></h1>
      <div id="space"></div>
      <div class="row">
        <div class="col-md-2"><span style="font-size:200%;">Sort by:</span></div>
        <div class="col-md-4"><a href="?order=sum" type="button" class="btn btn-lg btn-warning">Sum</a></div>
        <div class="col-md-3"><a href="?order=auto" type="button" class="btn btn-lg btn-warning">Auto</a></div>
        <div class="col-md-3"><a href="?order=drive" type="button" class="btn btn-lg btn-warning">Drive</a></div>
      </div>
      <div id="space"></div>

      <div id="chartdiv" style="width:100%; height:400px;"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>