<?php
	include_once("config.php");
	if(isset($_GET["urlCURTO"])){
		$url = $_GET["urlCURTO"];
		$sql = mysql_query("select * from shorturl WHERE sURL = '$url'");
		$ln = mysql_fetch_array($sql);
		header("Location: " . $ln["url"]);	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<base href="<?php echo $base; ?>" target="_parent" />
</head>

<body>
	<form action="index.php" method="post">
    	<label style="display:block;"><span>Título:</span>
        	<input type="text" name="titulo" />
        </label>
        	<br />
        <label style="display:block;"><span>URL:</span>
        	<input type="text" name="URL" />
        </label>
        
        <input type="hidden" name="acao" value="enviar" />
        <input type="submit" name="btn" value="GERAR URL" />
    </form>
    
    <?php
    	if(isset($_GET["acao"]) && $_GET["acao"] == "URLCURTO" && isset($_SESSION["urlCurto"])){
	?>
    	<div id="url" style="font-family:verdana; color:#09f; font-weight:bold;"><?php echo $base . $_SESSION["urlCurto"]; ?></div>
    <?php unset($_SESSION["urlCurto"]);}?>
    
    <?php
    	if(isset($_POST["acao"]) && $_POST["acao"] == "enviar"){
			$titulo = $_POST["titulo"];
			$url = $_POST["URL"];
			
			if($titulo and $url != ""){
				
				if(!strstr($url, "http://")){
					$http = "http://";
					$novoURL = $http.$url;
				}elseif(strstr($url, "http://")){
					$novoURL = $url;	
				}else{
					$novoURL = "#";	
				}
				
				$geraURL = ShortURL(5);
				$sql = mysql_query("INSERT INTO shorturl(titulo, url, sURL) VALUES('$titulo', '$novoURL', '$geraURL')");
				$_SESSION["urlCurto"] = $geraURL;
				header("Location: index.php?acao=URLCURTO");
			}else{
				echo '<div id="url" style="font-family:verdana; color:#09f; font-weight:bold;">TODOS OS CAMPOS SÃO OBRIGATÓRIOS;</div>';	
			}
		}
	?>
</body>
</html>