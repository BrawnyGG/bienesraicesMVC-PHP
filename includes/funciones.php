<?php
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");


function debuggear($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}
// Escapar / sanitizar el HTML
function s($html) : string{
    $s =  htmlspecialchars($html);
    return $s;
}
function validarORedireccionar (string $url) : int {
    $id = $_GET["id"];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    //validar que el id exista
    if (!$id){
        header("Location: $url");
    }
    return $id;
}

function validarTipoContenido($tipo){
    $valido = ["propiedad", "vendedor", "vendedor(a)"];
    
    return in_array($tipo, $valido);
}
function mostrarMensajes(int $resultado, string $valor){
    if(!validarTipoContenido($valor)){
        header("Location:/bienesraices/index.php");
    }
    $alerta =  '' ;

    switch($resultado){
        case  1:
            $alerta = $valor . ' Creada Exitosamente!';
            break;
        case  2:
            $alerta = $valor . ' Actualizada Exitosamente!';
            break;    
        case  3:
            $alerta = $valor . ' Eliminada Exitosamente!';
            break;
        default:
            $alerta = false;
            break;
    }
    return $alerta;
}