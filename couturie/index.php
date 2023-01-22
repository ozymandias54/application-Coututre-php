<?php
session_start();
if(empty($_SESSION['idu'])){
    header('location:../index.php');
}
include '../connect/connect.php';
include '../fonction/requeteCaisse.php';
include '../fonction/requeteCommande.php';
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrateur</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Accueil</h1>
            <a href="commande.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Nouvelle commande</a>
        </div>
        <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Benefice Total</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">F CFA <?php echo ''. benefice(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Benefice du jour</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">F CFA <?php echo ''. beneficeJour(date("Y-m-d")); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-location-arrow  fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Commande Totale</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ''. cmdTotal(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-align-center fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Commande en cours</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ''. cmdEnCours(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
        
        </div>
        <style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<!-- Resources -->

<script src="../theme/messcript/xy.js"></script>
<script src="../theme/messcript/index.js"></script>
<script src="../theme/messcript/animed.js"></script>
<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX:true
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
xRenderer.labels.template.setAll({
  rotation: -90,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  maxDeviation: 0.3,
  categoryField: "country",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0.3,
  renderer: am5xy.AxisRendererY.new(root, {})
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  sequencedInterpolation: true,
  categoryXField: "country",
  tooltip: am5.Tooltip.new(root, {
    labelText:"{valueY}"
  })
}));

series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
series.columns.template.adapters.add("fill", function(fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", function(stroke, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});


// Set data
var data = [
    <?php
        $st= statistisque();
        foreach ($st as $value) {
            echo '{
            country: "'.$value['date'].'",
            value: '.$value['montant'].'
                },';
}
    ?>
  ];

xAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>

<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Encaissement par jours</h6>
</div>
<div id="chartdiv"></div>
        <script >
            var menu=document.getElementById('menuA');
            menu.setAttribute("class","nav-item active");
            
        </script>
        <?php
        include './foot.php';
        ?>

    </body>
</html>
