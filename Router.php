<?php
namespace MVC;
class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get(string $url, $fn){
        $this->rutasGET[$url] = $fn;
    }
    public function post(string $url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/crear','/propiedades/actualizar',
    '/vendedores/crear','/vendedores/actualizar','vendedores/eliminar','/propiedades/eliminar'];

        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header('Location: /login');
        }

        if($fn){
            call_user_func($fn,$this);
        } else {
            echo "Página No Encontrada";
        }
    }
    //Function que trae una vista
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start(); //Almacenamiento en memoria durante un momento

        require __DIR__ .  "/views/$view.php"; //Se guarda en la memoria la vista

        $contenido = ob_get_clean();//Limpia el buffer y se asigna a la variable contenido que 
                                //se imprime despues
        require __DIR__  . "/views/layout.php";
    }

}