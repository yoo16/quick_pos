<?php
require_once "../../app.php";

$productService = new ProductService();
$code = $_GET['code'] ?? null;
if ($code) {
    $product = $productService->findByCode($code);
    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid code']);
}