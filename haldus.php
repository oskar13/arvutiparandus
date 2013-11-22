<?php
require('konf.php');
session_start();
if(!isSet($_SESSION["kasutajanimi"])){
header('Location: index.php');
exit;
}

if(isSet($_SESSION["kasutajanimi"])) {
if (isSet($_REQUEST['uustel'])){
	
	
	
	 $kask=$yhendus->prepare("INSERT INTO parandused (kirjeldus,tehnik,kommentaar,valmis) VALUES (?,?,?,?)");
	$kask->bind_param("sssi", $_REQUEST["kirjeldus"], $_REQUEST["tehnik"], $_REQUEST["kommentaar"], $_REQUEST["valmis"]);
	$kask->execute();
}

if (isSet($_REQUEST['valmisid'])){
	
	
	
	 $kask=$yhendus->prepare("UPDATE parandused SET `valmis`=1 WHERE id=?");
	$kask->bind_param("i", $_REQUEST["valmisid"]);
	$kask->execute();

}


if (isSet($_REQUEST['kustuta'])){
	
	
	
	 $kask=$yhendus->prepare("DELETE FROM `parandused` WHERE `id`=?");
	$kask->bind_param("i", $_REQUEST["kustuta"]);
	$kask->execute();
}
} else {
if (isSet($_REQUEST['uustel']) or isSet($_REQUEST['kustuta'])){
echo"<h1 style='color:red;'>Sul puudub ligipääs!!!!</h1>";
}
}


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
<div style="margin-top: 2em;" class="width-container">
    <h1>Tellimused ilma tehnikuta</h1>
	<table border="1">
	  <tr>
	    <th>id</th>
	    <th>kirjeldus</th>
		<th>tehnik</th>
	    <th>kommentaar</th>
		<th>valmis</th>
		<?php if(isSet($_SESSION["kasutajanimi"])) { ?>
		<th>kustuta</th>
		 <?php }   ?>
	  </tr>
	  <?php
	  $kask=$yhendus->prepare("SELECT `id`, `kirjeldus`, `tehnik`, `kommentaar`, `valmis` FROM parandused");
	  $kask->bind_result($id,$kirjeldus, $tehnik, $kommentaar, $valmis);
	$kask->execute();   

			  while($kask->fetch()){
				echo"<tr>";
				echo  "<td>".$id."</td>";
				echo "<td>".$kirjeldus."</td>";
				echo "<td>".$tehnik."</td>";
				echo "<td>".$kommentaar."</td>";
				echo "<td>";
				if ($valmis==1) {
					echo "jah";
				} else {
					echo "ei";
					echo " <a href='?valmisid=". $id ."'>jah?</a>";
				}
				echo "</td>";
				if(isSet($_SESSION["kasutajanimi"])) {

				echo "<td><a href='?kustuta=".$id."'>kustuta</a>";
				}
				echo"</tr>";
				}
			  
			   ?>
			   
			   
			   

		   	</table>
			
			
			
			
			<?php
			
			 if(isSet($_SESSION["kasutajanimi"])){
			?>
			
			<form action="?">
			<input type="hidden" value="1" name="uustel">
			Kirjeldus:
			<input type="text" name="kirjeldus">
			Tehnik:
			<select name="tehnik">
				  <?php
				  	$kask=$yhendus->prepare("SELECT `knimi` FROM kasutajad");
				  	$kask->bind_result($knimi);
					$kask->execute();   

					  while($kask->fetch()){
					  	echo "<option value='". $knimi ."'>". $knimi ."</option>";
					  }
			  	?>
			  	</select>
			Kommentaar
			<input type="text" name="kommentaar">
			Valmis?
			<select name="valmis">
				<option value="0">Ei</option>
				<option value="1">Jah</option>
			</select>
			<input type="submit" value="Lisa">
			</form>
			<br>
			<a href="index.php">avalehele</a><br>
			<a href="sisselog.php?lahku=jah">lahku</a>
			<?php

			} else {
			echo"<ul>
        <li><a href='sisselog.php'>Haldus</a></li>

      </ul>";
			}
			?>
			<br>
	</div>		
  </body>
</html>