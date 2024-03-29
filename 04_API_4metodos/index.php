<?php

// Habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Importar la clase Cliente
require_once 'models/Cliente.php';

// Instanciar la clase Cliente
$cliente = new Cliente();

// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// URL del cuerpo de la solicitud
define ("URL_BODY", "php://input");

// Procesar la solicitud
switch ($method) {
    case 'GET':
        // Obtener todos los registros
        $response = handleGetRequest();
        break;
    case 'POST':
        // Insertar un nuevo registro
        $response = handlePostRequest();
        break;
    case 'PUT':
        // Actualizar un registro existente
        $response = handlePutRequest();
        break;
    case 'DELETE':
        // Eliminar un registro
        $response = handleDeleteRequest();
        break;
    default:
        $response = array('message' => 'Método no soportado');
        http_response_code(405); // Método no permitido
        break;
}

// Devolver la respuesta
header('Content-Type: application/json');
echo json_encode($response);

// Función para manejar las solicitudes GET
function handleGetRequest() {
    global $cliente;
    if (isset($_GET['id'])) {
        // Obtener un solo registro por ID
        $id = $_GET['id'];
        $result = $cliente->getOne($id);
    } else {
        // Obtener todos los registros
        $result = $cliente->getAll();
    }
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

// Función para manejar las solicitudes POST
function handlePostRequest() {
    global $cliente;
    // Obtener los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents(URL_BODY), true);
    if ($cliente->insert($data)) {
        return array('message' => 'Registro insertado correctamente');
    } else {
        return array('message' => 'Error al insertar el registro');
    }
}

// Función para manejar las solicitudes PUT
function handlePutRequest() {
    global $cliente;
    
    // Obtener el ID del registro a actualizar desde la URL
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id === null) {
        return array('message' => 'No se proporcionó el ID del registro a actualizar');
    }

    // Obtener los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents(URL_BODY), true);

    if ($cliente->update($id, $data)) {
        return array('message' => 'Registro actualizado correctamente');
    } else {
        return array('message' => 'Error al actualizar el registro');
    }
}


// Función para manejar las solicitudes DELETE
function handleDeleteRequest() {
    global $cliente;

    // Obtener el ID del registro a eliminar desde el cuerpo de la solicitud
    $data = json_decode(file_get_contents(URL_BODY), true);
    $id = isset($data['id']) ? $data['id'] : null;

    if ($id !== null) {
        if ($cliente->delete($id)) {
            return array('message' => 'Registro eliminado correctamente');
        } else {
            return array('message' => 'Error al eliminar el registro');
        }
    } else {
        return array('message' => 'No se proporcionó el ID del registro a eliminar');
    }
}
