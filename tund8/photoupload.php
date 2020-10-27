<?php
require("use_session.php");
require("../../../config.php");
require("fnc_films.php");

$inputerror = "";
$filetype = "";
$filesizelimit = "1048576";
$photoupladdir_orig = "../photoupload_orig/";
$photoupladdir_normal = "../photoupload_normal/";
$filenameprefix = "vp_";
$filename = null;
$notice = "";



//kas n pilt ja mis tüüpi
if(isset($_POST["photosubmit"])){
	$check = getimagesize($_FILES["photoinput"]["tmp_name"]);
	if ($check !==false){
		if($check["mime"] == "image/jpeg"){
			$filetype = "jpg";
		}
		if($check["mime"] == "image/png"){
			$filetype = "png";
		}
		if($check["mime"] == "image/gif"){
			$filetype = "gif";
		}
	} else {
		$inputerror = "Valitud fail ei ole pilt!";
	}
	//kas on sobiva failisuurusega
	if(empty($inputerror) and $_FILES["photoinput"]["size"] > $filesizelimit){
		$inputerror = "Liiga suur fail";
	}
//loome uue failinie
$timestamp = microtime(1) * 1000;
$filename = $filenameprefix.$timestamp.".".$filetype;

//kas on olemas
	if(file_exists($photoupladdir_orig.$filename)){
		$inputerror = "Selline fail on juba olemas";
	}

	//kui vigu pole 
	if(empty($inputerror)){

		//muudame suurust
		//loome pildikogumi, pildi objekti
		if($filetype == "jpg"){
			$mytempimage = imagecreatefromjpeg($_FILES["photoinput"]["tmp_name"]);
		}
		if($filetype == "png"){
			$mytempimage = imagecreatefrompng($_FILES["photoinput"]["tmp_name"]);
		}
		if($filetype == "gif"){
			$mytempimage = imagecreatefromgif($_FILES["photoinput"]["tmp_name"]);
		}

		//teeme kindlaks originaalsuuruse
		$imagew = imagesx($mytempimage);
		$imageh = imagesy($mytempimage);

		if($imagew > $photomaxwidth or $imageh > $photomaxheight){
			if($imagew / $photomaxwidth > $imageh / $photomaxheight) {
				$photosizeratio = $imagew / $photomaxwidth;
			} else{
				$photosizeratio = $imageh / $photomaxheight;
			}
			//arvutame uued mõõdud
			$neww = round($imagew / $photosizeratio);
			$newh = round($imageh / $photosizeratio);
			// teeme uue pikslikogumi
			$mynewtempimage = imagecreatetruecolor($neww, $newh);
			//kirjutame järelejäänud pikslid uuele pildile
			imagecopyresampled($mynewtempimage, $mytempimage, 0,0,0,0,$neww,$newh, $imagew, $imageh);
			//salvestame faili
		$notice = saveimage($mytempimage, $filetype)

		move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photoupladdir_orig.$filename);
	}
}

function saveimage($mytempimage, $filetype){
	$notice = null;

	if($filetype == "jpg"){
		if(imagejpeg($mynewtempimage, $photoupladdir_normal.$filename, 90)){
			$notice = "Vähendatud pildi salvestmine õnnestus!";
		} else {
			$notice = "Vähendatud pildi salvestmine õnnestus!";
		}

		if(imagepng($mynewtempimage, $photoupladdir_normal.$filename, 6)){
			$notice = "Vähendatud pildi salvestmine õnnestus!";
		} else {
			$notice = "Vähendatud pildi salvestmine õnnestus!";
		}

		if(imagegif($mynewtempimage, $photoupladdir_normal.$filename)){
			$notice = "Vähendatud pildi salvestmine õnnestus!";
		} else {
			$notice = "Vähendatud pildi salvestmine õnnestus!";
		}
	
	} 
}




require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

<h1><?php echo $_SESSION["userfirstname"]." ".$_SESSION["userlastname"]; ?></h1>

<p><a href="?logout=1">Logi välja!</a></p>

<ul>
	<li><a href="home.php">Avaleht</a></li>
</ul>

<hr>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

<label for="photoinput">Vali pildifail</label>
<input id="photoinput" name="photoinput" type="file" required>
<br>
<label for="altinput">Lisa pidi lühikirjeldus(alternatiivtekst)</label>
<input id="altinput" name="altinput" type="text">
<br>
<label>Privaatsustase</label>
<br>
<input id="privinput1" name="privinput" type="radio" value="1">
<label for="privinput1">Privaatne (ainult ise näen)</label>

<input id="privinput2" name="privinput" type="radio" value="1">
<label for="privinput2">Klubiliikmetele (sisseloginud kasutajad näevad)</label>

<input id="privinput3" name="privinput" type="radio" value="1">
<label for="privinput3">Avalik (kõik näevad)</label>

<br>
<input type="submit" name="photosubmit" value="Lae foto üles">

</form>
<p><?php echo $inputerror; echo $notice; ?> </p>



</body>
</html>