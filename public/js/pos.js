let cart = [];
let selectedPaymentMethod = "CASH";
let currentTotal = 0;

function formatRupiah(number) {
  return new Intl.NumberFormat("id-ID").format(number);
}

function addToCart(id, name, price, maxStock) {
  let existingItem = cart.find((item) => item.id === id);
  if (existingItem) {
    if (existingItem.qty < maxStock) {
      existingItem.qty++;
    } else {
      alert("SYS_ERROR: STOK GUDANG TIDAK MENCUKUPI!");
    }
  } else {
    cart.push({
      id: id,
      product_id: id,
      name: name,
      price: price,
      qty: 1,
      maxStock: maxStock,
    });
  }
  renderCart();
}

function updateQty(id, delta) {
  let item = cart.find((item) => item.id === id);
  if (item) {
    let newQty = item.qty + delta;
    if (newQty > 0 && newQty <= item.maxStock) {
      item.qty = newQty;
    } else if (newQty === 0) {
      cart = cart.filter((i) => i.id !== id);
    } else if (newQty > item.maxStock) {
      alert("SYS_ERROR: MELEBIHI BATAS STOK!");
    }
  }
  renderCart();
}

function removeItem(id) {
  cart = cart.filter((i) => i.id !== id);
  renderCart();
}

function clearCart() {
  if (cart.length > 0 && confirm("HAPUS SEMUA ISI KERANJANG?")) {
    cart = [];
    renderCart();
  }
}

function renderCart() {
  const container = document.getElementById("cartContainer");
  const totalEl = document.getElementById("totalPayable");

  if (cart.length === 0) {
    container.innerHTML = `
          <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-50">
              <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
              <p class="font-black text-[10px]">CART IS EMPTY</p>
          </div>
      `;
    totalEl.innerText = "Rp 0";
    return;
  }

  let html = "";
  let total = 0;

  cart.forEach((item) => {
    let itemTotal = item.price * item.qty;
    total += itemTotal;

    html += `
      <div class="bg-white border-4 border-black p-3 shadow-[4px_4px_0_0_#000] relative group">
          <button onclick="removeItem(${item.id})" class="absolute top-1 right-2 text-gray-400 hover:text-[#FF5757] font-black text-xs">X</button>
          <p class="text-[10px] font-black uppercase line-clamp-1 pr-4 mb-1">${item.name}</p>
          <p class="text-[9px] font-bold text-[#2563EB] mb-3">Rp ${formatRupiah(item.price)}</p>
          
          <div class="flex justify-between items-center">
              <div class="flex items-center border-2 border-black bg-gray-50">
                  <button onclick="updateQty(${item.id}, -1)" class="w-6 h-6 flex items-center justify-center font-black hover:bg-gray-200 border-r-2 border-black">-</button>
                  <span class="w-8 text-center text-[10px] font-black">${item.qty}</span>
                  <button onclick="updateQty(${item.id}, 1)" class="w-6 h-6 flex items-center justify-center font-black hover:bg-gray-200 border-l-2 border-black">+</button>
              </div>
              <span class="font-black text-xs">Rp ${formatRupiah(itemTotal)}</span>
          </div>
      </div>
      `;
  });

  container.innerHTML = html;
  totalEl.innerText = "Rp " + formatRupiah(total);
}

function setPaymentMethod(method) {
  selectedPaymentMethod = method;
  ["CASH", "QRIS", "DEBIT"].forEach((m) => {
    let btn = document.getElementById("btn-" + m);
    btn.classList.remove("bg-black", "text-white");
    btn.classList.add("bg-white", "text-black");
  });
  let activeBtn = document.getElementById("btn-" + method);
  activeBtn.classList.remove("bg-white", "text-black");
  activeBtn.classList.add("bg-black", "text-white");
}

function processCheckout() {
  if (cart.length === 0) {
    alert("SYS_ERROR: KERANJANG KOSONG!");
    return;
  }

  currentTotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
  const modalContent = document.getElementById("modalContent");
  const modalTitle = document.getElementById("modalTitle");
  const btnConfirm = document.getElementById("btnConfirmPayment");

  document.getElementById("paymentModalOverlay").classList.remove("hidden");
  setTimeout(() => document.getElementById("paymentModalBox").classList.remove("scale-95"), 10);

  if (selectedPaymentMethod === "QRIS") {
    modalTitle.innerText = "QRIS_PAYMENT_GATEWAY";
    modalContent.innerHTML = `
          <div class="text-center flex flex-col items-center">
              <p class="text-[10px] font-black text-gray-500 mb-4 uppercase">Instruksikan Pelanggan Scan Barcode</p>
              <div class="w-48 h-48 border-4 border-black bg-white p-2 mb-6 shadow-[6px_6px_0_0_#000]">
                  <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=TIMART_${currentTotal}_${Date.now()}" alt="QRIS" class="w-full h-full object-contain">
              </div>
              <p class="text-[10px] font-black uppercase text-gray-500 mb-1">TOTAL_DIBAYAR</p>
              <p class="text-4xl font-black text-[#2563EB]">Rp ${formatRupiah(currentTotal)}</p>
          </div>
      `;
    btnConfirm.innerText = "VERIFY_QRIS_SUCCESS";
    btnConfirm.disabled = false;
  } else if (selectedPaymentMethod === "CASH") {
    modalTitle.innerText = "CASH_REGISTER";
    modalContent.innerHTML = `
          <div class="flex flex-col gap-5">
              <div class="flex justify-between items-end border-b-4 border-black pb-3">
                  <span class="text-xs font-black">TOTAL_TAGIHAN:</span>
                  <span class="text-2xl font-black text-[#FF5757]">Rp ${formatRupiah(currentTotal)}</span>
              </div>
              <div>
                  <label class="text-[10px] font-black text-gray-500 block mb-2">UANG_DITERIMA (CASH TENDERED):</label>
                  <input type="number" id="cashInput" class="w-full border-4 border-black px-4 py-4 font-black text-2xl shadow-[6px_6px_0_0_#000] outline-none focus:bg-gray-50 transition-colors" oninput="calculateChange()" placeholder="0">
              </div>
              <div class="flex justify-between items-end bg-[#FFE600] p-4 border-4 border-black shadow-[4px_4px_0_0_#000]">
                  <span class="text-xs font-black">KEMBALIAN (CHANGE):</span>
                  <span class="text-2xl font-black text-black" id="changeOutput">Rp 0</span>
              </div>
          </div>
      `;
    btnConfirm.innerText = "COMPLETE_CASH_TRX";
    btnConfirm.disabled = true;
    setTimeout(() => document.getElementById("cashInput").focus(), 100);
  } else if (selectedPaymentMethod === "DEBIT") {
    modalTitle.innerText = "EDC_TERMINAL_SYNC";
    modalContent.innerHTML = `
          <div class="text-center flex flex-col items-center py-4">
              <svg class="w-20 h-20 mb-6 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
              <p class="text-xs font-black mb-2 uppercase">Menunggu Proses Mesin EDC...</p>
              <p class="text-3xl font-black text-black mb-6">Rp ${formatRupiah(currentTotal)}</p>
              <p class="text-[10px] font-bold text-gray-500 bg-white border-2 border-black p-3 text-left w-full shadow-[2px_2px_0_0_#000]">
                  > Gesek / Masukkan kartu ke EDC.<br>
                  > Input nominal dan minta PIN.<br>
                  > Tekan tombol HANYA JIKA struk "APPROVE" keluar.
              </p>
          </div>
      `;
    btnConfirm.innerText = "CONFIRM_EDC_APPROVE";
    btnConfirm.disabled = false;
  }
}

function calculateChange() {
  let inputEl = document.getElementById("cashInput");
  let outputEl = document.getElementById("changeOutput");
  let btnConfirm = document.getElementById("btnConfirmPayment");

  let cashGiven = parseInt(inputEl.value) || 0;
  let change = cashGiven - currentTotal;

  if (change >= 0) {
    outputEl.innerText = "Rp " + formatRupiah(change);
    outputEl.classList.remove("text-[#FF5757]");
    btnConfirm.disabled = false;
  } else {
    outputEl.innerText = "UANG KURANG!";
    outputEl.classList.add("text-[#FF5757]");
    btnConfirm.disabled = true;
  }
}

function closeModal() {
  document.getElementById("paymentModalBox").classList.add("scale-95");
  setTimeout(() => {
    document.getElementById("paymentModalOverlay").classList.add("hidden");
    document.getElementById("modalHeader").classList.replace("bg-[#4ADE80]", "bg-[#FFE600]");
  }, 100);
}

function executePayment() {
  let btn = document.getElementById("btnConfirmPayment");
  btn.innerHTML = "UPLOADING_DATA...";
  btn.disabled = true;

  const mappedCart = cart.map((item) => ({
    id: item.id,
    product_id: item.product_id,
    name: item.name,
    price: item.price,
    qty: item.qty,
    quantity: item.qty,
  }));

  const payload = {
    cart: mappedCart,
    total_payable: currentTotal,
    payment_method: selectedPaymentMethod,
  };

  fetch(`${APP_BASE_URL}/admintoko/processCheckout`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: JSON.stringify(payload),
  })
    .then(async (response) => {
      if (!response.ok) {
        let errText = await response.text();
        throw new Error(`HTTP ${response.status}: ${errText.substring(0, 100)}...`);
      }
      return response.json();
    })
    .then((data) => {
      if (data.status === "success") {
        document.getElementById("modalHeader").classList.replace("bg-[#FFE600]", "bg-[#4ADE80]");
        document.getElementById("modalTitle").innerText = "TRANSACTION_SUCCESS";
        document.getElementById("modalContent").innerHTML = `
              <div class="text-center py-8">
                  <div class="w-20 h-20 bg-[#4ADE80] border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
                      <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                  </div>
                  <h3 class="text-2xl font-black text-black mb-2">PAYMENT ACCEPTED</h3>
                  <p class="text-xs font-bold text-gray-500 uppercase">Data telah dicatat ke server.</p>
              </div>
          `;
        document.getElementById("modalFooter").innerHTML = `
              <button onclick="closeModal(); cart=[]; renderCart();" class="w-full bg-black text-white border-4 border-black py-4 font-black text-lg shadow-[6px_6px_0_0_#000] hover:bg-gray-800 transition-all">
                  START_NEW_TRANSACTION
              </button>
          `;
      } else {
        alert("DATABASE_ERROR: " + data.message);
        closeModal();
      }
    })
    .catch((error) => {
      console.error("SERVER FATAL ERROR:", error);
      alert(
        `SISTEM TERPUTUS! Cek Network/Console (F12) untuk melihat error PHP.\nPesan System: ${error.message}`,
      );
      closeModal();
    });
}

document.getElementById("searchInput").addEventListener("keyup", function (e) {
  let keyword = e.target.value.toLowerCase();
  let cards = document.querySelectorAll(".product-card");
  cards.forEach((card) => {
    let name = card.getAttribute("data-name");
    if (name.includes(keyword)) {
      card.style.display = "flex";
    } else {
      card.style.display = "none";
    }
  });
});
