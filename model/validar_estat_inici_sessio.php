<?php
session_start();
$estatSessio = isset($_SESSION['inici_sessio']) ? $_SESSION['inici_sessio'] : false;
echo json_encode(array('estat_sessio' => $estatSessio));
