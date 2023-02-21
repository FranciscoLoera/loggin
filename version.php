<?php

//

$con=new PDO("sqlsrv:server=FRANCISCOLOERA\LOERA;database=Univerisades","FRANCISCOLOERA\X");
$consulta=$con->preparate("SELECT * FROM area");
$consulta->execute();
$datos= $consulta->fetchAll(POO::FETCH_ASSOC);
var_dump($datos);