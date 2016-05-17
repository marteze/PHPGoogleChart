<?php 
include_once '../classes/GoogleChart.php';
include_once '../classes/GoogleChartColumn.php';
include_once '../classes/GoogleChartLine.php';
include_once '../classes/GoogleChartPie.php';
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<title>PHPGoogleChart - Exemplos</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
</script>
</head>
<body>
<?php

$oGraficoTeste = new GoogleChartColumn("teste1", 800, 400);
$oGraficoTeste->setTitulo("Quantidade de servidores na informatica");
$oGraficoTeste->setTituloEixoHorizontal("Ano", "#000", null, null, true);
$oGraficoTeste->setEixoHorizontal("#CCC", 7, "", 45);
$oGraficoTeste->setTituloEixoVertical("Quantidade", "#000", null, null, true);
$oGraficoTeste->addSerie("Ano");
$oGraficoTeste->addSerie("Desenvolvimento");
$oGraficoTeste->addSerie("Redes");
$oGraficoTeste->addSerie("Atendimento");
$oGraficoTeste->addDado(array(2010, 10, 2, 10));
$oGraficoTeste->addDado(array(2011, 9, 2, 11));
$oGraficoTeste->addDado(array(2012, 10, 3, 11));
$oGraficoTeste->addDado(array(2013, 8, 3, 15));
$oGraficoTeste->addDado(array(2014, 8, 4, 14));
$oGraficoTeste->addDado(array(2015, 5, 4, 15));
$oGraficoTeste->addDado(array(2016, 4, 5, 18));
echo $oGraficoTeste;

$oGraficoTeste = new GoogleChartLine("teste2", 800, 400);
$oGraficoTeste->setTitulo("Quantidade de servidores na informatica");
$oGraficoTeste->setTituloEixoHorizontal("Ano", "#000", null, null, true);
$oGraficoTeste->setEixoHorizontal("#CCC", 7, "", 45);
$oGraficoTeste->setTituloEixoVertical("Quantidade", "#000", null, null, true);
$oGraficoTeste->addSerie("Ano");
$oGraficoTeste->addSerie("Desenvolvimento");
$oGraficoTeste->addSerie("Redes");
$oGraficoTeste->addSerie("Atendimento");
$oGraficoTeste->addDado(array(2010, 10, 2, 10));
$oGraficoTeste->addDado(array(2011, 9, 2, 11));
$oGraficoTeste->addDado(array(2012, 10, 3, 11));
$oGraficoTeste->addDado(array(2013, 8, 3, 15));
$oGraficoTeste->addDado(array(2014, 8, 4, 14));
$oGraficoTeste->addDado(array(2015, 5, 4, 15));
$oGraficoTeste->addDado(array(2016, 4, 5, 18));
echo $oGraficoTeste;

$oGraficoTeste = new GoogleChartPie("teste3", 800, 300);
$oGraficoTeste->setTitulo("Quantidade de servidores na informatica");
$oGraficoTeste->setRotulos("Area", "Quantidade");
$oGraficoTeste->addDado("Desenvolvimento", 10);
$oGraficoTeste->addDado("Redes", 4, 0.2);
$oGraficoTeste->addDado("Atendimento", 14.5);
echo $oGraficoTeste;

?>
</body>
</html>
