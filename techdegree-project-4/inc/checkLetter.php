<?php
session_start();
require "Game.php";
require "Phrase.php";

$phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);



?>