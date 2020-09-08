<?php
	$username = "Erki Pahovski";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	if($hournow < 6){
		$partofday = "uneaeg";
	}// enne 6
	if($hournow >= 8 and $hournow <= 18){
		$partofday = "õppimise aeg";
	}

	//vaatame semestri kulgemist
	$semesterstart = new DateTime("2020-8-31");
	$semesterend = new DateTime("2020-12-13");
	$semesterduration = $semesterstart->diff($semesterend);
	$semesterdurationdays = $semesterduration->format("%r%a");
	$today = new DateTime("now");

	if ($today<$semesterstart){
		echo "semester pole alanud";
	}
	elseif ()
	//ajakontroll lõpetada, semestrikontroll lõpetada ja protsendi arvutamine
?>

<!DOCTYPE HTML>

<html lang="et">

<head>
<meta charset="utf-8">
<title><?php echo $username; ?> veebileht</title>
</head>

<body>

<h1>Erki Pahovski</h1>

<p><?php echo $fulltimenow; ?></p>

<p><?php echo "Praegu on ".$partofday."."; ?></p>


</body>

</html>