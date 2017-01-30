<?php

class tiaLogin {
	public function tiaMultiLoginWithTiaPassUnidadeTipo($userTia, $userPass, $userUnidade) {
		//
		// Isso provavelmente está errado, eu não deveria ficar importando em cada função.
		//
		include_once "vars.php";
		include_once "tiaHTMLParser.php";

		$isLocal 	= array_key_exists('HTTP_HOST', $_SERVER) 	? in_array($_SERVER['HTTP_HOST'], $urlsLocal) : false;

		$jsons_parsed = [];
		for ($i = 0; $i < count($userTia); $i++) { 
		
			$tokenCurl = curl_init($urlTiaRefer);
			curl_setopt($tokenCurl, CURLOPT_COOKIEJAR, getFileCookie());
			curl_setopt($tokenCurl, CURLOPT_USERAGENT, $userAgent);
			curl_setopt($tokenCurl, CURLOPT_URL, $urlTiaRefer);
			curl_setopt($tokenCurl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($tokenCurl, CURLOPT_AUTOREFERER, TRUE);
			curl_setopt($tokenCurl, CURLOPT_FOLLOWLOCATION, FALSE);

			if ($isLocal) {
				curl_setopt($tokenCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($tokenCurl, CURLOPT_SSL_VERIFYHOST, 2);
			}
			
			$tokenContent = curl_exec($tokenCurl);
			$doc = new DOMDocument();
			@$doc->loadHTML($tokenContent);

			$tokenValue = [];

			$inputs = $doc->getElementsByTagName("input");
			foreach($inputs as $node) {
				foreach($node->attributes as $attribute) {
				    if($attribute->nodeName == 'name' && $attribute->nodeValue == 'token') {
				        $tokenValue = $node->getAttribute('value');
				    }
				}
			}
			curl_close($tokenCurl);

			//
			//	Token inválido? Não existe mais?
			//
			if (!$tokenValue) {
				continue;
			}

//=============================================================================================================================
//												INICIALIZA A REQUEST DE LOGIN NO TIA
//=============================================================================================================================

			$ch = curl_init($urlTiaReq);

			// Enable HTTP POST
			curl_setopt($ch, CURLOPT_POST, TRUE);


			// Set POST parameters
		
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->userLoginToStringWithTiaPassUnidade($userTia[$i], $userPass[$i], $userUnidade[$i]));
			curl_setopt($ch, CURLOPT_REFERER, $urlTiaRefer);

			// Imitate classic browser's behavior - handle cookies
			curl_setopt($ch, CURLOPT_COOKIEFILE, getFileCookie());
			curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);

			if ($isLocal) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			}

			//
			//	Login
			//
			curl_exec($ch);

			//
			//	Vars
			//
			$tiaParser = new tiaHTMLParser();
			$json_response_parsed;

			//
			//	Faz a requisição no TIA de acordo com a o reqTipo escolhido pelo usuario (nota, faltas etc...) e joga pro tiaHTMLParser
			//
			curl_setopt($ch, CURLOPT_URL, $urlTiaNota);
			ob_start();
			$content = curl_exec($ch);
			$jsons_parsed[$i] = $tiaParser->tiaParserNotaWithContentAndTia($content, $userTia[$i]);
			// curl_close($ch);
		}
		return json_encode($jsons_parsed);
	}

	private function userLoginToStringWithTiaPassUnidade($userTia, $userPass, $userUnidade) {

		$fieldTiaTIA	=	"alumat=";
		$fieldTiaPASS	=	"pass=";
		$fieldTiaUNI	=	"unidade=";
		$stringLogin;

		return $stringLogin = $fieldTiaTIA . $userTia . "&" . $fieldTiaPASS . $userPass . "&" . $fieldTiaUNI . $userUnidade;
	}
}
?>