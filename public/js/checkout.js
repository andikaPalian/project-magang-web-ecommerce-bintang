let ongkirTerpilih = 50000;
let diskonVoucher = 0;

const formatRupiah = (angka) => new Intl.NumberFormat("id-ID").format(angka);

const voucherModal = document.getElementById("listVoucherModal");
const voucherModalBox = voucherModal ? voucherModal.querySelector(".modal-box") : null;

function openVoucherModal() {
  if (!voucherModal) return;
  voucherModal.classList.remove("hidden");
  voucherModal.classList.add("flex");
  setTimeout(() => {
    voucherModal.classList.remove("opacity-0");
    voucherModalBox.classList.remove("translate-y-10");
  }, 10);
  document.body.style.overflow = "hidden";
}

function closeVoucherModal() {
  if (!voucherModal) return;
  voucherModal.classList.add("opacity-0");
  voucherModalBox.classList.add("translate-y-10");
  setTimeout(() => {
    voucherModal.classList.add("hidden");
    voucherModal.classList.remove("flex");
  }, 300);
  document.body.style.overflow = "auto";
}

function pilihVoucher(code) {
  closeVoucherModal();
  document.getElementById("voucher-input").value = code;
  applyVoucher();
}

function updateOngkir(ongkir, methodName) {
  ongkirTerpilih = parseInt(ongkir);
  document.getElementById("display-ongkir").textContent = "Rp " + formatRupiah(ongkirTerpilih);
  document.getElementById("input-shipping-method-name").value = methodName;
  kalkulasiTotal();
}

function kalkulasiTotal() {
  let totalAkhir = subtotalBayar - diskonVoucher;
  if (totalAkhir < 0) totalAkhir = 0;
  totalAkhir += ongkirTerpilih;

  document.getElementById("display-total-bayar").textContent = "Rp " + formatRupiah(totalAkhir);
}

function applyVoucher() {
  const codeInput = document.getElementById("voucher-input").value.trim();
  const msgContainer = document.getElementById("voucher-msg-container");
  const msgBox = document.getElementById("voucher-msg");
  const btn = document.getElementById("btn-apply-voucher");

  msgContainer.classList.remove(
    "hidden",
    "bg-[#A6FAAE]",
    "bg-[#FF5757]",
    "text-black",
    "text-white",
  );

  if (!codeInput) {
    msgContainer.classList.add("bg-[#FF5757]", "text-white");
    msgBox.textContent = "KODE VOUCHER TIDAK BOLEH KOSONG!";
    return;
  }

  btn.textContent = "WAIT...";
  btn.disabled = true;

  const formData = new FormData();
  formData.append("voucher_code", codeInput);
  formData.append("subtotal", subtotalBayar);

  fetch(BASEURL + "/checkout/validateVoucher", {
    method: "POST",
    headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
    body: formData,
  })
    .then(async (response) => {
      const rawText = await response.text();
      let jsonResponse;
      try {
        jsonResponse = JSON.parse(rawText);
      } catch (e) {
        throw { status: 500, message: "Terjadi kesalahan respon server." };
      }
      return jsonResponse;
    })
    .then((data) => {
      if (data.status === "success") {
        diskonVoucher = data.discount_value;

        document.getElementById("input-voucher-id").value = data.voucher_id;

        document.getElementById("voucher-code-display").textContent = data.voucher_code;
        document.getElementById("display-voucher-diskon").textContent =
          "- Rp " + formatRupiah(diskonVoucher);
        document.getElementById("voucher-discount-container").classList.remove("hidden");
        document.getElementById("voucher-discount-container").classList.add("flex");

        msgContainer.classList.add("bg-[#A6FAAE]", "text-black");
        msgBox.textContent = data.message;

        document.getElementById("voucher-input").readOnly = true;
        document.getElementById("voucher-input").classList.add("bg-gray-200", "text-gray-500");

        btn.textContent = "APPLIED";
        btn.classList.remove(
          "bg-black",
          "text-white",
          "hover:-translate-y-1",
          "hover:shadow-[6px_6px_0_0_#000]",
        );
        btn.classList.add("bg-[#A6FAAE]", "text-black", "cursor-not-allowed");

        kalkulasiTotal();
      } else {
        msgContainer.classList.add("bg-[#FF5757]", "text-white");
        msgBox.textContent = data.message;

        btn.textContent = "APPLY";
        btn.disabled = false;
      }
    })
    .catch((err) => {
      btn.textContent = "APPLY";
      btn.disabled = false;
      msgContainer.classList.add("bg-[#FF5757]", "text-white");
      msgBox.textContent = "GAGAL TERHUBUNG KE SERVER!";
    });
}
