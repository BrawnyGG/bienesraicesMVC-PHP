<?php
namespace Controllers;

use MVC\Router;
use Model\Entrada;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class EntradaController{
    public static function crear(Router $router){
        $entrada = new Entrada();
        $vendedores = Vendedor::all();
        $errores = Entrada::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $entrada = new Entrada($_POST["entrada"]);
            //Nombre unico para imagenes
            if($_FILES['entrada']['tmp_name']['imagen']){
                $nombreImg = md5( uniqid( rand(), true ) ) . ".jpg";
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImg);
            }
            $errores = $entrada->validarFormulario();
            if (empty($errores)){
                //Creo la carpeta en el serviiidor en caso de no exstir una imagen
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                //Guardo img en carpeta_imagenes
                $image->save(CARPETA_IMAGENES . $nombreImg);
    
                //Guardo en la bases de datos
                $entrada->guardar();
                
            }
        }

        $router->render("entradas/crear", [
            'entrada' => $entrada,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar("/admin");
        //consultar campos de la propiedad a actualizar
        $entrada = Entrada::find($id);
        $vendedores = Vendedor::all();
        $errores = Entrada::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Llena los argumentos para actualizarlo
            $args = $_POST["entrada"];
    
            $entrada->sincronizar($args);
    
            //Valido la entrada de nuevos datos...
            $errores = $entrada->validarFormulario();
    
            //Realiza un resize de la imagen con ImageIntervation
            if($_FILES['entrada']['tmp_name']['imagen']){
                //Nombre unico para imagenes
                $nombreImg = md5( uniqid( rand(), true ) ) . ".jpg";
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImg);
            }
            if (empty($errores)){
                //Guardo img en carpeta_imagenes
                if($_FILES['entrada']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGENES . $nombreImg); 
                }
                $entrada->guardar();
            }
        }

        $router->render("entradas/actualizar", [
            'entrada' => $entrada,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id){
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)){
                    $entrada = Entrada::find($id);
                    $entrada->borrar();
                }
            }
        }
    }
}