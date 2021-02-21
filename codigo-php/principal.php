<?php
// Librerías
require_once('includes/conexion.php');
require_once('includes/sesion.php');

$sesion = new Sesion();
$sesion->comprobar();

$conn = new BD();
$result = $conn->consulta();
?>

<!-- html -->
<?php
$eliminar = "¿Estás seguro de eliminar este disco?";
$titulo_ventana = "Inicio";
$titulo = "Discos:";
$panel_control = true;
require_once('templates/encabezado.php');
?>
<main>
    <section>
        <h1><?php echo $titulo; ?></h1>
        <table class="listado">
            <thead>
                <tr class="columnas-tabla">
                    <th>ID</th>
                    <th>Álbum</th>                    
                    <th>Artista</th>
                    <th>ISMN</th>
                    <th>En stock</th>
                    <th>Género</th>
                    <th>Editar borrar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // foreach( coleccion as variable_iteracion )
            foreach( $result as $fila ) { 
                echo '
                <tr>
                <td>' . $fila['id'] . '</td>
                <td>' . $fila['titulo'] . '</td>                    
                <td>' . $fila['compositor'] . '</td>
                <td>' . $fila['ismn'] . '</td>
                <td>' . $fila['stock'] . '</td>
                <td>' . $fila['genero'] . '</td>
                <td><a style="cursor: pointer;" data-toggle="modal" data-target="#ventanamodal">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                    </a>
                    <a href="formulariodiscos.php?id='. $fila['id'] .'">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                </td>
            </tr>';
            }
            ?>
            </tbody>
        </table>
        <p class="anadir">
            <a href="formulariodiscos.php">
                <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-plus-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
            </a>
        </p>
        <form name='formulario-oculto' action="borrar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id">
        </form>
        <script>
        function envia_post(id) {
            document.forms['formulario-oculto']['id'].value = id;
            document.forms['formulario-oculto'].submit();            
        }
        
        </script>
        <!-- VENTANA MODAL --> 
        <?php require_once('templates/modal.php'); ?>             
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    </section>
</main>
<?php require_once('templates/pie.php'); ?>