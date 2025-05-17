<section class="p-3 text-center">
    <div id="output" class="text-gray-700 mb-4 font-bold text-lg">
        <?= $message ?>
    </div>

    <ul id="item-list" class="mt-6 text-sm text-gray-700 py-3 space-y-1">
        <!-- JavaScriptで動的に表示される -->
    </ul>

    <form id="payment-form" action="update.php" method="post" onsubmit="payment(event)">
        <div class="grid grid-cols gap-3 mb-6">
            <div id="calculate-display" class="hidden">
                <a onclick="calculateTax()"
                    class="block bg-sky-500 w-full text-white text-lg font-bold py-3 rounded text-center hover:bg-sky-600 transition">
                    確定
                </a>
            </div>

            <div id="records-display" class="hidden">
                <div class="text-gray-700 mb-4 font-bold text-lg">
                    売上計上しますか？
                </div>
                <div class="text-2xl py-4 flex justify-end items-center space-x-2">
                    <input
                        type="text"
                        id="total-display"
                        name="price"
                        class="text-right w-40 px-2 py-1"
                        readonly />
                    <span class="text-sm text-gray-500">円（税込）</span>
                </div>
                <div class="space-y-6">
                    <button
                        type="submit"
                        class="bg-green-500 text-white text-lg font-bold py-3 rounded hover:bg-green-600 transition w-full">
                        計上
                    </button>
                </div>
            </div>
        </div>
    </form>
</section>