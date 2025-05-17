const paymentForm = document.getElementById("payment-form");
const display = document.getElementById("display");
const totalDisplay = document.getElementById("total-display");
const calculateDisplay = document.getElementById("calculate-display");
const redordsDisplay = document.getElementById("records-display");
const listContainer = document.getElementById("item-list");
let scanned = false; // 連続読み込み防止

let current = "";
let total = 0;
const TAX_RATE = 0.1;
let itemList = []; // [{ price: 1000, quantity: 1 }, ...]

document.addEventListener("DOMContentLoaded", () => {
    loadItemsFromLocalStorage();
});

/**
 * ディスプレイの値を更新する関数
 * @param {string} value - 表示する値。nullの場合はcurrentディスプレイ
 * @param {*} value 
 */
function updateDisplay(value = null) {
    display.textContent = value !== null ? value : current || "0";
}

/**
 * コードを追加する関数
 * @param {*} value 
 */
function inputCode(value) {
    current += value;
    updateDisplay();
}

/**
 * 演算子を追加する関数
 * @param {*} operator 
 */
function clearAll() {
    current = "";
    updateDisplay();
}

/**
 * アイテムを追加する関数
 * @returns 
 */
function addItem() {
    if (!current) return;
    addItemByCode(current);
    current = "";
    updateDisplay();
}

/**
 * API経由でアイテムを追加
 * @returns 
 */
async function addItemByCode(code) {
    try {
        const uri = `api/products/find_by_code.php?code=${encodeURIComponent(code)}`;
        const response = await fetch(uri);
        if (!response.ok) {
            output.textContent = "通信エラー";
            return;
        }

        const product = await response.json();
        if (!product || !product.id) {
            output.textContent = "商品が見つかりません";
            return;
        }

        // 既に同じコードの商品が存在するかチェック
        const existingItem = itemList.find(item => item.code === product.code);
        if (existingItem) {
            // 既存商品
            if (confirm("この商品は既にカートに入っています。数量を追加しますか？")) {
                existingItem.quantity++;
            }
        } else {
            // 新規商品
            itemList.push({
                id: product.id,
                code: product.code,
                name: product.name,
                price: product.price,
                quantity: 1
            });
            output.textContent = "";
        }

        updateRecordsDisplay();
    } catch (error) {
        console.error("エラー:", error);
        output.textContent = "商品情報の取得に失敗しました";
    }
}

/**
 * アイテムリストを表示する関数
 */
function renderItemList() {
    listContainer.innerHTML = "";

    itemList.forEach((item, index) => {
        const subtotal = item.price * item.quantity;
        const li = document.createElement("li");
        li.className = "grid grid-cols-4 gap-2 items-center py-2 border-b text-xl";

        li.innerHTML = `
            <!-- 商品名 -->
            <div class="col-span-1 text-left px-2">${item.name}</div>

            <!-- 価格 × 数量 -->
            <div class="col-span-1">${item.price.toFixed()} × ${item.quantity}</div>

            <!-- 小計 -->
            <div class="col-span-1 text-xs text-gray-500">小計：${subtotal.toFixed()} 円</div>

            <!-- 操作ボタン -->
            <div class="col-span-1 flex space-x-1">
                <button onclick="changeQuantity(${index}, -1)" class="p-2 px-3 bg-gray-300 rounded">−</button>
                <button onclick="changeQuantity(${index}, 1)" class="p-2 px-3 bg-gray-300 rounded">＋</button>
                <button onclick="removeItem(${index})" class="p-2 px-3 bg-red-400 text-white rounded">削除</button>
            </div>
        `;


        listContainer.appendChild(li);
    });
}

/**
 * アイテムの数量を変更する関数
 * @param {*} index 
 * @param {*} delta 
 */
function changeQuantity(index, delta) {
    const item = itemList[index];
    item.quantity += delta;

    if (item.quantity < 1) {
        item.quantity = 1;
    }

    // 商品リストを更新
    updateRecordsDisplay();
}

function removeItem(index) {
    itemList.splice(index, 1); // 指定のアイテムを削除
    renderItemList(); // 再描画
    hideSalesArea();  // 表示更新
    totalDisplay.value = ""; // 合計表示リセット

    updateRecordsDisplay();
}

/**
 * 税込み計算を行う関数
 */
function calculateTax() {
    const totalWithoutTax = itemList.reduce((sum, item) => sum + item.price * item.quantity, 0);
    const taxed = (totalWithoutTax * (1 + TAX_RATE)).toFixed();

    total = parseFloat(taxed);
    totalDisplay.value = total.toFixed();

    if (total > 0) {
        showSalesArea();
    } else {
        hideSalesArea();
    }
}

function payment(e) {
    e.preventDefault(); // ←ここでエラーが起きなくなる
    clearItemsFromLocalStorage();

    // ここでフォームを送信する場合（手動送信）
    e.target.submit();
}

function updateRecordsDisplay() {
    // LocalStorageに保存
    saveItemsToLocalStorage();

    // 商品リストを更新
    renderItemList();
    // 計上非表示
    hideSalesArea();
    if (itemList.length > 0) {
        showCalculateDisplay();
    } else {
        hideCalculateDisplay();
    }
}

function saveItemsToLocalStorage() {
    localStorage.setItem("itemList", JSON.stringify(itemList));
}

function loadItemsFromLocalStorage() {
    const data = localStorage.getItem("itemList");
    if (data) {
        itemList = JSON.parse(data);
        updateRecordsDisplay();
    }
}

function clearItemsFromLocalStorage() {
    localStorage.removeItem("itemList");
    itemList = [];
    updateRecordsDisplay();
}

function showCalculateDisplay() {
    calculateDisplay.classList.remove("hidden");
}

function hideCalculateDisplay() {
    calculateDisplay.classList.add("hidden");
}

function showSalesArea() {
    redordsDisplay.classList.remove("hidden");
}

function hideSalesArea() {
    redordsDisplay.classList.add("hidden");
}

function showCodeRegister() {
    const codeRegister = document.getElementById("code-register");
    codeRegister.classList.remove("hidden");
}

function hideCodeRegister() {
    const codeRegister = document.getElementById("code-register");
    codeRegister.classList.add("hidden");
}