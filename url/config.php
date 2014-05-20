<?php
	session_start();
	$db = mysql_connect("localhost", "root", "");
	$dados = mysql_select_db("videoaulas");
	
	function ShortURL($tamanho = 10, $maiusculas = true, $numeros = true){
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num  = '1234567890';
		$retorno = '';
		$caracteres = '';
		
		$caracteres .= $lmin;
		if($maiusculas) $caracteres .= $lmai;
		if($numeros) $caracteres .= $num;
		
		$len = strlen($caracteres);
		for($n = 1; $n <= $tamanho; $n++){
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		
		return $retorno;
	}
	
	$base = "http://127.0.0.1:8888/videoaulas/url/";
?>