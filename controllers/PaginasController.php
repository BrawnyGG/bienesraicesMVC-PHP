<?php
namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $router->render("/paginas/index", [
            'inicio' => true,
            'propiedades' => $propiedades
        ]);
    }
    public static function nosotros(Router $router){
        $router->render("/paginas/nosotros", [
        ]);
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render("/paginas/propiedades", [
            'propiedades' => $propiedades
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
        $router->render("/paginas/blog", [
            
        ]);
    }
    public static function entrada(Router $router){
        $router->render("/paginas/entrada", [
            
        ]);
    }
    public static function contacto(Router $router){
        $mensaje = null;
        $exito = false;
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $respuestas = $_POST['contacto'];
            $mail = new PHPMailer();
            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true; // Verificar queno nos pasemos de los 500 emails:C
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls'; //Que encriptacion tendrá

            //Configurar el contenido del email...
            $mail->setFrom('admin@bienesraices.com'); // quien envia el email
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); // quien lo recibe
            $mail->Subject = 'Tienes un nuevo mensaje!'; // Asunto del correo

            $mail->isHTML();  //Habilita html en el correo
            $mail->CharSet = 'UTF-8'; //habilita caracteres especiales en español...
            
            //Definimos el contenido
            $contenido = '<html>';
            $contenido .= '<p>¡Tienes un nuevo mensaje!</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '<p>Prefiere ser contactado por ' . $respuestas['contacto'] . '</p>';
            if($respuestas['contacto'] === 'Telefono'){
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora contacto: ' . $respuestas['hora'] . '</p>';
            } else if ($respuestas['contacto'] === 'Email') {
                $contenido .= '<p>Correo: ' . $respuestas['email'] . '</p>';
            }
            
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin html';

            //Enviamos el email
            if(!$mail->send()){
                $mensaje = "Hubo un error al enviar el mensaje";
            } else {
                $mensaje = "Mensaje enviado correctamente!";
                $exito = true;
            }
        }

        $router->render("/paginas/contacto", [
            'mensaje' => $mensaje,
            'exito' => $exito
        ]);
    }
    

}