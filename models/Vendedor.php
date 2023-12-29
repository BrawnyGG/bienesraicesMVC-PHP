<?php
namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = "vendedores";
    protected static $columnas_DB = ['id','nombre','apellido','telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? '';
        $this->apellido = $args["apellido"] ?? '';
        $this->telefono = $args["telefono"] ?? '';

    }
    public function validarFormulario(){
        if(!$this->nombre){
            self::$errores[] = "El vendedor tiene que tener un nombre";
        }
        if(!$this->apellido){
            self::$errores[] = "El vendedor tiene que tener un apellido";
        }
        if(!$this->telefono){
            self::$errores[] = "El telefono tiene que ser definido";
        }else if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "El telefono tiene que ser valido";
        }

        return self::$errores;
    }
}