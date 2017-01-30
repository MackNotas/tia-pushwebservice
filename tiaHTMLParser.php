<?php

class tiaHTMLParser {

	public function tiaParserNotaWithContentAndTia($content, $userTia) {
		//
		//	Iniciando leitura do HTML recebido
		//

		$doc = new DOMDocument();
		@$doc->loadHTML($content);
		$nodes = $doc->getElementById('tabela');
		$tbody = $doc->getElementsByTagName('tbody');
		$arrayMaterias = array();
		$arrayNotas = array();
		$arrayFormulas = array();
		$arrayTotal = array();
		$isFormulaTurn = FALSE;

		$rows = $doc->getElementsByTagName("tr");

		for ($i = 5, $posMat = 0, $posNotaXMat = 0, $posArrayTotalWFormulas = 0, $posArrayTotal = 0; $i < $rows->length; $i++) {
		    $cols = $rows->item($i)->getElementsbyTagName("td");
		    for ($j = 0, $posNota = 0, $posFormula = 0; $j < $cols->length; $j++) {

		    	//Pulando notas n1 e n2
	    		if ($j == 12 || $j == 13) { continue; }

				if ($j == 1 && !$isFormulaTurn) {
					$arrayMaterias[$posMat++] = $this->correctNomeMateria($cols->item($j)->textContent);
				}
				else if ($j > 1 && !$isFormulaTurn) {
					$arrayNotas[$posNota++] = $this->removeTrashFromString($cols->item($j)->textContent);
				}
				if ($j > 1 && $isFormulaTurn) {
					$arrayFormulas[$posFormula++] = $cols->item($j)->textContent;
				}

				if (!strcmp($cols->item($j)->textContent, "FÓRMULA")) {
					$isFormulaTurn = TRUE;
				}

				if ($j == $cols->length-1) {
					if (!$isFormulaTurn) {

						// Hot fix: Não mandar letras na SUB
						if (!empty($arrayNotas[10]) && !is_numeric($arrayNotas[10])) {
							$arrayNotas[10] = "";
						}

						$arrayTotal[$posArrayTotal] = ['nome' => $arrayMaterias[$posNotaXMat],
														'notas' => $arrayNotas,
														'formulas' => null,
														'tia' => $userTia];
					}
					elseif ($isFormulaTurn && $j > 1) {
						$arrayTotal[$posArrayTotalWFormulas++]['formulas'] = $arrayFormulas;
					}
					$posArrayTotal++;
					$posNotaXMat++;
					$arrayNotas = array();
				}
		    }
		}
		// header('Content-type: application/json');
		if (count($arrayTotal) == 0) {
			$arrayTotal[0] = ['nome' => null,
								'notas' => null,
								'formulas' => null,
								'tia' => -1];
		}
		return $arrayTotal;
	}

	public function correctNomeMateria($materiaNome) {
		return trim($materiaNome);
	}

	public function removeTrashFromString($string) {
		return preg_replace("@[\\r|\\n|\\t|\\/|\\\"|\\s]+@", "", $string);
	}

	public function tiaParserValidarLoginWithContent($content) {
		$doc = new DOMDocument();
		@$doc->loadHTML($content);

		$tiaENome = $doc->getElementsbyTagName('h2');

		if (strlen($tiaENome->item(0)->nodeValue) > 8) {
			$arr = array('login' => true);
		}
		else {
			$arr = array('login' => false);
		}

		return json_encode($arr);
	}
}

?>