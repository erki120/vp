<?php
require("use_session.php");
require("../../../config.php");
$database = "if20_erki_pahovski_1";



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
$conn->close();


	$username = "Erki Pahovski";

require("header.php");
?>

	<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

	<h1><?php echo $_SESSION["userfirstname"]." ".$_SESSION["userlastname"]; ?></h1>

<p><a href="?logout=1">Logi välja!</a></p>

	<hr>
	
	<ul>
    <li><a href="home.php">Avaleht</a></li>
  </ul>

	<hr>
	<?php echo $ideahtml; ?>



</body>

</html>