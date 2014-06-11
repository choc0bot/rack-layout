<?php


$rackname=$_REQUEST["rn"];
$rackdiagram=$_REQUEST["rd"];

$css = "<link rel='stylesheet' href='rack.css' type='text/css'>";
$heading = "<h4>{$rackname}</h4>";
$file = "rack-{$rackname}.html";
$ourFileHandle = fopen($file, 'w') or die("can't open file");
fclose($ourFileHandle);
$content = serialize($rackdiagram);
$pieces = explode("</h3>", $content);
$content = $pieces[1];
$content = rtrim($content,'";');
file_put_contents($file, $css);
file_put_contents($file, $heading, FILE_APPEND | LOCK_EX);
$content = stripslashes($content);
file_put_contents($file, $content, FILE_APPEND | LOCK_EX);

?>