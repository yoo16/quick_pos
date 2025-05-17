<?php
// 共通ファイル読み込み
require_once "../app.php";

// 年月プルダウンデータ
$years = range(date('Y'), 2023);

// 年月の初期値
$current_year = $_GET['year'] ?? date('Y');

// 売上一覧
$salesService = new SalesService();
$monthly_sales = $salesService->getMonthlySalesByYear($current_year);

// 月ごとの売上を0で初期化（1月〜12月）
$monthly_data = array_fill(1, 12, 0);
foreach ($monthly_sales as $row) {
    $monthly_data[(int)$row['month']] = (int)$row['total'];
}

function selected($value, $target)
{
    if ($value == $target) return "selected";
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include COMPONENT_DIR . "Head.php"; ?>

<body>
    <?php include COMPONENT_DIR . "Nav.php"; ?>

    <h1 class="text-2xl font-bold text-center p-6">売上管理</h1>

    <?php include COMPONENT_DIR . "SalesDateSelect.php"; ?>

    <div class="text-center p-3">
        <label for="">総売上</label>
        <span id="total-sales" class="text-3xl font-bold"><?= number_format(array_sum($monthly_data)) ?></span>
        <span class="text-md">円</span>
    </div>

    <canvas id="salesChart" class="w-full p-6"></canvas>

    <script>
        const monthlySales = <?= json_encode(array_values($monthly_data)) ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/sales_month.js" defer></script>
</body>

</html>