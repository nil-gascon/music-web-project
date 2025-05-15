<?php
function connectarBD()
{
    $servidor = "********************************";
    $port = "********************************";
    $DBnom = "**********************************";
    $usuari = "********************************";
    $clau = "*********************************";
    $connexio = pg_connect("host=$servidor port=$port dbname=$DBnom user=$usuari password=$clau")
        or die("Error: (pg_connect)" . pg_last_error());
    return $connexio;
}
