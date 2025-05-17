<?php
require_once '../../app.php';

header('Content-Type: application/json');

$year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

$salesService = new SalesService();
$monthly_sales = $salesService->getMonthlySalesByYear($year);

// 月データ初期化（1〜12月）
$monthly_data = array_fill(1, 12, 0);
foreach ($monthly_sales as $row) {
    $monthly_data[(int)$row['month']] = (int)$row['total'];
}

// JSONで月別売上を出力（配列：[10000, 8000, ..., 12000]）
echo json_encode(array_values($monthly_data));