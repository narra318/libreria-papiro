<?php

class Configuracion
{

    public $con;

    public function __construct()
    {
        $this->con = new mysqli("localhost", "root", "", "libreria");
    }


    public function conectarDB()
    {
        if ($this->con->connect_error) {
            $_SESSION["ErrorDB"] = "No ha sido posible establecer la conexión con la base de datos";
        } else {
        }
        return $this->con;
    }

    public function cerrarConexion()
    {
        echo "<script>console.log('Debug Objects: " . "' );</script>";
        return $this->con->close();
    }
}

?>