<?php
class BD {
    public $enlace;
    
    public function __construct() {
        try {
            $this->enlace = new PDO("mysql:host=db;dbname=tienda", "encargado", "diccionario");
            $this->enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getEnlace() {
        if(!isset($this->enlace)) {
            die("No se ha establecido conexión");
        }
        return $this->enlace;
    }

    public function alta(array $datos) {
        $sql = $this->enlace->prepare("INSERT INTO discos (titulo, compositor, ismn, stock, genero) 
                                       VALUES (:titulo, :compositor, :ismn, :stock, :genero)");
        $sql->bindParam(':titulo', $datos['titulo']);
        $sql->bindParam(':compositor', $datos['compositor']);
        $sql->bindParam(':ismn', $datos['ismn']);
        $sql->bindParam(':stock', $datos['stock']);
        $sql->bindParam(':genero', $datos['genero']);
        $sql->execute();
        return $sql->rowCount();
    }

    public function consulta($id=null) {
        $sentencia = "SELECT * FROM discos" . (!is_null($id)? " WHERE id=:id" : "");
        $sql = $this->enlace->prepare($sentencia); 
        if(!is_null($id)) {
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $sql->execute();
        return $sql;
    }

    public function actualiza(array $datos) {
        $sql = $this->enlace->prepare("UPDATE discos 
                                              SET titulo=:titulo, compositor=:compositor, ismn=:ismn,
                                              stock=:stock, genero=:genero
                                              WHERE id=:id");
        $sql->bindParam(':id', $datos['id'], PDO::PARAM_INT);
        $sql->bindParam(':titulo', $datos['titulo']);
        $sql->bindParam(':compositor', $datos['compositor']);
        $sql->bindParam(':ismn', $datos['ismn']);
        $sql->bindParam(':stock', $datos['stock']);
        $sql->bindParam(':genero', $datos['genero']);
        $sql->execute();
        return $sql->rowCount();
    }

    public function borra($id) {
        $sql = $this->enlace->prepare("DELETE FROM discos WHERE id=:id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->rowCount();
    }

    public function login(array $datos) {
        $sql = $this->enlace->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
        $sql->bindParam(':username', $datos['username']);
        $sql->bindParam(':password', $datos['password']);
        $sql->execute();
        return $sql;
    }
}

