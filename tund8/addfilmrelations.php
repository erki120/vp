<?php
  require("use_session.php");
  //loeme andmebaasi login ifo muutujad
  require("../../../config.php");
  require("fnc_filmrelations.php");
  
  $genrenotice = "";
  $selectedfilm = "";
  $selectedgenre = "";
  $studionotice = "";
  $selectedstudio = "";
  
  if(isset($_POST["filmstudiorelationsubmit"])){
	  if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$studionotice = " Vali film!";
	}
	if(!empty($_POST["filmstudioinput"])){
		$selectedstudio = intval($_POST["filmstudioinput"]);
	} else {
		$studionotice .= " Vali stuudio!";
	}
	if(!empty($selectedfilm) and !empty($selectedstudio)){
		$studionotice = storenewstudiorelation($selectedfilm, $selectedstudio);
	}
  }
  
  if(isset($_POST["filmgenrerelationsubmit"])){
	//$selectedfilm = $_POST["filminput"];
	if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$genrenotice = " Vali film!";
	}
	if(!empty($_POST["filmgenreinput"])){
		$selectedgenre = intval($_POST["filmgenreinput"]);
	} else {
		$genrenotice .= " Vali �anr!";
	}
	if(!empty($selectedfilm) and !empty($selectedgenre)){
		$genrenotice = storenewgenrerelation($selectedfilm, $selectedgenre);
	}
  }
  
  $filmselecthtml = readmovietoselect($selectedfilm);
  $filmgenreselecthtml = readgenretoselect($selectedgenre);
  $filmstudioselecthtml = readstudiotoselect($selectedstudio);

  //$username = "Andrus Rinde";

  require("header.php");
?>

  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud �ppet�� k�igus ning ei sisalda mingit t�siseltv�etavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna �likooli</a> Digitehnoloogiate instituudis.</p>
    
  <ul>
    <li><a href="home.php">Avalehele</a></li>
	<li><a href="?logout=1">Logi v�lja</a>!</li>
  </ul>
  
  <h2>M��rame filmi stuudio/tootja</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
		echo $filmselecthtml;
		echo $filmstudioselecthtml;
	?>
    <input type="submit" name="filmstudiorelationsubmit" value="Salvesta seos stuudioga"><span><?php echo $studionotice; ?></span>
  </form>
    
  <hr>
  <h2>M��rame filmile �anri</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
		echo $filmselecthtml;
		echo $filmgenreselecthtml;
	?>
	
	<input type="submit" name="filmgenrerelationsubmit" value="Salvesta seos �anriga"><span><?php echo $genrenotice; ?></span>
  </form>
  
</body>
</html>

