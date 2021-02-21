<?php
//### Control de sesión
require_once("includes/sesion.php");
$sesion = new Sesion();
$sesion->cerrar();
//################
// Redirección a otro php
header("Location: login.php");
?>