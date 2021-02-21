<?php
class Sesion {
    public function __construct($lifetime=86400) {
        session_start(
            [
            'cookie_lifetime' => $lifetime,
            ]
        );
    }

    public function iniciar($username) {
        // Almacena en la sesión
        $_SESSION['username'] = $username;
        // Guarda sesión
        session_write_close();
    }

    public function cerrar() {
        session_unset();
        session_destroy();
        setcookie("PHPSESSID", "", time() - 3600);
    }

    public function comprobar() {
        if(!isset($_SESSION['username'])) {
            header("Location: login.php");
        }
    }

}