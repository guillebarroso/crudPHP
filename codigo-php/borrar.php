<?php
require('includes/conexion.php');
require('includes/sesion.php');

$sesion = new Sesion();
$sesion->comprobar();

$conn = new BD();
if (isset($_POST['id'])) {
    $conn->borra($_POST['id']);  
}
header("Location: principal.php");
