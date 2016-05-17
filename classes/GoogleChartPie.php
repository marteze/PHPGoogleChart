<?php
/**
 * Classe responsavel por gerar um grafico de pizza utilizando a API do Google Charts.
 * Veja mais detalhes em https://developers.google.com/chart/interactive/docs/gallery/piechart .
 * @author Rafael Marteze
 * @example <pre>
 * $oGraficoTeste = new GoogleChartPie("teste", 800, 300);
 * $oGraficoTeste->setTitulo("Quantidade de servidores na informatica");
 * $oGraficoTeste->setRotulos("Area", "Quantidade");
 * $oGraficoTeste->addDado("Desenvolvimento", 10);
 * $oGraficoTeste->addDado("Redes", 4, 0.2);
 * $oGraficoTeste->addDado("Atendimento", 14.5);
 * echo $oGraficoTeste;
 */
class GoogleChartPie extends GoogleChart {
	/**
	 * @see GoogleChartPie
	 * @param string $sId Id do grafico.
	 * @param number $iLargura Largura do grafico em pixels.
	 * @param number $iAltura Altura do grafico em pixels
	 */
	public function __construct($sId, $iLargura = 900, $iAltura = 500) {
		parent::__construct($sId, $iLargura, $iAltura);
		$this->setClasseGoogleVisualization("PieChart");
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
	public function setTitulo($sTitulo, $sTextoCor = "#000000", $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = true, $bTextoItalico = false) {
		$this->setOpcao("title", $sTitulo);
		$this->setOpcao("titleTextStyle", array("color" => $sTextoCor, "fontName" => $sTextoFonteNome, "fontSize" => $dTextoFonteTamanho, "bold" => $bTextoNegrito, "italic" => $bTextoItalico));
	}
	
	/**
	 * Define os rotulos ao grafico
	 * @param string $sRotuloDescritivo Rotulo descritivo dos pedacos. Por exemplo: "Area", "Tipo", "Nome" etc.
	 * @param string $sRotuloQuantitativo Rotulo quantitativo dos pedacos. Por exemplo: "Quantidade", "Total", "Atendimentos" etc.
	 */
	public function setRotulos($sRotuloDescritivo, $sRotuloQuantitativo) {
		$this->addColuna($sRotuloDescritivo, "string");
		$this->addColuna($sRotuloQuantitativo, "number");
	}
	
	/**
	 * Define se o grafico sera 3D.
	 * @param boolean $b3D
	 */
	public function set3D($b3D = true) {
		$this->setOpcao("is3D", $b3D == true);
	}
	
	/**
	 * Define o estilo do fundo do grafico todo.
	 * @param string $sCor Cor em formato HTML.
	 * @param string $iEspessuraBorda Espessura da borda em pixels.
	 * @param string $sCorBorda Cor da borda em formato HTML.
	 */
	public function setEstiloFundo($sCor, $iEspessuraBorda = null, $sCorBorda = null) {
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
	public function setEstiloAreaDesenho($sCorFundo, $iEspessuraBorda = 0, $iLeft = "auto", $iTop = "auto", $iLargura = "auto", $iAltura = "auto") {
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
	public function setEstiloLegenda($sAlinhamento = "automatic", $sPosicao = "right", $iLinhasMaxima = 1, $sTextoCor = "#000000", $sTextoFonteNome = null, $dTextoFonteTamanho = null, $bTextoNegrito = false, $bTextoItalico = false) {
		$aParametros = array();
		$aParametros["alignment"] = $sAlinhamento;
		$aParametros["position"] = $sPosicao;
		$aParametros["maxLines"] = $iLinhasMaxima;
		$aParametros["textStyle"] = array("color" => $sTextoCor, "fontName" => $sTextoFonteNome, "fontSize" => $dTextoFonteTamanho, "bold" => $bTextoNegrito, "italic" => $bTextoItalico);
		
		$this->setOpcao("legend", $aParametros);
	}
	
	/**
	 * Define as cores dos pedacos que serao utilizadas.
	 * @param array $aCores Array de indice numero com a lista de cores em formato HTML.
	 */
	public function setCoresPedacos($aCores) {
		$this->setOpcao("colors", $aCores);
	}
	
	/**
	 * Define o tamanho do buraco que tera no meio do desenho.
	 * @param float $dTamanho Tamanho do buraco entre 0 e 1 que eh o numero de vezes o tamanho do raio do desenho.
	 */
	public function setTamanhoBuraco($dTamanho) {
		$this->setOpcao("pieHole", $dTamanho);
	}
	
	/**
	 * Define o estilo do texto que aparece sobre os pedacos da pizza.
	 * @param string $sCor Cor do texto em formato HTML.
	 * @param string $sFonteNome Nome da fonte.
	 * @param integer $iFonteTamanho Tamanho da fonte.
	 */
	public function setEstiloTextoPedacos($sCor, $sFonteNome, $iFonteTamanho) {
		$aParametros = array();
		$aParametros["color"] = $sCor;
		$aParametros["fontName"] = $sFonteNome;
		$aParametros["fontSize"] = $iFonteTamanho;
		
		$this->setOpcao("pieSliceTextStyle", $aParametros);
	}
	
	/**
	 * Adiciona um dado que sera utilizado na geracao do grafico.
	 * @param string $sNome Nome do pedaco da pizza.
	 * @param float $dValor Valor do pedaco da pizza.
	 * @param number $dAfastamento Afastamento do pedaco da pizza em relacao ao centro do grafico. Valor entre 0 e 1 que eh o numero de vezes o tamanho do raio do desenho.
	 * @param string $sCor Cor do texto em formato HTML.
	 */
	public function addDado($sNome, $dValor, $dAfastamento = 0, $sCor = null) {
		$this->aDados[] = array($sNome, $dValor);
		
		if (($sCor != null) || ($dAfastamento != 0)) {
			$aSlices = $this->getOpcao("slices");
			
			if (is_array($aSlices) == false) {
				$aSlices = array();
			}
			
			$aSlices[count($this->aDados) - 1] = array("color" => $sCor, "offset" => $dAfastamento);
			
			$this->setOpcao("slices", $aSlices);
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see GoogleChart::gerarJsDados()
	 */
	protected function gerarJsDados() {
		return json_encode($this->aDados);
	}
}

?>