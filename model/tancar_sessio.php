<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['inici_sessio'] = false;
