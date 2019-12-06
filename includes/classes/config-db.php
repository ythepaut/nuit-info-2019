<?php

$credentials = array(
    "ip" => "ythepautfcninfo.mysql.db",
    "login" => "ythepautfcninfo",
    "password" => "ANtaFIesRG5h0w2I",
    "base" => "ythepautfcninfo"
);
$connection = mysqli_connect($credentials['ip'], $credentials['login'], $credentials['password'], $credentials['login']);
mysqli_set_charset($connection, "utf8");

?>