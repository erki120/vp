<?php


require("../../../config.php");
require("fnc_films.php");

$filmhtml = readfilms();
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
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	if($hournow < 6 or $hournow >= 23){
		$partofday = "uneaeg";
	}// enne 6
	elseif($hournow >= 8 and $hournow <= 18){
		$partofday = "õppimise aeg";
	}
	elseif ($hournow > 18 and $hournow < 23) {
		$partofday = "Vaba aeg";
	}
	else {
		$partofday = "lihtsalt aeg";
	}

$weekdayNamesET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
$weekdaynow = date("N");
//echo $weekdaynow;
//echo "<br>";


	//vaatame semestri kulgemist
	$semesterstart = new DateTime("2020-8-31");
	$semesterend = new DateTime("2020-12-13");
	$semesterduration = $semesterstart->diff($semesterend);
	$semesterdurationdays = $semesterduration->format("%r%a");
	$today = new DateTime("now");
	$fromsemesterstartdays = $semesterstart->format("%r%a");

	$semesterpraegu = "Pole teada";

	if ($today<$semesterstart){
		$semesterpraegu = "semester pole alanud";
	}
	
	elseif ($today=$semesterduration){
		$semesterpraegu = "semester peal";
	}
	elseif ($today>$semesterend){
		$semesterpraegu = "semester lõppenud";
	}

//loemat piltide kataloogi sisu ja näitame pilte

$picfiletypes = ["image/jpeg", "image/png"];

//$allfiles = scandir("../vp_pics/");

$allfiles = array_slice(scandir("../vp_pics/"), 2);
$picfiles = [];

foreach($allfiles as $thing){
	$fileinfo = getImagesize("../vp_pics/" .$thing);
	if(in_array($fileinfo["mime"], $picfiletypes) == true) {
		array_push($picfiles, $thing);
	}
}

//paneme kõik pilid ekraanile
$piccount = count($picfiles);

$imghtml = "";
//for($i = 0; $i < $piccount; $i++){
	//$imghtml .= '<img src="../vp_pics/' .$picfiles[$i] .'" ';
//	$imghtml .= 'alt="Tallinna Ülikool">';
//}
	$imghtml .= '<img src="../vp_pics/' .$picfiles[mt_rand(0, ($piccount - 1))] .'" ';
  	$imghtml .= 'alt="Tallinna Ülikool">';


require("header.php");
?>



	<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

	<h1>Erki Pahovski</h1>

	<p><?php echo $fulltimenow; ?></p>

	<p><?php echo "Praegu on ".$partofday."."; ?></p>

	<p><?php echo $semesterpraegu ?></p>

	<hr>
	<?php echo $imghtml; ?>

	<hr>
	<?php echo readfilms(); ?>

	<form method="POST">
		<label>Sisesta om pähe tulnud mõte!</label>
		<input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
		<input type="submit" name="ideasubmit" value="Saada mõte ära!">
	</form>

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