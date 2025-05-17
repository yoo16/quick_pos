<?php
// 共通ファイル読み込み
require_once "app.php";

// POSTチェック
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// TODO : validate in SalesService

// データを挿入する準備
$sales = new Sales($_POST);

// TODO: validate in SalesService

// サービスを使って挿入
$salesService = new SalesService();
$result = $salesService->create($sales);

// 結果をチェック
if ($result) {
    // 成功メッセージをセッションに保存
    $_SESSION['message'] = '計上しました';
} else {
    // エラーメッセージをセッションに保存
    $_SESSION['message'] = '計上に失敗しました';
}

// トップにリダイレクト
header('Location: ./');