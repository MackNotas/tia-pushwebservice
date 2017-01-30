<?php
//
//	URLS De chamadas
//

$urlTiaReq		=	"https://www3.mackenzie.com.br/tia/verifica.php";
$urlTiaRefer	=	"https://www3.mackenzie.com.br/tia/index.php";
$urlTiaNota		=	"https://www3.mackenzie.com.br/tia/notasChamada.php";
$urlTiaHorario	=	"https://www3.mackenzie.com.br/tia/horarChamada.php";
$urlTiaFalta	=	"https://www3.mackenzie.com.br/tia/faltasChamada.php";

//
//	Campos Obrigatorios de Login no TIA
//

$fieldTiaTIA	=	"alumat=";
$fieldTiaPASS	=	"pass=";
$fieldTiaUNI	=	"unidade=";

//
//	Outras Vars
//

$urlsLocal      =   ["tiulocal.noip.me", "127.0.0.1", "localhost"];
$userAgents 	=	["Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:42.0) Gecko/20100101 Firefox/42.0",
					 "Mozilla/5.0 (iPhone; CPU iPhone OS 9_0 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13A342 Safari/601.1",
					 "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36",
					 "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0",
					 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)"];
$userAgent		=	$userAgents[rand(0, count($userAgents) - 1)];

//
//	Gera um nome aleatorio para guardar os cookies a cada requisição no TIA
//

function getFileCookie() {

	$keysTable = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
		     	  'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f',
  		    	  'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
  		    	  'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

	$randomCookieKey = '';
	$keysTableSize = count($keysTable) - 1;

	for ($i=0; $i < 25; $i++) { 
		$randomCookieKey .= $keysTable[rand(0, $keysTableSize)];
	}

	return	"./cookie" . $randomCookieKey . ".txt";
}

//
//	Enums
//

abstract class TipoRequest {
    const reqNota		=	1;
    const reqHorario	=	2;
    const reqFalta		=	3;
    const reqLogin		=	4;
}

?>