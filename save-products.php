<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache');

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['products'])) {
    echo json_encode(['success' => false, 'error' => 'No data']);
    exit;
}

$password = isset($input['password']) ? $input['password'] : '';

if ($password !== 'admin123') {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$data = ['products' => $input['products']];
$result = file_put_contents('products.json', json_encode($data, JSON_PRETTY_PRINT));

if ($result !== false) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Cannot save file']);
}
?>