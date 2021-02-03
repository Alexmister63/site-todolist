<?php
require ('Connection.php');
$user ="root";
$pass ="";
$dsn = 'mysql:host=localhost;dbname=todo_list';
$con = new Connection($dsn,$user,$pass);