<?php
namespace Controllers;

use Model\Email;
use Model\Entrada;
use Model\Propiedad;
use MVC\Router;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $entradas = Entrada::get(2);
        $router->render("/paginas/index", [
            'inicio' => true,
            'propiedades' => $propiedades,
            'entradas' => $entradas
        ]);
    }
    public static function nosotros(Router $router){
        $router->render("/paginas/nosotros", [
        ]);
    }
    public static function propiedades(Router $router){
        $limite = 6;
        $propiedades = Propiedad::all();
        $paginas = ceil( count($propiedades) / $limite );
        $pagina = intval($_GET['p']);
        $offset = ($pagina - 1) * $limite;

        $propiedades = Propiedad::offset($limite, $offset);

        $router->render("/paginas/propiedades", [
            'propiedades' => $propiedades,
            'paginas' => $paginas,
            'pagina' => $pagina
        ]);
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar("/");
        $propiedad = Propiedad::find($id);
        $router->render("/paginas/propiedad", [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $entradas = Entrada::all();
        $router->render("/paginas/blog", [
            'entradas' => $entradas
        ]);
    }
    public static function entrada(Router $router){
        $id = validarORedireccionar("/");
        $entrada = Entrada::find($id);
        $router->render("/paginas/entrada", [
            'entrada' => $entrada
        ]);
    }
    public static function contacto(Router $router){
        $mensaje = null;
        $exito = false;
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $respuestas = $_POST['contacto'];
            $mail = new Email($_ENV['EMAIL_HOST'], $_ENV['EMAIL_PORT'],
                              $_ENV['EMAIL_USER'], $_ENV['EMAIL_PASS']);

            $recibido = $mail-> recibirDatos($respuestas);
            //Enviamos el email
            if(!$recibido){
                $mensaje = "Hubo un error al enviar el mensaje";
            } else {
                $mensaje = "Mensaje enviado correctamente!";
                $exito = true;
                if( isset($respuestas['email']) ){
                    $mail->mensajeContacto($respuestas['nombre'],$respuestas['email']);
                }
            }
        }

        $router->render("/paginas/contacto", [
            'mensaje' => $mensaje,
            'exito' => $exito
        ]);
    }
    

}