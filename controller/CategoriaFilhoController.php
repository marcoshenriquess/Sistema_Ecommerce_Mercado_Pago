<?php
require_once(dirname(__DIR__) . "/models/CategoriaFilho.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // Check which action to execute
    $action = $_POST['action'];

    if ($action === 'ListaCategorias') {
        echo ListaCategorias();
    } else {
        echo json_encode(['error' => 'Invalid action']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

function ListaCategorias()
{
    // Mocked response for testing
    $id = isset($_POST['id']) ? json_decode($_POST['id'], true) : null;

    // Uncomment and implement your logic when ready:
    $AuxControllCatFilho = new CategoriaFilhoModel();
    $result = $AuxControllCatFilho->ListaCategorias($id);

    // For testing, return a sample response
    return json_encode($result);
}
