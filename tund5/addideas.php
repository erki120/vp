<?php


require("../../../config.php");
require("fnc_films.php");
$database = "if20_erki_pahovski_1";


 //kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	$stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES (?)");
	echo $conn->error;
	//seome käsuga päris andmed
	// i -integer, d - decimal, s - string
	$stmt->bind_param("s", $_POST["ideainput"]);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}

$username = "Erki Pahovski";

require("header.php");

?>

<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

<h1><?php echo $username; ?></h1>

<ul>
	<li><a href="home.php">Avaleht</a></li>
</ul>

<hr>

<form method="POST">
		<label>Sisesta om pähe tulnud mõte!</label>
		<input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
		<input type="submit" name="ideasubmit" value="Saada mõte ära!">
    </form>
    
    <hr>

    </body>
</html>