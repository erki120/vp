<?php
require("../../../config.php");
require("fnc_films.php");

$inputerror = "";

if(isset($_POST["filmsubmit"])){
	if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["durationinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])){
		$inputerror .= "Osa infot on sisestamata! ";
	}
	if($_POST["yearinput"] > date("Y") or $_POST["yearinput"] < 1895){
		$inputerror .= "Osa infot on sisestamata! ";
	}
	if(empty($inputerror)){
		savefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
	}
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
<label for="titleinput">Lisa filmi pealkiri: </label>
<input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
<br>
<label for="yearinput">Lisa filmi valmimisaasta: </label>
<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
<br>
<label for="durationinput">Lisa filmi kestus: </label>
<input type="number" name="durationinput" id="durationinput" placeholder="Kestus">
<br>
<label for="genreinput">Lisa filmi žanr: </label>
<input type="text" name="genreinput" id="genreinput" placeholder="Žanr">
<br>
<label for="studioinput">Lisa filmi stuudio: </label>
<input type="text" name="studioinput" id="studioinput" placeholder="Stuudio">
<br>
<label for="directorinput">Lisa filmi lavastaja: </label>
<input type="text" name="directorinput" id="directorinput" placeholder="Lavastaja">
<br>
<input type="submit" name="filmsubmit" value="Saada filmid ära!">

</form>
<p><?php echo $inputerror; ?> </p>

</body>
</html>