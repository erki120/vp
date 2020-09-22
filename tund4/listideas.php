<?php


require("../../../config.php");
//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
$database = "if20_erki_pahovski_1";

if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	$stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES (?)");
	echo $conn->error;
	//seome käsuga päris andmed
	// i -integer, d - decimal, s - string
	$stmt->bind_param("s", $_POST["ideainput"]);
	$stmt->execute();
	$stmt->close();
	$stmt->close();
}

//loen kõik olemasolevad mõtted
$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
$stmt = $conn->prepare("SELECT idea FROM myideas");
echo $conn->error;


//seome tulemuse muutujaga
$stmt->bind_result($ideafromdb);
$stmt->execute();

$ideahtml = "";
while($stmt->fetch()){
	$ideahtml .= "<p>" . $ideafromdb ."</p>";
}
$stmt->close();
$stmt->close();


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
//	$imghtml .= '<img src="../vp_pics/' .$picfiles[$i] .'" ';
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
	<?php //echo $imghtml; ?>
	<hr>
	<?php echo $ideahtml; ?>

	<form method="POST">
		<label>Sisesta om pähe tulnud mõte!</label>
		<input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
		<input type="submit" name="ideasubmit" value="Saada mõte ära!">
	</form>

</body>

</html>