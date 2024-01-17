<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }


    public function datos()
    {
        $variable = array(

            "id" => "01",
            "nombres" => "Claudio Fernando",
            "apellidos" => "Chimarro Quishpe",
            "cedula" => "1721766002"
        );

        return $this->response->setJson($variable);
    }

    public function empleadosAll()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM empleados');
        $results = $query->getResultArray();
        return $this->response->setJson($results);
    }

    public function empleado($cedula)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM empleados where nro_doc='$cedula'");
        $results = $query->getResultArray();
        return $this->response->setJson($results);
    }

    public function productos()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tipo_producto where estado=true');
        $results = $query->getResultArray();
        return $this->response->setJson($results);
    }

    public function crear($nombre)
    {
        $db = \Config\Database::connect();
        $query = $db->query("INSERT INTO tipo_producto(nombre) VALUES('$nombre');");
        var_dump($query);
        $resultado = array(
            "estado" => "ok"
        );
        $error = array(
            "estado" => "error"
        );
        if ($query)
            return $this->response->setJson($resultado);
        else return $this->response->setJson($error);
    }

    public function actualizar($id, $nombre)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE tipo_producto SET nombre='$nombre' WHERE id='$id';");
        var_dump($query);
        $resultado = array(
            "estado" => "ok"
        );
        $error = array(
            "estado" => "error"
        );
        if ($query)
            return $this->response->setJson($resultado);
        else return $this->response->setJson($error);
    }
    public function eliminar($nombre)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE tipo_producto SET estado='false' WHERE nombre='$nombre';");
        var_dump($query);
        $resultado = array(
            "estado" => "ok"
        );
        $error = array(
            "estado" => "error"
        );
        if ($query)
            return $this->response->setJson($resultado);
        else return $this->response->setJson($error);
    }
}
