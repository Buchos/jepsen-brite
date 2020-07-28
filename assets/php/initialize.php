<?php
session_start();

$today = date('Y-m-j');

// PATH CONSTANTS
define("PHP", dirname(__FILE__));
define("ASSETS", dirname(PHP));
define("ROOT", dirname(ASSETS));
$stupidroot = "../";

// PUT DATABASE INTO VARIABLE
$bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_cc256803d465131', 'bd60e8ee909b42', '2db04edd', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//require_once('functions.php');
