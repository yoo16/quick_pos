<?php
require_once '../../../app.php';

use App\Services\QrCodeService;

$code = $_GET['code'] ?? '';
if (empty($code)) {
    http_response_code(400);
    echo 'No code provided';
    exit;
}

$service = new QrCodeService();
$path = $service->generate($code);
$fileName = $service->getFileName($code);

header('Content-Type: image/png');
header('Content-Disposition: inline; filename="' . $fileName . '"');
header('Content-Length: ' . filesize($path));
readfile($path);