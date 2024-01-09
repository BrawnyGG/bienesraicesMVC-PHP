<?php
namespace Model;
class Entrada extends ActiveRecord{
    protected static $tabla = "entradas";
    protected static $columnas_DB = ['id','titulo','contenido','fecha','vendedorid','imagen','descripcion'];
        
    public $id;
    public $titulo;
    public $imagen;
    public $contenido;
    public $descripcion;
    public $fecha;
    public $vendedorid;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? '';
        $this->contenido = $args["contenido"] ?? '';
        $this->imagen = $args["imagen"] ?? '';
        $this->fecha = date("Y/m/d");
        $this->vendedorid = $args["vendedorid"] ?? '';
        $this->descripcion = $args["descripcion"] ?? '';

    }

    public function validarFormulario(){
        if(!$this->titulo){
            self::$errores[] = "La entrada debe contener un título";
        } elseif ( strlen($this->titulo) > 45 ){
            self::$errores[] = "El titulo debe ser menor a 45 caracteres";
        }
        if(strlen($this->contenido) < 250){
            self::$errores[] = "La entrada debe contener un contenido mayor a 250 caracteres";
        }
        if(strlen($this->descripcion) > 150){
            self::$errores[] = "La descripcion de la entrada debe contener un contenido menor a 150 caracteres";
        }
        if(!$this->vendedorid){
            self::$errores[] = "Se debe seleccionar un creador";
        }
         if(!$this->imagen) {
            self::$errores[] = "La imagen de la entrada es obligatoria";
        }
        return self::$errores;
    }
}