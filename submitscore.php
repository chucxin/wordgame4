<?php

$name = $_POST["name"];
$score = $_POST["score"];

$xml = simplexml_load_file("highscores.xml");

$new = $xml->addChild("case","");
$new->addChild("name", $name);
$new->addChild("score", $score);

$newxml = $xml->asXML();

$file = fopen("highscores.xml", "w");
fwrite($file, $newxml);

fclose($fil);

echo $newxml;


?>