<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\LoginController;

require_once __DIR__ . '/../includes/app.php';


$router = new Router;


//Pagina del administrador... (Privada)

//Login y autenticacion
$router->get("/login", [LoginController::class,"login"]);
$router->post("/login", [LoginController::class,"login"]);
$router->get("/logout", [LoginController::class,"logout"]);

$router->get("/admin", [PropiedadController::class,"index"]);

//Propiedades
$router->get("/propiedades/crear", [PropiedadController::class,"crear"]);
$router->post("/propiedades/crear", [PropiedadController::class,"crear"]);

$router->get("/propiedades/actualizar", [PropiedadController::class,"actualizar"]);
$router->post("/propiedades/actualizar", [PropiedadController::class,"actualizar"]);

$router->post("/propiedades/eliminar", [PropiedadController::class,"eliminar"]);

//Vendedores
$router->get("/vendedores/crear", [VendedorController::class,"crear"]);
$router->post("/vendedores/crear", [VendedorController::class,"crear"]);

$router->get("/vendedores/actualizar", [VendedorController::class,"actualizar"]);
$router->post("/vendedores/actualizar", [VendedorController::class,"actualizar"]);

$router->post("/vendedores/eliminar", [VendedorController::class,"eliminar"]);



//Pagina principal...  (Publica)
$router->get("/",[PaginasController::class,"index"]);
$router->get("/nosotros",[PaginasController::class,"nosotros"]);
$router->get("/propiedades",[PaginasController::class,"propiedades"]);
$router->get("/propiedad",[PaginasController::class,"propiedad"]);
$router->get("/blog",[PaginasController::class,"blog"]);
$router->get("/entrada",[PaginasController::class,"entrada"]);

$router->get("/contacto",[PaginasController::class,"contacto"]);
$router->post("/contacto",[PaginasController::class,"contacto"]);



$router->comprobarRutas();