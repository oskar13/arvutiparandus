<?php
require('konf.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Arvutiparandus</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" type="text/css" href="normalize.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="width-container">
		<div id="header-login">
 <?php if(isSet($_SESSION["kasutajanimi"])){ ?>
Tere <?php echo $_SESSION["kasutajanimi"]; ?>
<?php
if ($_SESSION["roll"] == "haldur") {
	echo " <a href='sisselog.php'>Admin</a>";
}
?>
 <a href="haldus.php">Haldus</a>
<a href="sisselog.php?lahku=jah">Logi välja</a>
<?php }else{ ?>
<a href="sisselog.php">Logi sisse</a>
<?php }?>
		</div>
		<h1>Arvutiparandus</h1>
		<h2>Kõik teie arvutivajadused ühes kohas</h2>
		
	</header>

	<div class="width-container">
		<article>
			<h3>Hetkel järjekorras 
<?php
	$kask=$yhendus->prepare("SELECT COUNT('valmis') FROM `parandused` WHERE `valmis`=0");
	$kask->bind_result($fdsa);
	$kask->execute();
	$kask->fetch();
	echo $fdsa;
if ($fdsa==1){
echo" parandus";
} else {
echo" parandust";
}
?>
			</h3>
		</article>
		<article>
			<img class="img-right" src="http://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Computer-aj_aj_ashton_01.svg/320px-Computer-aj_aj_ashton_01.svg.png">
			<h2>Lorem Ipsum</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<div class="clear"></div>
		</article>

		<article>
			<img class="img-left" src="http://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Computer-aj_aj_ashton_01.svg/320px-Computer-aj_aj_ashton_01.svg.png">
			<h2>Lorem Ipsum</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<div class="clear"></div>
		</article>
	</div>

	<footer class="width-container">
		<p>Copyright 2013 - Arvutiparandus</p>
	</footer>
</body>
</html>