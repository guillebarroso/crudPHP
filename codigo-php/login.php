<?php
// Librerías
require_once('includes/conexion.php');
require_once('includes/sesion.php');

// Código php
$msg = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new BD();
    $sql = $conn->login($_POST);
    $fila = $sql->fetch();
    if($fila) {
        $sesion = new Sesion();
        $sesion->iniciar($_POST['username']);
        header("Location: principal.php");
    } 
    $msg = 'Usuario o contraseña incorrectos';
}
?>

<!-- html -->
<?php
$titulo_ventana = "Login page";
$titulo = "Regístrate";
$panel_control = false;
require_once('templates/encabezado.php');
?>
<section class="login">
    <h1><?php echo $titulo; ?></h1>
    <form class="form-signin" action="" method="POST" enctype="multipart/form-data">
        <label for="username">Username: </label>
        <input class="form-control" type="text" id="username" name="username" value="<?php echo isset($_POST['username'])? $_POST['username'] : ""; ?>">
        <label for="password">Password: </label>
        <input class="form-control" type="password" id="password" name="password">
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
        <?php echo $msg; ?>
    </form>
</section>
<?php require_once('templates/pie.php'); ?>
