<?php
require_once "app.php";

$message = "QRコードを読み込むか商品コードを入力してください";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include COMPONENT_DIR . "Head.php"; ?>

<body>
    <?php include COMPONENT_DIR . "Nav.php"; ?>

    <main class="flex">
        <div class="w-1/3">
            <?php include COMPONENT_DIR . 'QR.php' ?>
            <?php include COMPONENT_DIR . 'CodeRegister.php' ?>
        </div>
        <div class="w-2/3">
            <?php include COMPONENT_DIR . 'SalesRecord.php' ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <script src="js/app.js" defer></script>
    <script src="js/qr_reader.js" defer></script>
</body>

</html>