<?php
namespace Controllers;

use Model\Admin;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $errores = Admin::getErrores();
        $auth = new Admin;

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $args = $_POST["admin"];
            $auth->sincronizar($args);
            $errores = $auth->validarFormulario();

            if(empty($errores)){
                //Verificar si el usuario existe
                $resultado = $auth->existeUsuario();
                if(!$resultado){
                    $errores = Admin::getErrores();
                } else {
                    //Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if(!$autenticado){
                        //Password incorrecto
                        $errores = Admin::getErrores();
                    } else {
                        //Password correcto, auntenticarlo
                        $auth->autenticar();
                    }
                }
            }
        }

        $router->render("/auth/login",[
            'admin' => $auth,
            'errores' => $errores
        ]);
    }
    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}