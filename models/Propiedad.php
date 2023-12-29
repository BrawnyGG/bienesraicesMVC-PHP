<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = "propiedades";
    protected static $columnas_DB = ['id','titulo','precio','imagen','descripcion','habitaciones',
    'wc','estacionamiento','creado','VENDEDORES_id'];
        
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $VENDEDORES_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? '';
        $this->precio = $args["precio"] ?? '';
        $this->imagen = $args["imagen"] ?? '';
        $this->descripcion = $args["descripcion"] ?? '';
        $this->habitaciones = $args["habitaciones"] ?? '';
        $this->wc = $args["wc"] ?? '';
        $this->estacionamiento = $args["estacionamiento"] ?? '';
        $this->creado = date("Y/m/d");
        $this->VENDEDORES_id = $args["VENDEDORES_id"] ?? '';

    }

    public function validarFormulario(){
        if(!$this->titulo){
            self::$errores[] = "La propiedad debe contener un título";
        }
        if(!$this->precio){
            self::$errores[] = "El precio no está definido";
        }
        if(strlen($this->descripcion) < 50){
            self::$errores[] = "La propiedad debe contener una descripción de 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "Las habitaciones no están definidas";
        }
        if(!$this->wc){
            self::$errores[] = "El número de baños no está definido";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El numero de estacionamiento no está definido";
        }
        if(!$this->VENDEDORES_id){
            self::$errores[] = "Se debe seleccionar un vendedor";
        }
         if(!$this->imagen) {
            self::$errores[] = "La imagen de la propiedad es obligatoria";
        }

        return self::$errores;
    }
}