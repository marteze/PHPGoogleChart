<?php

namespace PHPGoogleChart;

/**
 * Classe responsavel por gerar um grafico de colunas utilizando a API do Google Charts.
 * Veja mais detalhes em https://developers.google.com/chart/interactive/docs/gallery/linechart .
 * @author Rafael Marteze
 * @example <pre>
 * $oGraficoTeste = new GoogleChartColumn("teste", 800, 400);
 * $oGraficoTeste->setTitulo("Quantidade de servidores na informatica");
 * $oGraficoTeste->setTituloEixoHorizontal("Ano", "#000", null, null, true);
 * $oGraficoTeste->setEixoHorizontal("#CCC", 7, "", 45);
 * $oGraficoTeste->setTituloEixoVertical("Quantidade", "#000", null, null, true);
 * $oGraficoTeste->addSerie("Ano");
 * $oGraficoTeste->addSerie("Desenvolvimento");
 * $oGraficoTeste->addSerie("Redes");
 * $oGraficoTeste->addSerie("Atendimento");
 * $oGraficoTeste->addDado(array(2010, 10, 2, 10));
 * $oGraficoTeste->addDado(array(2011, 9, 2, 11));
 * $oGraficoTeste->addDado(array(2012, 10, 3, 11));
 * $oGraficoTeste->addDado(array(2013, 8, 3, 15));
 * $oGraficoTeste->addDado(array(2014, 8, 4, 14));
 * $oGraficoTeste->addDado(array(2015, 5, 4, 15));
 * $oGraficoTeste->addDado(array(2016, 4, 5, 18));
 * echo $oGraficoTeste;
 */
class GoogleChartColumn extends GoogleChart 
{
	/**
	 * @see GoogleChartLine
	 * @param string $sId Id do grafico.
	 * @param number $iLargura Largura do grafico em pixels.
	 * @param number $iAltura Altura do grafico em pixels
	 */
	public function __construct($sId, $iLargura = 900, $iAltura = 500) 
	{
		parent::__construct($sId, $iLargura, $iAltura);
		$this->setClasseGoogleVisualization("ColumnChart");
	}
	
	/**
	 * Adiciona uma serie ao grafico de colunas. Lembre-se que a primeira serie deve ser obrigatoriamente a 
	 * lista de valores que aparecerao nos itens de descricao do eixo horizontal.
	 * @param string $sNome Nome da serie.
	 */
	public function addSerie($sNome, $sTipo = "number") 
	{
		$aColunas = $this->getColunas();
		
		if (count($aColunas) == 0) {
			$this->addColuna($sNome, $sTipo);
		} else {
			$this->addColuna($sNome, "number");
		}
	}
	
	/**
	 * Adiciona uma linha de dado do grafico. Deve ter a quantidade de itens identica a quantidade de series adicionadas.
	 * @param array $aDados Array de indice numerico com as informacoes das series.
	 */
	public function addDado($aDados) 
	{
		$this->aDados[] = $aDados;
	}
	
	/**
	 * Define o titulo e seu estilo.
	 * @param string $sTitulo Texto do titulo
	 * @param string $sTextoCor Cor do texto em formato HTML.
	 * @param string $sTextoFonteNome Nome da fonte.
	 * @param string $dTextoFonteTamanho Tamanho da fonte.
	 * @param boolean $bTextoNegrito Define se o texto sera negrito.
	 * @param boolean $bTextoItalico Define se o texto sera italico.
	 */
	public function setTitulo($sTitulo, $sTextoCor = "#000000", $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = true, $bTextoItalico = false) 
	{
		$this->setOpcao("title", $sTitulo);
		$this->setOpcao("titleTextStyle", array("color" => $sTextoCor, "fontName" => $sTextoFonteNome, "fontSize" => $dTextoFonteTamanho, "bold" => $bTextoNegrito, "italic" => $bTextoItalico));
	}
	
	/**
	 * Define o estilo do fundo do grafico todo.
	 * @param string $sCor Cor em formato HTML.
	 * @param string $iEspessuraBorda Espessura da borda em pixels.
	 * @param string $sCorBorda Cor da borda em formato HTML.
	 */
	public function setEstiloFundo($sCor, $iEspessuraBorda = null, $sCorBorda = null) 
	{
		$aParametros = array();
		$aParametros["fill"] = $sCor;
		$aParametros["stroke"] = $sCorBorda;
		$aParametros["strokeWidth"] = $iEspessuraBorda;
		
		$this->setOpcao("backgroundColor", $aParametros);
	}
	
	/**
	 * Define o estilo da area do desenho do grafico
	 * @param string $sCorFundo Cor em formato HTML.
	 * @param number $iEspessuraBorda Espessura da borda em pixels.
	 * @param string $iLeft Deslocamento para a esquerda do desenho.
	 * @param string $iTop Deslocamento para baixo do desenho.
	 * @param string $iLargura Largura do desenho.
	 * @param string $iAltura Altura do desenho.
	 */
	public function setEstiloAreaDesenho($sCorFundo, $iEspessuraBorda = 0, $iLeft = "auto", $iTop = "auto", $iLargura = "auto", $iAltura = "auto") 
	{
		$aParametros = array();
		$aParametros["backgroundColor"] = array("stroke" => $sCorFundo, "strokeWidth" => $iEspessuraBorda);
		$aParametros["left"] = $iLeft;
		$aParametros["top"] = $iTop;
		$aParametros["width"] = $iLargura;
		$aParametros["height"] = $iAltura;
		
		$this->setOpcao("chartArea", $aParametros);
	}
	
	/**
	 * Define o estilo da legenda do grafico.
	 * @param string $sAlinhamento Alinhamento da legenda. Pode ser: "start", "center" ou "end".
	 * @param string $sPosicao Posicao da legenda. Pode ser: "bottom", "labeled", "left", "none", "right" ou "top".
	 * @param number $iLinhasMaxima Quantidade maxima de linhas
	 * @param string $sTextoCor Cor do texto em formato HTML.
	 * @param string $sTextoFonteNome Nome da fonte.
	 * @param string $dTextoFonteTamanho Tamanho da fonte.
	 * @param string $bTextoNegrito Define se o texto sera negrito.
	 * @param string $bTextoItalico Define se o texto sera italico.
	 */
	public function setEstiloLegenda($sAlinhamento = "automatic", $sPosicao = "right", $iLinhasMaxima = 1, $sTextoCor = "#000000", $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = false, $bTextoItalico = false) 
	{
		$aParametros = array();
		$aParametros["alignment"] = $sAlinhamento;
		$aParametros["position"] = $sPosicao;
		$aParametros["maxLines"] = $iLinhasMaxima;
		$aParametros["textStyle"] = array("color" => $sTextoCor, "fontName" => $sTextoFonteNome, "fontSize" => $dTextoFonteTamanho, "bold" => $bTextoNegrito, "italic" => $bTextoItalico);
		
		$this->setOpcao("legend", $aParametros);
	}
	
	/**
	 * Define as cores das colunas que serao utilizadas.
	 * @param array $aCores Array de indice numero com a lista de cores em formato HTML.
	 */
	public function setCoresColunas($aCores) 
	{
		$this->setOpcao("colors", $aCores);
	}
	
	/**
	 * Define o tipo de curva padrao utilizada no grafico. 
	 * @param string $sTipo Tipo de curva. Aceita os valores: "none" e "function".
	 */
	public function setTipoCurva($sTipo) 
	{
		$this->setOpcao("curveType", $sTipo);
	}
	
	/**
	 * Define as informacoes e formatacao do eixo horizontal.
	 * @param string $sTitulo Titulo do eixo horizontal.
	 * @param string $sTextoCor Cor do texto.
	 * @param string $sTextoFonteNome Nome da fonte.
	 * @param float $dTextoFonteTamanho Tamanho da fonte.
	 * @param boolean $bTextoNegrito Define se o texto sera negrito.
	 * @param boolean $bTextoItalico Define se o texto sera italico.
	 */
	public function setTituloEixoHorizontal($sTitulo = "", $sTextoCor = "#000000", $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = false, $bTextoItalico = false) 
	{
		$aParametros = $this->getOpcao("hAxis");
		
		if (is_array($aParametros) == false) {
			$aParametros = array();
		}
		
		$aParametros["title"] = $sTitulo;
		$aParametros["titleTextStyle"] = array("color" => $sTextoCor, "fontName" => $sTextoFonteNome, "fontSize" => $dTextoFonteTamanho, "bold" => $bTextoNegrito, "italic" => $bTextoItalico);
		
		$this->setOpcao("hAxis", $aParametros);
	}
	
	/**
	 * Define as informacoes e formatacao do eixo vertical.
	 * @param string $sTitulo Titulo do eixo vertical.
	 * @param string $sTextoCor Cor do texto.
	 * @param string $sTextoFonteNome Nome da fonte.
	 * @param float $dTextoFonteTamanho Tamanho da fonte.
	 * @param boolean $bTextoNegrito Define se o texto sera negrito.
	 * @param boolean $bTextoItalico Define se o texto sera italico.
	 */
	public function setTituloEixoVertical($sTitulo = "", $sTextoCor = "#000000", $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = false, $bTextoItalico = false) 
	{
		$aParametros = $this->getOpcao("hAxis");
		
		if (is_array($aParametros) == false) {
			$aParametros = array();
		}
		
		$aParametros["title"] = $sTitulo;
		$aParametros["titleTextStyle"] = array("color" => $sTextoCor, "fontName" => $sTextoFonteNome, "fontSize" => $dTextoFonteTamanho, "bold" => $bTextoNegrito, "italic" => $bTextoItalico);
		
		$this->setOpcao("vAxis", $aParametros);
	}
	
	/**
	 * Define parametros adicionais do eixo horizontal.
	 * @param string $sLinhasGridCor Cor das linhas do grid de fundo.
	 * @param number $sLinhasGridQtd Quantidade de linhas no grid de fundo.
	 * @param string $sFormato Formato dos rotulos do eixo para valores numericos ou datas. Aceita os valores: "none", "decimal", "scientific", "currency", "percent", "short" ou "long".
	 * @param number $iTextoInclinacao Inclinacao do texto dos rotulos.
	 * @param string $sTextoPosicao Posicao do texto dos rotulos do eixo. Aceita os valores: "out", "in" ou "none".
	 * @param string $sTextoCor Cor do texto dos rotulos do eixo em formato HTML.
	 * @param string $sTextoFonteNome Nome da fonte do texto dos rotulos do eixo.
	 * @param string $dTextoFonteTamanho Tamanho do texto dos rotulos.
	 * @param boolean $bTextoNegrito Define se o texto dos rotulos sera negrito.
	 * @param boolean $bTextoItalico Define se o texto dos rotulos sera italico.
	 * @param string $iLinhaBase A linha de base do eixo.
	 * @param string $sLinhaBaseCor Cor da linha de base do eixo.
	 * @param number $iDirecao Define a direcao dos valores do eixo. Definir 1 para normal e -1 para reverso.
	 */
	public function setEixoHorizontal($sLinhasGridCor = "#CCC", $sLinhasGridQtd = null, $sFormato = null, $iTextoInclinacao = null, $sTextoPosicao = null, $sTextoCor = null, $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = null, $bTextoItalico = null, $iLinhaBase = null, $sLinhaBaseCor = null, $iDirecao = null) 
	{
		$aParametros = $this->getOpcao("hAxis");
		
		if (is_array($aParametros) == false) {
			$aParametros = array();
		}
		
		if (is_array($aParametros) == false) {
			$aParametros = array();
		}
		
		if ($iLinhaBase !== null) {
			$aParametros["baseline"] = $iLinhaBase;
		}
		
		if ($sLinhaBaseCor !== null) {
			$aParametros["baselineColor"] = $sLinhaBaseCor;
		}
		
		if ($iDirecao !== null) {
			$aParametros["direction"] = $iDirecao;
		}
		
		if ($sFormato !== null) {
			$aParametros["format"] = $sFormato;
		}
		
		if ($sLinhasGridCor !== null) {
			$aParametros["gridlines"]["color"] = $sLinhasGridCor;
		}
		
		if ($sLinhasGridQtd !== null) {
			$aParametros["gridlines"]["count"] = $sLinhasGridQtd;
		}
		
		if ($sTextoPosicao !== null) {
			$aParametros["textPosition"] = $sTextoPosicao;
		}
		
		$aParametrosTextStyle = array();
		
		if ($sTextoCor !== null) {
			$aParametrosTextStyle["color"] = $sTextoCor;
		}
		
		if ($sTextoFonteNome !== null) {
			$aParametrosTextStyle["fontName"] = $sTextoFonteNome;
		}
		
		if ($dTextoFonteTamanho !== null) {
			$aParametrosTextStyle["fontSize"] = $dTextoFonteTamanho;
		}
		
		if ($bTextoNegrito !== null) {
			$aParametrosTextStyle["bold"] = $bTextoNegrito == true;
		}
		
		if ($bTextoItalico !== null) {
			$aParametrosTextStyle["italic"] = $bTextoItalico == true;
		}
		
		if (count($aParametrosTextStyle) > 0) {
			$aParametros["textStyle"] = $aParametrosTextStyle;
		}
		
		if ($iTextoInclinacao !== null) {
			$aParametros["slantedText"] = true;
			$aParametros["slantedTextAngle"] = $iTextoInclinacao;
		} else {
			$aParametros["slantedText"] = false;
			$aParametros["slantedTextAngle"] = 30;
		}
		
		$this->setOpcao("hAxis", $aParametros);
	}
	
	/**
	 * Define parametros adicionais do eixo vertical.
	 * @param string $sLinhasGridCor Cor das linhas do grid de fundo.
	 * @param number $sLinhasGridQtd Quantidade de linhas no grid de fundo.
	 * @param string $sFormato Formato dos rotulos do eixo para valores numericos ou datas. Aceita os valores: "none", "decimal", "scientific", "currency", "percent", "short" ou "long".
	 * @param number $iTextoInclinacao Inclinacao do texto dos rotulos.
	 * @param string $sTextoPosicao Posicao do texto dos rotulos do eixo. Aceita os valores: "out", "in" ou "none".
	 * @param string $sTextoCor Cor do texto dos rotulos do eixo em formato HTML.
	 * @param string $sTextoFonteNome Nome da fonte do texto dos rotulos do eixo.
	 * @param string $dTextoFonteTamanho Tamanho do texto dos rotulos.
	 * @param boolean $bTextoNegrito Define se o texto dos rotulos sera negrito.
	 * @param boolean $bTextoItalico Define se o texto dos rotulos sera italico.
	 * @param string $iLinhaBase A linha de base do eixo.
	 * @param string $sLinhaBaseCor Cor da linha de base do eixo.
	 * @param number $iDirecao Define a direcao dos valores do eixo. Definir 1 para normal e -1 para reverso.
	 */
	public function setEixoVertical($sLinhasGridCor = "#CCC", $sLinhasGridQtd = null, $sFormato = null, $iTextoInclinacao = null, $sTextoPosicao = null, $sTextoCor = null, $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = null, $bTextoItalico = null, $iLinhaBase = null, $sLinhaBaseCor = null, $iDirecao = null) 
	{
		$aParametros = $this->getOpcao("vAxis");
		
		if (is_array($aParametros) == false) {
			$aParametros = array();
		}
		
		if (is_array($aParametros) == false) {
			$aParametros = array();
		}
		
		if ($iLinhaBase !== null) {
			$aParametros["baseline"] = $iLinhaBase;
		}
		
		if ($sLinhaBaseCor !== null) {
			$aParametros["baselineColor"] = $sLinhaBaseCor;
		}
		
		if ($iDirecao !== null) {
			$aParametros["direction"] = $iDirecao;
		}
		
		if ($sFormato !== null) {
			$aParametros["format"] = $sFormato;
		}
		
		if ($sLinhasGridCor !== null) {
			$aParametros["gridlines"]["color"] = $sLinhasGridCor;
		}
		
		if ($sLinhasGridQtd !== null) {
			$aParametros["gridlines"]["count"] = $sLinhasGridQtd;
		}
		
		if ($sTextoPosicao !== null) {
			$aParametros["textPosition"] = $sTextoPosicao;
		}
		
		$aParametrosTextStyle = array();
		
		if ($sTextoCor !== null) {
			$aParametrosTextStyle["color"] = $sTextoCor;
		}
		
		if ($sTextoFonteNome !== null) {
			$aParametrosTextStyle["fontName"] = $sTextoFonteNome;
		}
		
		if ($dTextoFonteTamanho !== null) {
			$aParametrosTextStyle["fontSize"] = $dTextoFonteTamanho;
		}
		
		if ($bTextoNegrito !== null) {
			$aParametrosTextStyle["bold"] = $bTextoNegrito == true;
		}
		
		if ($bTextoItalico !== null) {
			$aParametrosTextStyle["italic"] = $bTextoItalico == true;
		}
		
		if (count($aParametrosTextStyle) > 0) {
			$aParametros["textStyle"] = $aParametrosTextStyle;
		}
		
		if ($iTextoInclinacao !== null) {
			$aParametros["slantedText"] = true;
			$aParametros["slantedTextAngle"] = $iTextoInclinacao;
		} else {
			$aParametros["slantedText"] = false;
			$aParametros["slantedTextAngle"] = 30;
		}
		
		$this->setOpcao("vAxis", $aParametros);
	}
	
	/**
	 * Define se as barras serao empilhadas e o tipo de empilhamento
	 * @param string $sTipoEmpilhamento Tipo de empilhamento. Aceita os valores: false, true, "percent", "relative", "absolute".
	 */
	public function setEmpilhamento($sTipoEmpilhamento = true) 
	{
		$this->setOpcao("isStacked", $sTipoEmpilhamento);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see GoogleChart::gerarJsDados()
	 */
	protected function gerarJsDados() 
	{
		return json_encode($this->aDados);
	}
}

?>