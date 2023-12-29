<?php 
namespace Controllers;

use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
use MVC\Router;


class PropiedadController{

    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //Realiza mensaje condicional (exito o fracaso)
        $resultado = $_GET["mensaje"] ?? null;    
        $valor = $_GET["valor"] ?? null;

        $router->render("propiedades/admin", [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'valor' => $valor,
            'vendedores' => $vendedores
        ]);
    }
    public static function crear(Router $router){
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $propiedad = new Propiedad($_POST["propiedad"]);
            //Nombre unico para imagenes
            $nombreImg = md5( uniqid( rand(), true ) ) . ".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen']){

                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImg);
            }
            $errores = $propiedad->validarFormulario();
            if (empty($errores)){
                //Creo la carpeta en el serviiidor en caso de no exstir una imagen
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                //Guardo img en carpeta_imagenes
                $image->save(CARPETA_IMAGENES . $nombreImg);
    
                //Guardo en la bases de datos
                $propiedad->guardar();
                
            }
        }

        $router->render("propiedades/crear", [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar("/admin");
        //consultar campos de la propiedad a actualizar
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Llena los argumentos para actualizarlo
            $args = $_POST["propiedad"];
    
            $propiedad->sincronizar($args);
    
            //Valido la entrada de nuevos datos...
            $errores = $propiedad->validarFormulario();
    
            
    
            //Realiza un resize de la imagen con ImageIntervation
            if($_FILES['propiedad']['tmp_name']['imagen']){
                //Nombre unico para imagenes
                $nombreImg = md5( uniqid( rand(), true ) ) . ".jpg";
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImg);
            }
    
    
            if (empty($errores)){
    
                //Guardo img en carpeta_imagenes
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGENES . $nombreImg); 
                }
                $propiedad->guardar();
    
                
            }
        }

        $router->render("propiedades/actualizar", [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->borrar();
                }
            }
        }
    }
}