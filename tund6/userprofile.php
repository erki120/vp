<?php
require("use_session.php");
require("../../../config.php");
require("fnc_user.php");
require("fnc_common.php");

$notice = "";
$userdescription = "";


if(isset($_POST["profilesubmit"])){
	$userdescription = test_input($_POST["userdescriptioninput"]);

	$notice = storeuserprofile($userdescription, $_POST["userbgcolorinput"], $_POST["usertxtcolorinput"]);
	$_SESSION["userbgcolor"] = $_POST["userbgcolorinput"];
	$_SESSION["usertxtcolor"] = $_POST["usertxtcolorinput"];
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

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="userdescriptioninput">Minu lühikirjeldus: </label>
<textarea rows="10" cols="80" type="text" name="userdescriptioninput" id="userdescriptioninput" placeholder="Minu lühikirjeldus..."><?php echo $userdescription; ?></textarea>
<br>
<label for="userbgcolorinput">Vali tausta värv: </label>
<input type="color" name="userbgcolorinput" id="userbgcolorinput" value="<?php echo $_SESSION["userbgcolor"]; ?>">
<br>
<label for="usertxtcolorinput">Vali teskti värv: </label>
<input type="color" name="usertxtcolorinput" id="usertxtcolorinput" value= "<?php echo $_SESSION["usertxtcolor"]; ?>">

<input type="submit" name="profilesubmit" value="Salvesta profiil">

</form>
<p><?php echo $notice; ?></p>


</body>
</html>