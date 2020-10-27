<?php
require("use_session.php");
require("../../../config.php");
require("fnc_films.php");

$username = "Erki Pahovski";

require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

<h1><?php echo $_SESSION["userfirstname"]." ".$_SESSION["userlastname"]; ?></h1>

<p><a href="?logout=1">Logi välja!</a></p>

<ul>
<li><a href="home.php">Avaleht</a></li>
</ul>

<hr>

<?php echo readfilms(); ?>
</body>
</html>