<?php
require_once '../app.php';

use App\Services\QrCodeService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posts = $_POST;
    $productService = new ProductService();
    $existingProduct = $productService->findByCode($posts['code']);
    if ($existingProduct) {
        $error = 'この商品コードはすでに使用されています。';
    } else {
        // TODO: validate in ProductService
        // Productクラスのインスタンスを生成
        $product = new Product($_POST);
        // 商品登録
        $productService->create($product);

        // QRコード生成
        $service = new QrCodeService();
        $service->generate($product->code);
        header('Location: ./');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<?php include COMPONENT_DIR . 'Head.php'; ?>

<body>
    <?php include COMPONENT_DIR . 'Nav.php'; ?>

    <main class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">商品登録</h1>

        <?php include COMPONENT_DIR . 'ErrorMessage.php' ?>

        <form method="post" class="space-y-4 bg-white p-6 shadow rounded">
            <div>
                <label class="block mb-1">商品コード</label>
                <input type="text" name="code" required class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">商品名</label>
                <input type="text" name="name" required class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">価格</label>
                <input type="number" name="price" required class="w-full border p-2 rounded">
            </div>
            <div class="flex justify-between">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">登録</button>
                <a href="products/" class="block gray-blue-500 text-gray-800 px-4 py-2 border rounded">キャンセル</a>
            </div>
        </form>
    </main>
</body>

</html>