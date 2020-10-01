<?php


require("../../../config.php");
require("fnc_films.php");

$username = "Erki Pahovski";

require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebipragrammeerimise kursuse banner">

<h1><?php echo $username; ?></h1>

<ul>
<li><a href="home.php">Avaleht</a></li>
</ul>

<hr>

<?php echo readfilms(); ?>
</body>
</html>