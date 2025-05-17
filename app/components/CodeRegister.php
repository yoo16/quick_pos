<section id="code-register" class="hidden p-2">
    <div id="display" class="w-full text-left text-2xl mb-2 px-2 py-2 rounded bg-gray-50">
        0
    </div>
    <div class="grid grid-cols-4 gap-1">
        <!-- 数字 & 操作ボタン -->
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('7')" type="button">7</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('8')" type="button">8</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('9')" type="button">9</button>
        <button class="bg-red-500 text-white hover:bg-red-600 text-xl font-medium rounded aspect-square w-full" onclick="clearAll()" type="button">AC</button>

        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('4')" type="button">4</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('5')" type="button">5</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('6')" type="button">6</button>
        <button class="bg-sky-500 text-white hover:bg-sky-600 text-xl font-medium rounded aspect-square w-full"
            onclick="addItem()" type="button">追加</button>

        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('1')" type="button">1</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('2')" type="button">2</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('3')" type="button">3</button>
        <button></button>

        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('0')" type="button">0</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('00')" type="button">00</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('000')" type="button">000</button>
        <button class="bg-gray-100 hover:bg-gray-200 text-xl font-medium rounded aspect-square w-full" onclick="inputCode('0000')" type="button">0000</button>
    </div>
</section>