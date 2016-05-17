<?php
/**
 * Classe abstrata com comportamentos padrao para geracao de graficos Google Charts.
 * Veja mais detalhes em https://developers.google.com/chart .
 * @author Rafael Marteze
 */
abstract class GoogleChart {
	static protected $bCriouEventoRezise = false;
	
	protected $sId = "";
	protected $iLargura = 900;
	protected $sUnidadeLargura = "px";
	protected $iAltura = 500;
	protected $sUnidadeAltura = "px";
	protected $aColunas = array();
	protected $aOpcoes = array();
	protected $aDados = array();
	protected $sClasseGoogleVisualization = "";
	
	/**
	 * @see GoogleChart
	 * @param string $sId Id do grafico.
	 * @param number $iLargura Largura do grafico em pixels.
	 * @param number $iAltura Altura do grafico em pixels
	 */
	public function __construct($sId, $iLargura = 900, $iAltura = 500) {
		$this->setId($sId);
		$this->setLargura($iLargura);
		$this->setAltura($iAltura);
	}
	
	/**
	 * Metodo responsavel por gerar os dados do grafico no formato aceito como parametro pelo metodo "addRows" da classe "google.visualization.DataTable".
	 * @example <pre>
	 * protected function gerarJsDados() {
	 * 	$sRetornoJs  = "[";
	 * 	$sRetornoJs .= "['Mushrooms', 3],";
	 * 	$sRetornoJs .= "['Onions', 1],";
	 * 	$sRetornoJs .= "['Olives', 1],";
	 * 	$sRetornoJs .= "['Zucchini', 1],";
	 * 	$sRetornoJs .= "['Pepperoni', 2]";
	 * 	$sRetornoJs .= "]";
	 *
	 * 	return $sRetornoJs;
	 * }
	 */
	abstract protected function gerarJsDados();
	
	/**
	 * Define o Id do grafico.
	 * @param string $sId
	 */
	public function setId($sId) {
		$this->sId = $sId;
	}
	
	/**
	 * Pega o Id do grafico.
	 * @return string
	 */
	public function getId() {
		return $this->sId;
	}
	
	/**
	 * Define o nome da classe dentro do "google.visualization" que ira gerar o grafico.
	 * @param string $sClasseGoogleVisualization
	 */
	public function setClasseGoogleVisualization($sClasseGoogleVisualization) {
		$this->sClasseGoogleVisualization = $sClasseGoogleVisualization;
	}
	
	/**
	 * Pega o nome da classe dentro do "google.visualization" que ira gerar o grafico.
	 * @return string
	 */
	public function getClasseGoogleVisualization() {
		return $this->sClasseGoogleVisualization;
	}
	
	/**
	 * Define a largura do grafico.
	 * @param integer $iLargura Largura do grafico em pixels.
	 */
	public function setLargura($iLargura, $sUnidade = "px") {
		$this->iLargura = $iLargura;
		$this->sUnidadeLargura = $sUnidade;
	}
	
	/**
	 * Pega a largura do grafico.
	 * @return integer
	 */
	public function getLargura() {
		return $this->iLargura;
	}
	
	public function getUnidadeLargura() {
		return $this->sUnidadeLargura;
	}
	
	/**
	 * Define a altura do grafico.
	 * @param integer $iAltura Altura do grafico em pixels.
	 */
	public function setAltura($iAltura, $sUnidade = "px") {
		$this->iAltura = $iAltura;
		$this->sUnidadeAltura = $sUnidade;
	}
	
	/**
	 * Pega a altura do grafico.
	 * @return integer
	 */
	public function getAltura() {
		return $this->iAltura;
	}
	
	public function getUnidadeAltura() {
		return $this->sUnidadeAltura;
	}
	
	/**
	 * Define o valor de uma das opcoes do grafico.
	 * @param string $sNome Nome da opcao.
	 * @param mixed $mValor Valor da opcao.
	 */
	protected function setOpcao($sNome, $mValor) {
		$this->aOpcoes[$sNome] = $mValor;
	}
	
	/**
	 * Pega o valor de uma opcao.
	 * @param string $sNome Nome da opcao.
	 * @return multitype:
	 */
	protected function getOpcao($sNome) {
		return $this->aOpcoes[$sNome];
	}
	
	/**
	 * Pega a lista de opcoes ja definidas.
	 * @return array
	 */
	protected function getOpcoes() {
		return $this->aOpcoes;
	}
	
	/**
	 * Adiciona um item as opcoes do grafico.
	 * @param string $sNome Nome da opcao.
	 * @param mixed $mValor Valor da opcao.
	 */
	protected function addColuna($sNome, $sTipo) {
		$this->aColunas[$sNome] = $sTipo;
	}
	
	/**
	 * Pega o nome das colunas dos dados do grafico.
	 * @return array
	 */
	protected function getColunas() {
		return $this->aColunas;
	}
	
	/**
	 * Gera o trecho do javascript que define o valor das opcoes. 
	 * @return string
	 */
	protected function gerarJsOpcoes() {
		return json_encode($this->getOpcoes());
	}
	
	/**
	 * Gera o trecho do javascript que define as colunas do grafico.
	 * @return string
	 */
	protected function gerarJsColunas() {
		$sJsRetorno = "";
		
		foreach($this->getColunas() as $sNome => $sTipo) {
			$sJsRetorno .= "  data.addColumn('" . $sTipo . "', '" . $sNome . "');\n";
		}
		
		return $sJsRetorno;
	}
	
	/**
	 * Gera trecho de javascript responsavel por gerar o grafico.
	 * @return string
	 */
	public function gerarJavascript() {
		$sHtml = "";
		
		if (self::$bCriouEventoRezise == false) {
			$sHtml .= "$(window).resize(function() {\n";
			$sHtml .= "  if(this.resizeTO) clearTimeout(this.resizeTO);\n";
			$sHtml .= "  this.resizeTO = setTimeout(function() {\n";
			$sHtml .= "    $(this).trigger('resizeEnd');\n";
			$sHtml .= "  }, 500);\n";
			$sHtml .= "});\n";
			
			self::$bCriouEventoRezise = true;
		}
		
		$sHtml .= "google.charts.setOnLoadCallback(draw_chart_" . $this->getId() . ");\n";
		$sHtml .= "function draw_chart_" . $this->getId() . "() {\n";
		$sHtml .= "  var data = new google.visualization.DataTable();\n";
		$sHtml .= $this->gerarJsColunas();
		$sHtml .= "  data.addRows(" . $this->gerarJsDados() . ");\n";
		$sHtml .= "  var options = " . $this->gerarJsOpcoes() . ";\n";
		$sHtml .= "  var chart = new google.visualization.". $this->getClasseGoogleVisualization() . "(document.getElementById('" . $this->getId() . "'));\n";
		$sHtml .= "  chart.draw(data, options);\n";
		$sHtml .= "}\n";
		$sHtml .= "$(window).on('resizeEnd', function() {\n";
		$sHtml .= "  draw_chart_" . $this->getId() . "();\n";
		$sHtml .= "});\n";
		
		return $sHtml;
	}
	
	/**
	 * Gera trecho de html onde sera exibido o grafico.
	 * @return string
	 */
	public function gerarHtml() {
		$sHtml = "<div id=\"" . $this->getId() . "\" style=\"width: " .$this->getLargura() . $this->getUnidadeLargura() . "; height: " . $this->getAltura() . $this->getUnidadeAltura() . ";\"></div>";
		
		return $sHtml;
	}
	
	/**
	 * Gerao codigo javascript e HTML do grafico.
	 * @return string
	 */
	public function __toString() {
		$sHtml  = "<script type=\"text/javascript\">\n";
		$sHtml .= $this->gerarJavascript();
		$sHtml .= "</script>\n";
		$sHtml .= $this->gerarHtml();
		
		return $sHtml;
	}
}
?>