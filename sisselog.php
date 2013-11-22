<?php
require('konf.php');
  session_start();
  if(isSet($_REQUEST["kasutajanimi"])){
  

     $kask=$yhendus->prepare(
      "SELECT roll FROM kasutajad WHERE knimi=? AND paroolir2si=?");
     $knimiparool=$_REQUEST["kasutajanimi"]."_".$_REQUEST["parool"];
     $kask->bind_param("ss", $_REQUEST["kasutajanimi"], $_REQUEST["parool"]);
     $kask->bind_result($roll);
     $kask->execute();
     if($kask->fetch()){
         $_SESSION["kasutajanimi"]=$_REQUEST["kasutajanimi"];
         $_SESSION["roll"]=$roll;
         $kask->close();
     }

  }
  
  if (isSet($_REQUEST['uuskas'])){
	
	
	
	 $kask=$yhendus->prepare("INSERT INTO kasutajad (knimi,paroolir2si,roll) VALUES (?,?,?)");
	$kask->bind_param("sss", $_REQUEST["knimi"], $_REQUEST["paroolir2si"], $_REQUEST["roll"]);
	$kask->execute();
}
  
  
  
  if(isSet($_REQUEST["lahku"])){
     unset($_SESSION["kasutajanimi"]);
     unset($_SESSION["roll"]);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sisse logimine - Arvutiparandus</title>
  <meta charset="utf-8">
  
  <link rel="stylesheet" type="text/css" href="normalize.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <?php if(isSet($_SESSION["kasutajanimi"])): ?>
<div style="margin-top: 2em;" class="width-container">
      <h3>Tere, <?php echo $_SESSION["roll"]." ".$_SESSION["kasutajanimi"]; ?>
      <a href="?lahku=jah">lahku</a></h3>

      <ul>
        <li><a href="index.php">Avaleht</a></li>
        <li><a href="haldus.php">Haldus</a></li>
      </ul>
		<?php 
		
		if ($_SESSION["roll"]=="haldur") {
			?>
      <h3>Uue kasutaja lisamine</h3>
			<form action="?">
      <dl>
  			<dt>Kasutaja nimi</dt>
  			<dd><input type="text" name="knimi"></dd>
  			<dt>Parool</dt>
  			<dd><input type="password" name="paroolir2si"></dd>
  			<dt>Roll</dt>
  			<dd>
        <select>
          <option value="haldur">Haldur</option>
          <option value="tehnik">Tehnik</option>
        </select>
        </dd>
      </dl>
			<input type="submit" value="Loo kasutaja">
			<input type="hidden" name="uuskas" value="1">
			</form>
			
			
			<?php
		}
		?>
      </ul>
</div>
    <?php else: ?>
      <div id="login-box">
       <form action="?" method="post">
        <dl>
          <dt>Kasutajanimi:</dt>
          <dd><input type="text" name="kasutajanimi" /></dd>
          <dt>Parool:</dt>
          <dd><input type="password" name="parool" /></dd>
          <input type="submit" value="Sisesta" />
        </dl>
       </form>
       <a href="index.php" style="float:right;">Avalehele</a>
      </div>
    <?php endif ?>
  </body>
</html>
<?php
  $yhendus->close();
?>
