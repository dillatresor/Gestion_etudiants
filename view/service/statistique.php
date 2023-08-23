<?php

session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

$bd= bd();
$servManag =new ServiceManager($bd);
$list=$servManag->liste();


?>

<?php
 include('../../include/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<body>
    
    <div class="container" id="container">
    <?php
      include('../../include/header.php');
    ?>
    <style>
        body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  background-color: #ffffff;
  margin: 0;
}

#chartdiv {
  max-height: 600px;
  height: 100vh;
}
    </style>
    <div class="mt-3 pull-right d-flex">  
        <i class="fa fa-user mr-3 user"> <span class="ml-2"> <?= $user["statut"];?> </span> </i>
        <button class="btn btn-info"> <a class="text-light" href="../../index.php"> Deconnexion </a> </button>
    </div>

        <div class="bienvenu">STATISTIQUES MENSUEL</div>
        <div class="global-content">
          <div class="contenu"> 
          <?php
             include('../../include/aside.php');
          ?>
          </div>
            <div>
            <?php
if(isset($_GET['IdService']) && isset($_GET['trie']))
{
 ?>
 <input hidden type="text" id="format" value="<?= $_GET['trie'] ?>">
 <input hidden type="number" id="service" value="<?= $_GET['IdService'] ?>">
 <?php   
}
?>

<div id="chartdiv"></div>
    </div>
      </div>
        <?php
             include('../../include/footer.php');
        ?>
    </div>
    <script src="../../font/js/jquery-3.3.1.min.js"></script>
    <script src="../../font/js/core.js"></script>
    <script src="../../font/js/charts.js"></script>
    <script src="../../font/js/animated.js"></script>
    <script>
        function mois(mois){
            var text;
            switch (parseInt(mois)) {
                case 1:
                    text="Janvier"; 
                    break;
                    case 2:
                        text="Février";
                break;
                case 3:
                    text="Mars";
                break;
                case 4:
                    text="Avril";
                break;
                case 5:
                    text="Mai";
                break;
                case 6:
                    text="Juin";
                break;
                case 7:
                    text="Juillet";
                break;
                case 8:
                    text="Aout";
                break;
                case 9:
                    text="Septembre";
                break;
                case 10:
                    text="Octobre";
                break;
                case 11:
                    text="Novembre";
                break;
                case 12:
                    text="Decembre";
                break;
            
            }
            return text;
        }
        $(function(){
            var format=$("#format");
            var service=$("#service");
            $.post("statistiqueAjax.php",{format:format.val(),service:service.val()}).done(function(data){
                var donne=JSON.parse(data);
                var tab=[];
                if(format.val()=="month"){
                    for (const key in donne) {
                    tab.push({
                        "country":mois(donne[key].mois),
                        "visits":parseInt(donne[key].nombre)
                    });
                }
                }if(format.val()=="year"){
                    for (const key in donne) {
                    tab.push({
                        "country":donne[key].annee,
                        "visits":parseInt(donne[key].nombre)
                    });
                }
                }
                console.log(tab);
                am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartdiv", am4charts.XYChart);

chart.data = tab;

chart.padding(40, 40, 40, 40);

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.minGridDistance = 60;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "country";
series.dataFields.valueY = "visits";
series.tooltipText = "{valueY.value}"
series.columns.template.strokeOpacity = 0;

chart.cursor = new am4charts.XYCursor();

// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function (fill, target) {
	return chart.colors.getIndex(target.dataItem.index);
});
            });
        });
    </script>
</body>
</html>