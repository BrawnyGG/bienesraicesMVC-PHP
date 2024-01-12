<?php
namespace Model;
use PHPMailer\PHPMailer\PHPMailer;

class Email {

    private $host;
    private $port;
    private $username;
    private $password;
    private PHPMailer $mail;

    public function __construct($host, $port, $username, $password){
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;


        $this->mail = new PHPMailer();
        $this->configurarEmail();
    }
    private function configurarEmail(){
        //Configurar SMTP
        $this->mail->isSMTP();
        $this->mail->Host = $this->host;
        $this->mail->SMTPAuth = true; // Verificar queno nos pasemos de los 500 emails:C
        $this->mail->Port = $this->port;
        $this->mail->Username = $this->username;
        $this->mail->Password = $this->password;
        $this->mail->SMTPSecure = 'tls'; //Que encriptacion tendrá
        $this->mail->isHTML();  //Habilita html en el correo
        $this->mail->CharSet = 'UTF-8'; //habilita caracteres especiales en español...
    
        //Configurar el contenido del email...
        $this->mail->setFrom('gutierrezbraulio2020@gmail.com'); // quien envia el email
    }

    public function mensajeContacto(string $nombre, string $mail){
        $this->mail->clearAddresses();
        $this->mail->addAddress($mail, $nombre); // quien recibe mail

        $this->mail->Subject = '¡Gracias!'; // Asunto del correo

        //Definimos el contenido
        $contenido = '<html>';
        $contenido .= '<head>';
        $contenido .= '<style>html{font-size:62.5%;}body{margin:0;}p{font-size:1.4rem;padding:0 1rem;}h1{text-align:center;font-size:2.4rem;}span{color:#E08709;}.footer{padding-top:1rem;color:#333333;font-size:1.2rem;}</style>';
        $contenido .= '</head>';

        $contenido .= '<body>';
        $contenido .= '<h1>Hola, <span>'.$nombre.'</span></h1>';
        $contenido .= '<p>¡Muchas gracias por contactarnos!</p>';
        $contenido .= '<p>En unos instantes un asesor se comunicará contigo para el motivo de tu compra/venta</p>';
        $contenido .= '<p>Gracias por confiar en <span>nosotros</span></p>';
        $contenido .= '<p class="footer">Todos los derechos reservados '.date("Y").' &copy;</p>';
        $contenido .= '</body>';
        $contenido .= '</html>';

        $this->mail->Body = $contenido;

        //Definimos el contenido alternativo sin html
        $contenidoAlt = 'Hola, : ' . $nombre;
        $contenidoAlt .= '¡Muchas gracias por contactarnos!';
        $contenidoAlt .= 'En unos instantes un asesor se comunicará contigo para el motivo de tu compra/venta';
        $contenidoAlt .= 'Gracias por confiar en nosotros';

        $this->mail->AltBody = $contenidoAlt;
        
        $this->mail->send();
    }

    public function recibirDatos(array $respuestas){
        $this->mail->addAddress('gutierrezbraulio2020@gmail.com', 'Braulio'); // quien recibe mail

        $this->mail->Subject = '¡Tienes un nuevo mensaje!'; // Asunto del correo

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
        $this->mail->Body = $contenido;

        //Definimos el contenido alternativo sin html
        $contenidoAlt = '¡Tienes un nuevo mensaje!';
        $contenidoAlt .= 'Nombre: ' . $respuestas['nombre'];
        $contenidoAlt .= 'Mensaje: ' . $respuestas['mensaje'];
        $contenidoAlt .= 'Vende o compra: ' . $respuestas['tipo'];
        $contenidoAlt .= 'Precio o presupuesto: $' . $respuestas['precio'];
        $contenidoAlt .= 'Prefiere ser contactado por ' . $respuestas['contacto'];
        if($respuestas['contacto'] === 'Telefono'){
            $contenidoAlt .= 'Telefono: ' . $respuestas['telefono'];
            $contenidoAlt .= 'Fecha contacto: ' . $respuestas['fecha'];
            $contenidoAlt .= 'Hora contacto: ' . $respuestas['hora'];
        } else if ($respuestas['contacto'] === 'Email') {
            $contenidoAlt .= 'Correo: ' . $respuestas['email'];
        }
        $this->mail->AltBody = $contenidoAlt;
        
        
        return $this->mail->send();
    }
}