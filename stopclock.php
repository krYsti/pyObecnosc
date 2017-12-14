<?php
$myfile = fopen("closed.txt", "w");
fwrite($myfile, "koniec");
fclose($myfile);
?>