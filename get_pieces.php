<?php
header('Content-Type: application/json');

$piecesDir = 'pieces';
$response = ['success' => false, 'message' => '', 'files' => []];

// Проверяем существование директории
if (!is_dir($piecesDir)) {
    $response['message'] = "Директория с кусочками не найдена";
    echo json_encode($response);
    exit;
}

// Получаем список файлов
$files = scandir($piecesDir);
$imageFiles = [];

foreach ($files as $file) {
    // Пропускаем системные файлы и проверяем расширение
    if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
        $imageFiles[] = $file;
    }
}

if (empty($imageFiles)) {
    $response['message'] = "В директории нет изображений";
    echo json_encode($response);
    exit;
}

$response['success'] = true;
$response['files'] = $imageFiles;
echo json_encode($response);
?>