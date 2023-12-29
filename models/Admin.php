<?php
namespace Model;

class Admin extends ActiveRecord{
    protected static $tabla = "usuarios";
    protected static $columnas_DB = ['id','email','password'];

    public $id;
    public $email;
    public $password;
    
    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? '';
        $this->password = $args["password"] ?? '';
    }
    public function validarFormulario(){
        if(!$this->email){
            self::$errores[] = "El email no puede ir vacio";
        } else if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/", $this->email)){
            self::$errores[] = "El email tiene que ser valido";
        }
        if(!$this->password){
            self::$errores[] = "La contraseña no puede ir vacia";
        }

        return self::$errores;
    }
    public function existeUsuario(){
        $query = "SELECT * FROM " . static::$tabla;
        $query .= " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = 'El usuario no existe';
            return;
        }

        return $resultado;
    }
    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();
        $auth = password_verify($this->password, $usuario->password);
        
        if(!$auth){
            self::$errores[] = 'La contraseña es incorrecta';
        }
        return $auth;
    }
    public function autenticar(){
        session_start();

        //Llenar arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}