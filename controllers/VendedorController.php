<?php
namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController{
    public static function crear(Router $router){
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();  

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $vendedor = new Vendedor($_POST["vendedor"]);
            $errores = $vendedor->validarFormulario();
            if (empty($errores)){
                //Guardo en la bases de datos
                $vendedor->guardar();
            }  
        }
        $router->render("vendedores/crear",[
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar("/admin");
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();  

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $args = $_POST["vendedor"];
            $vendedor->sincronizar($args);
            $errores = $vendedor->validarFormulario();
        
            if (empty($errores)){
                //Guardo en la bases de datos
                $vendedor->guardar();
            }  
        }

        $router->render("vendedores/actualizar",[
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id){
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->borrar();
                }
            }
        }
    }
}