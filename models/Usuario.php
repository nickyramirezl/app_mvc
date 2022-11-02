<?php

namespace Model;

class Usuario extends ActiveRecord{

    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email','telefono','admin','confirmado','token','password'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    public $password;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta(){

        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del cliente es obligatorio';
        }

        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido del cliente es obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][] = 'El email del cliente es obligatorio';
        }
        
        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono del cliente es obligatorio';
        }
        
        if(!$this->password){
            self::$alertas['error'][] = 'El password del cliente es obligatorio';
        }

        elseif(strlen($this->password) < 6 ){
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }
        

        return self::$alertas;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail(){

        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        return self::$alertas;

    }

    public function validarPassword(){

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        elseif(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe tener al menos 9 caracteres';
        }

        return self::$alertas;

    }

    // Revisa si el usuario ya existe
    public function existeUsuario(){

        $q = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $r = self::$db->query($q);

        if($r->num_rows){
            self::$alertas['error'][] = 'El usuario ya está registrado';
        }

        return $r;

    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function comprobarPasswordyVerificacion($password){

        $r = password_verify($password,$this->password);

        if(!$r){
            self::$alertas['error'][] = 'La contraseña es incorrecta, intenta con otra';
        }else if(!$this->confirmado){
            self::$alertas['error'][] = 'Tu cuenta aún no ha sido confirmada. Confírmala en tu correo';
        }
        else{
            return true;
        }

    }

}