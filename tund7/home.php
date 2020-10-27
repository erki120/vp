<?php
require("use_session.php");
require("header.php");

?>
<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

<h1><?php echo $_SESSION["userfirstname"]." ".$_SESSION["userlastname"]; ?></h1>

<p><a href="?logout=1">Logi välja!</a></p>
<ul>
	<li><a href="addideas.php">Lisa oma mõte</a></li>
	<li><a href="listideas.php">Loe varasemaid mõtteid</a></li>
	<li><a href="listfilms.php">Loe filmiinfot</a></li>
	<li><a href="addfilms.php">Filmiinfo lisamine</a></li>
	<li><a href="addfilmrelations.php">Filmi seoste lisamine</a></li>
	<li><a href="listfilmpersons.php">Filmitegelased</a></li>
	<li><a href="userprofile.php">Minu kasutajaprofiil</a></li>
</ul>
</body>

</html>