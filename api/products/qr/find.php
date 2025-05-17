<?php
require_once '../../../app.php';

$code = $_GET['code'] ?? '';
if (empty($code)) {
    echo json_encode(['error' => 'No code provided']);
    exit;
}

// 保存先ディレクトリ
$dir = QR_DIR . '/products';
$fileName = $code . '.png';
$path = $dir . '/' . $fileName;

if (file_exists($path)) {
    // 既にQRコードが存在する場合は、そのまま出力
    header('Content-Type: image/png');
    header('Content-Disposition: inline; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($path));
    readfile($path);
    exit;
} else {
    echo json_encode(['error' => 'QR code not found']);
}