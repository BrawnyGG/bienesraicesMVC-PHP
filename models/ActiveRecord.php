<?php
namespace Model;

class ActiveRecord{
    //Bases de datos...
    protected static $db;
    protected static $columnas_DB = [];
    protected static $tabla = '';

    //Errores...
    protected static $errores = [];

    //Conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }
    //Trae todas las propieedades y las regresa en un array
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function get($limite){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla .  " WHERE id = $id";


        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }
    public static function consultarSQL($query){
        //Consultar en la bases de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }
        //Liberar memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }
    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if( property_exists($objeto, $key) ){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public function sincronizar($args= []){
        foreach($args as $key => $value){
            if( property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

    
    //Valida si: el objeto existe, lo actualiza, si no, lo crea.
    public function guardar(){
        if (!is_null($this->id)){
            //existe el objeto
            $this->actualizar();
        } else {
            //No existe el objeto
            $this->crear();
        }
    }

    protected function crear(){
        //Sanitizar los datos a insertar...
        $atributos = $this->sanitizarAtributos();

        //Inserción en la base de datos
        $query = " INSERT INTO " . static::$tabla .  " ( ";
        $query .= join(", ",array_keys($atributos));
        $query .= " ) VALUES ( '" ;
        $query .= join("', '",array_values($atributos));
        $query .= "' )";

        $resultado = self::$db->query($query);

        self::mensajeExito($resultado,1);
    }

    protected function actualizar(){
        $atributos = $this->sanitizarAtributos();
        $valores = [];

        foreach($atributos  as $key => $value){
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";        

        $resultado = self::$db->query($query);

        self::mensajeExito($resultado,2);

    }

    public function borrar(){
        $query = "DELETE FROM ". static::$tabla .  " WHERE id= '";
        $query .= self::$db->escape_string($this->id);
        $query .= "' LIMIT 1";

        $resultado = self::$db->query($query);
        
        self::mensajeExito($resultado,3);
    }
    
    public function atributos() : array{
        $atributos = [];
        foreach(static::$columnas_DB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() : array{
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }    

    //Subida de archivos
    public function setImagen($imagen){
        //Eliminar imagen anterior
        if(!is_null($this->id)){
            // Verificar si existe el archivo
            $this->borrarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public static function getErrores(){
        return static::$errores;
    }

    protected  function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo){
            unlink( CARPETA_IMAGENES . $this->imagen );
        }
    }
    public function validarFormulario(){
        //Validacion de campos vacios en formulario
        static::$errores = [];
        return static::$errores;
    }

    public function mensajeExito($resultado, int $mensaje){
        if ($resultado){
            if(static::$tabla === "propiedades"){
                header("Location:/admin?mensaje=$mensaje&valor=propiedad");
            } elseif (static::$tabla === "vendedores"){
                header("Location:/admin?mensaje=$mensaje&valor=vendedor(a)");
            } elseif (static::$tabla === "entradas"){
                header("Location:/admin?mensaje=$mensaje&valor=entrada");
            }
        }
    }
}