<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPGoogleChart\GoogleCharPie;
 
class GoogleCharPieTest extends PHPUnit_Framework_TestCase 
{
  public function testGerarJsDados()
  {
    $oGoogleChartPie = new PHPGoogleChart\GoogleChartPie("teste");
    $this->assertStringStartsWith("<div id=", $oGoogleChartPie->gerarHtml());
  }
}