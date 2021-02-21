<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo_ventana; ?></title>
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="Bootstrap/css/estilos.css" >
    </head>
    <body> 
        <header>      
            <?php if ($panel_control) { ?>            
                <nav>
                    <div class="cerrarSesion">
                    <p><?php echo $_SESSION['username'] . ' </p><a href="logout.php">logout</a>'; ?>
                    </div>            
                </nav>                
            <?php } ?>
        </header>