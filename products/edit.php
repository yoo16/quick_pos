<?php
require_once '../app.php';

use App\Services\QrCodeService;

$id = (int)($_GET['id'] ?? 0);

// 商品取得
$productService = new ProductService();
$product = $productService->find($id);

// 商品が存在しなければリダイレクト
if (!$product->id) {
    header('Location: ./');
    exit;
}

// 更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posts = $_POST;
    $productService = new ProductService();
    $existingProduct = $productService->findByCode($posts['code']);
    if ($existingProduct && $existingProduct->id !== $id) {
        $error = 'この商品コードはすでに使用されています。';
    } else {
        // 商品情報を更新
        $product = new Product($_POST);
        // 商品更新
        $productService->update($id, $product);

        // QRコード生成
        $service = new QrCodeService();
        $service->generate($posts['code']);

        header('Location: ./');
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<?php include COMPONENT_DIR . 'Head.php'; ?>

<body>
    <?php include COMPONENT_DIR . 'Nav.php'; ?>

    <main class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">商品編集</h1>

        <?php include COMPONENT_DIR . 'ErrorMessage.php' ?>

        <form method="post" class="space-y-4 bg-white p-6 shadow rounded">
            <div>
                <label class="block mb-1">商品コード</label>
                <input type="text" name="code" required value="<?= htmlspecialchars($product->code) ?>" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">商品名</label>
                <input type="text" name="name" required value="<?= htmlspecialchars($product->name) ?>" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">価格</label>
                <input type="number" name="price" required value="<?= htmlspecialchars($product->price) ?>" class="w-full border p-2 rounded">
            </div>
            <div class="flex justify-between">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">更新</button>
                <a href="products/" class="block gray-blue-500 text-gray-800 px-4 py-2 border rounded">キャンセル</a>
            </div>
        </form>
    </main>
</body>

</html>