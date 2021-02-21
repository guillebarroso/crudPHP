<?php
require('includes/conexion.php');
require('includes/sesion.php');

$sesion = new Sesion();
$sesion->comprobar();

// GET sin id -> Alta preparar
// GET con id -> Modif. preparar (incluir input hidden id)

// POST sin id -> Alta (insert)
// POST con id -> Modif (update)
$es_alta = true;
if(isset($_GET['id'])) {
    // Mostrar formulario para modificar libro con el id recibido
    $conn = new BD();
    $result = $conn->consulta($_GET['id']);
    $fila = $result->fetch();
    if(!$fila) {
        die ("El id no coincide con el de ningún disco");
    }
    $es_alta = false;
} elseif (isset($_POST['id'])) {
    // Actualizar el libro con el id recibido usando los datos del POST
    $bd = new BD();
    $bd->actualiza($_POST);
    header("Location: principal.php");
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dar de alta un libro con los datos del POST
    $bd = new BD();
    $num_filas = $bd->alta($_POST);
    if($num_filas!=1) {
        die ("No se pudo dar de alta");
    }
    header("Location: principal.php");
}   
?>

<!-- html -->
<?php
$titulo_ventana = $es_alta? "Nuevo disco" : "Editar disco";
$titulo = $titulo_ventana;
$panel_control = true;
require_once('templates/encabezado.php');
?>
<main>
<section>
    <h1><?php echo $titulo;?></h1>
<form class="login" action="formulariodiscos.php" method="POST" enctype="multipart/form-data">
<?php if(!$es_alta) { ?>
        <input type="hidden" name="id" value="<?php echo isset($fila)? $fila['id'] : ""; ?>">
<?php } ?>
<p>
<label for="titulo">Titulo:</label>
<input class="form-control" type="text" name="titulo" value="<?php echo isset($fila)? $fila['titulo'] : ""; ?>">
</p>
<p>
<label for="compositor">Compositor:</label>
<input class="form-control" type="text" name="compositor" value="<?php echo isset($fila)? $fila['compositor'] : ""; ?>">
</p>
<p>
<label for="ismn">ISMN:</label>
<input class="form-control" type="text" name="ismn" value="<?php echo isset($fila)? $fila['ismn'] : ""; ?>">
</p>
<p>
<label for="stock">Stock:</label>
<input class="form-control" type="text" name="stock" value="<?php echo isset($fila)? $fila['stock'] : ""; ?>">
</p>
<p>
<label for="genero">Género:</label>
<br>
<select multiple class="form-control" name="genero">
        <option value="1">Rock</option> 
        <option value="2">Rap</option> 
        <option value="3">Pop</option>
        <option value="4">Trap</option> 
        <option value="5">Jazz</option> 
        <option value="6">Reggaeton</option> 
</select>
</p>
<p>
<input class="btn btn-lg btn-primary btn-block" type="submit" value="<?php echo $es_alta? "Añadir" : "Modificar"; ?>">
</p>
</form>
</section>
</main>
<?php require_once('templates/pie.php'); ?>