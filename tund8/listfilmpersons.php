<?php
  require("use_session.php");
  require("../../../config.php");
  require("fnc_filmrelations.php");

  $sortby = 0;
  $sortorder = 0;
  
  require("header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud �ppet�� kaigus ning ei sisalda mingit t�siseltv�etavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 s�gissemestril <a href="https://www.tlu.ee">Tallinna �likooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="?logout=1">Logi v�lja</a>!</li>
    <li><a href="home.php">Avaleht</a></li>
  </ul>
  
  <hr>
  <?php
  	if(isset($_GEt["sortby"]) and isset($_GET["sortorder"])){
      if($_GET["sortby"] >= 1 and $_GET[sortby <=4]){
        $sortby = $_GET["sortby"];
      }
      if($_GET["sortorder"] == 1 or $_GET["sortorder"]){
    }
  }


   echo readpersonsinfilm();
    ?>
</body>
</html>



