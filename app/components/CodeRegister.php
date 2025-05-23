<section id="code-register" class="p-2">
    <h2 class="text-center font-bold p-2">コード入力</h2>
    <div id="display" class="w-full text-left text-sm mb-2 px-2 py-2 rounded bg-gray-50">
        0
    </div>
    <div class="grid grid-cols-5 gap-1">
        <!-- 数字 & 操作ボタン -->
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('7')" type="button">7</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('8')" type="button">8</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('9')" type="button">9</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('0000')" type="button">0000</button>
        <button class="px-3 py-2 bg-sky-500 text-white text-sm rounded"
            onclick="addItem()" type="button">追加</button>

        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('4')" type="button">4</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('5')" type="button">5</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('6')" type="button">6</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('00')" type="button">00</button>
        <button class="px-3 py-2 bg-red-500 text-white text-sm rounded" onclick="clearAll()" type="button">AC</button>

        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('1')" type="button">1</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('2')" type="button">2</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('3')" type="button">3</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-sm font-medium rounded aspect-square w-full" onclick="inputCode('0')" type="button">0</button>
        <button></button>

    </div>
</section>