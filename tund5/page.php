<?php
  require("fnc_user.php");
	$username = "Erki Pahovski";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$weekdaynow = date("N");

	if($hournow < 6){
		$partofday = "uneaeg";
	}//enne 6
	if($hournow >= 6 and $hournow < 8){
		$partofday = "hommikuste protseduuride aeg";
	}
	if($hournow >= 8 and $hournow < 18){
		$partofday = "akadeemilise aktiivsuse aeg";
	}
	if($hournow >= 18 and $hournow < 22){
		$partofday = "õhtuste toimetuste aeg";
	}
	if($hournow >= 22){
		$partofday = "päeva kokkuvõtte ning magamamineku aeg";
	}



	//vaatame semestri kulgemist
	$semesterstart = new DateTime("2020-8-31");
	$semesterend = new DateTime("2020-12-13");
	$semesterduration = $semesterstart->diff($semesterend);
	$semesterdurationdays = $semesterduration->format("%r%a");
	$today = new DateTime("now");
	$fromsemesterstart = $semesterstart->diff($today);
	//saime aja erinevuse objektina, seda niisama näidata ei saa
	$fromsemesterstartdays = $fromsemesterstart->format("%r%a");
	$semesterpercentage = 0;
	  
	$semesterinfo = "Semester kulgeb vastavalt akadeemilisele kalendrile.";
	if($semesterstart > $today){
		$semesterinfo = "Semester pole veel peale hakanud!";
	}
	if($fromsemesterstartdays === 0){
		$semesterinfo = "Semester algab täna!";
	}
	if($fromsemesterstartdays > 0 and $fromsemesterstartdays < $semesterdurationdays){
		$semesterpercentage = ($fromsemesterstartdays / $semesterdurationdays) * 100;
		$semesterinfo = "Semester on täies hoos, kestab juba " .$fromsemesterstartdays ." päeva, läbitud on " .$semesterpercentage ."%.";
	}
	if($fromsemesterstartdays == $semesterdurationdays){
		$semesterinfo = "Semester lõppeb täna!";
	}
	if($fromsemesterstartdays > $semesterdurationdays){
		$semesterinfo = "Semester on läbi saanud!";
	}

//loemat piltide kataloogi sisu ja näitame pilte

$picfiletypes = ["image/jpeg", "image/png"];

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

	$imghtml .= '<img src="../vp_pics/' .$picfiles[mt_rand(0, ($piccount - 1))] .'" ';
	  $imghtml .= 'alt="Tallinna Ülikool">';
	  

	  //kodune

$email = "";
$notice = "";
$result = "";
$emailerror = "";
$passworderror = "";


	  if(isset($_POST["submituserdata"])){
		if (!empty($_POST["emailinput"])){
			$email = $_POST["emailinput"];
		} else {
			$emailerror = "Palun sisesta e-postiaadress!";
		}

		if (!empty($_POST["passwordinput"])){
			$password = $_POST["passwordinput"];
		} else {
			$passworderror = "Palun sisesta parool!";
		}
		if(empty($emailerror) and empty($passworderror)){
			$result= signin($email, $password);
		}
		
	}

	  //kodune

require("header.php");
?>



	<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

	<h1><?php echo $username; ?></h1>

  <p>Lehe avamise hetk: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$fulltimenow; ?>.</p>

	<p><?php echo "Praegu on ".$partofday."."; ?></p>

	<p><?php echo $semesterinfo; ?></p>

	<hr>

	<p>Loo endale <a href="addnewuser.php">kasutajakonto</a>!</p>

	<hr>




	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="emailinput">E-mail (kasutajatunnus):</label><br>
	<input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	<br>
	<label for="passwordinput"></label>
	  <br>
	  <input name="passwordinput" id="passwordinput" type="password"><span><?php echo $passworderror; ?></span>
	<br>
	  <input name="submituserdata" type="submit" value="Logi sisse">
	</form>
	<p><?php echo $result; ?></p>





	<hr>

	<?php echo $imghtml; ?>

</body>

</html>