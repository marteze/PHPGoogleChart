<?php

namespace PHPGoogleChart;

/**
 * Classe responsavel por gerar um grafico de linhas utilizando a API do Google Charts.
 * Veja mais detalhes em https://developers.google.com/chart/interactive/docs/gallery/linechart .
 * @author Rafael Marteze
 * @example <pre>
 * $oGraficoTeste = new GoogleChartLine("teste", 800, 400);
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
class GoogleChartLine extends GoogleChart 
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
		$this->setClasseGoogleVisualization("LineChart");
	}
	
	/**
	 * Adiciona uma serie ao grafico de linhas. Lembre-se que a primeira serie deve ser obrigatoriamente a 
	 * lista de valores que aparecerao nos itens de descricao do eixo horizontal.
	 * @param string $sNome Nome da serie.
	 * @param string $sTipo Tipo de dados da serie. Aplicavel somente para o primeiro item da serie, o restante utiliza-se o tipo "number" de forma independente. Valores aceitos: "number", "string", "date", "datetime" ou "timeofday".
	 * @param string $sCor Cor da linha em formato HTML.
	 * @param string $sTipoCurva Tipo da curva. Aceita os valores: "none" e "function".
	 * @param string $sRotuloNaLegenda Texto que aparecera na legenda no lugar do nome da serie.
	 * @param integer $iLinhaTracejada Define o tracejado da linha. Defina como "0" para linha continua.
	 * @param integer $iLinhaEspessura Espessura da linha em pixels.
	 * @param string $sPontoFormato Formato dos pontos da serie. Aceita os valores: "circle", "triangle", "square", "diamond", "star" ou "polygon".
	 * @param integer $iPontoTamanho Tamanho dos pontos da serie.
	 * @param boolean $bPontosVisiveis Pontos sempre visiveis na serie.
	 * @param boolean $bVisivelNaLegenda Define se a serie aparecera na legenda.
	 * @param string $bExibirLinhaTendencia Defe se deve exibir a linha de tendencia.
	 * @param string $sLinhaTendenciaTipo Tipo da linha de tendencia. Aceita os valores: "linear", "exponential" ou "polynomial"
	 * @param number $iLinhaTendenciaGrau Grau do polinomio utilizado para calcular a tendencia. Aplicavel somente quando tipo de tendencia eh "polynomial".
	 * @param string $bLinhaTendenciaVisivelNaLegenda Define se a linha de tendencia sera visivel na legenda.
	 * @param string $sLinhaTendenciaLegenda Define o texto da linha de tendencia na legenda.
	 * @param number $iLinhaTendenciaEspessura Espessura da linha de tendencia.
	 * @param real $dLinhaTendenciaOpacidade Opacidade da linha de tendencia. Numero entre 0 e 1 representando o percentual de opacidade.
	 * @param string $sLinhaTendenciaCor Cor da linha de tendencia em formato HTML.
	 * @param number $iLinhaTendenciaPontoTamanho Tamanho dos pontos da linha de tendencia.
	 * @param boolean $bLinhaTendenciaPontosVisiveis Define se os pontos da linha de tendencia estarao sempre visiveis.
	 * @param boolean $bLinhaTendenciaMostrarCoeficienteDeterminacao Define se sera exibido o coeficiente de determinacao da linha de tendencia. 
	 */
	public function addSerie($sNome, $sTipo = "number", $sCor = null, $sTipoCurva = null, $sRotuloNaLegenda = null, $iLinhaTracejada = null, $iLinhaEspessura = null, $sPontoFormato = null, $iPontoTamanho = null, $bPontosVisiveis = null, $bVisivelNaLegenda = null, $bExibirLinhaTendencia = false, $sLinhaTendenciaTipo = "linear", $iLinhaTendenciaGrau = 3, $bLinhaTendenciaVisivelNaLegenda = false, $sLinhaTendenciaLegenda = null, $iLinhaTendenciaEspessura = 2, $dLinhaTendenciaOpacidade = 0.3, $sLinhaTendenciaCor = null, $iLinhaTendenciaPontoTamanho = 1, $bLinhaTendenciaPontosVisiveis = false, $bLinhaTendenciaMostrarCoeficienteDeterminacao = false) 
	{
		$aColunas = $this->getColunas();
		
		if (count($aColunas) == 0) {
			$this->addColuna($sNome, $sTipo);
		} else {
			$this->addColuna($sNome, "number");
		}
		
		// Define os parametros da serie
		
		$aParametrosSerie = array();
		
		if ($sCor !== null) {
			$aParametrosSerie["color"] = $sCor;
		}
		
		if ($sTipoCurva !== null) {
			$aParametrosSerie["curveType"] = $sTipoCurva;
		}
		
		if ($sRotuloNaLegenda !== null) {
			$aParametrosSerie["labelInLegend"] = $sRotuloNaLegenda;
		}
		
		if ($iLinhaTracejada !== null) {
			$aParametrosSerie["lineDashStyle"] = array(round($iLinhaTracejada), round($iLinhaTracejada));
		}
		
		if ($iLinhaEspessura !== null) {
			$aParametrosSerie["lineWidth"] = round($iLinhaEspessura);
		}
		
		if ($sPontoFormato !== null) {
			$aParametrosSerie["pointShape"] = $sPontoFormato;
		}
		
		if ($iPontoTamanho !== null) {
			$aParametrosSerie["pointSize"] = round($iPontoTamanho);
		}
		
		if ($bPontosVisiveis !== null) {
			$aParametrosSerie["pointsVisible"] = $bPontosVisiveis == true;
		}
		
		if ($bVisivelNaLegenda !== null) {
			$aParametrosSerie["visibleInLegend"] = $bVisivelNaLegenda == true;
		}
		
		if (count($aParametrosSerie) > 0) {
			$aColunas = $this->getColunas();
			$iNumeroSerie = count($aColunas) - 2;
			
			$aSeries = $this->getOpcao("series");
			
			if (is_array($aSeries) == false) {
				$aSeries = array();
			}
			
			$aSeries[$iNumeroSerie] = $aParametrosSerie;
			
			if ($iNumeroSerie >= 0) {
				$this->setOpcao("series", $aSeries);
			}
		}
		
		// Define os parametros da linha de tendencia
		
		$aParametrosTendencia = array();
		
		if ($sLinhaTendenciaCor !== null) {
			$aParametrosTendencia["color"] = $sLinhaTendenciaCor;
		}
		
		if ($iLinhaTendenciaGrau !== null) {
			$aParametrosTendencia["degree"] = $iLinhaTendenciaGrau;
		}
		
		if ($sLinhaTendenciaLegenda !== null) {
			$aParametrosTendencia["labelInLegend"] = $sLinhaTendenciaLegenda;
		}
		
		if ($iLinhaTendenciaEspessura !== null) {
			$aParametrosTendencia["lineWidth"] = $iLinhaTendenciaEspessura;
		}
		
		if ($dLinhaTendenciaOpacidade !== null) {
			$aParametrosTendencia["opacity"] = $dLinhaTendenciaOpacidade;
		}
		
		if ($iLinhaTendenciaPontoTamanho !== null) {
			$aParametrosTendencia["pointSize"] = $iLinhaTendenciaPontoTamanho;
		}
		
		if ($bLinhaTendenciaPontosVisiveis !== null) {
			$aParametrosTendencia["pointsVisible"] = $bLinhaTendenciaPontosVisiveis == true;
		}
		
		if ($bLinhaTendenciaMostrarCoeficienteDeterminacao !== null) {
			$aParametrosTendencia["showR2"] = $bLinhaTendenciaMostrarCoeficienteDeterminacao;
		}
		
		if ($sLinhaTendenciaTipo !== null) {
			$aParametrosTendencia["type"] = $sLinhaTendenciaTipo;
		}
		
		if ($bLinhaTendenciaVisivelNaLegenda !== null) {
			$aParametrosTendencia["visibleInLegend"] = $bLinhaTendenciaVisivelNaLegenda;
		}
		
		if ($bExibirLinhaTendencia == true) {
			$aColunas = $this->getColunas();
			$iNumeroSerie = count($aColunas) - 2;
				
			$aTrendlines = $this->getOpcao("trendlines");
				
			if (is_array($aTrendlines) == false) {
				$aTrendlines = array();
			}
			
			$aTrendlines[$iNumeroSerie] = $aParametrosTendencia;
			
			if ($iNumeroSerie >= 0) {
				$this->setOpcao("trendlines", $aTrendlines);
			}
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
	 * Define as cores das linhas que serao utilizadas.
	 * @param array $aCores Array de indice numero com a lista de cores em formato HTML.
	 */
	public function setCoresLinhas($aCores) 
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
	 * Define o formato padrao dos pontos das series. 
	 * @param string $sFormato Formato dos pontos. Aceita os valores: "circle", "triangle", "square", "diamond", "star" ou "polygon".
	 */
	public function setFormatoPonto($sFormato) 
	{
		$this->setOpcao("pointShape", $sFormato);
	}
	
	/**
	 * Define o tamanho padrao dos pontos das series.
	 * @param integer $iTamanho Tamanho dos pontos.
	 */
	public function setTamanhoPonto($iTamanho) 
	{
		$this->setOpcao("pointSize", $iTamanho);
	}
	
	/**
	 * Define a espessura padrao das linhas das series.
	 * @param integer $iEspessura Espessura das linhas em pixels.
	 */
	public function setEspessuraLinha($iEspessura) 
	{
		$this->setOpcao("lineWidth", $iEspessura);
	}
	
	/**
	 * Define o tracejado padrao das linhas das series.
	 * @param number $iTamanhoTraco Tamanho do traco. Defina como "0" para linha continua.
	 */
	public function setLinhaTracejada($iTamanhoTraco = 4) 
	{
		$this->setOpcao("lineDashStyle", array($iTamanhoTraco, $iTamanhoTraco));
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