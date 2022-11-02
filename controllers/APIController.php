<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{

    public static function index(){
        $servicios = Servicio::all();

        echo json_encode($servicios);

    }

    public static function guardar(){

        // Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena los servicios de la cita

        $id_servicios = explode(',', $_POST['servicios']);

        foreach($id_servicios as $id_servicio){
            $args = [
                'cita_id' => $id,
                'servicio_id' => $id_servicio
            ];
            $cita_servicio = new CitaServicio($args);
            $cita_servicio->guardar();
        }        

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cita = Cita::find($_POST['id']);
            $cita->eliminar();

            header('Location:' . $_SERVER['HTTP_REFERER']);
        }

    }

}