<?php

require_once '../config/Connection.php';
session_start();

$_SESSION['test']=0;

header('Location:PageAccueil.php?var1='.$_SESSION['test']);



//Connection à la bd
$user ="root";
$pass ="";
$dsn = 'mysql:host=localhost;dbname=todo_list';
$con = new Connection($dsn,$user,$pass);
$GateTache = new GateWayTache($con);


?>
