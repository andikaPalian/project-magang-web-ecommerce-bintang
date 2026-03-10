document.addEventListener("DOMContentLoaded", function () {
  const formatRupiah = (angka) => new Intl.NumberFormat("id-ID").format(angka);

  const showError = (message) => {
    const errorBox = document.getElementById("ajax-error-alert");
    const errorText = document.getElementById("ajax-error-text");
    if (errorBox && errorText) {
      errorText.textContent = message;
      errorBox.classList.remove("hidden");
      errorBox.classList.add("flex");
      window.scrollTo({ top: 0, behavior: "smooth" });
      setTimeout(() => {
        errorBox.classList.add("hidden");
        errorBox.classList.remove("flex");
      }, 4000);
    }
  };

  const updateSummaryUI = (data) => {
    const navBadge = document.getElementById("nav-cart-badge");
    if (navBadge) {
      navBadge.textContent = data.cart_count;
      if (data.cart_count > 0) {
        navBadge.classList.remove("hidden");
        navBadge.classList.add("flex");
      } else {
        navBadge.classList.add("hidden");
        navBadge.classList.remove("flex");
      }
    }

    if (data.total) {
      document.getElementById("summary-total-harga").textContent =
        "Rp " + formatRupiah(data.total.total_harga);
      document.getElementById("summary-total-bayar").textContent =
        "Rp " + formatRupiah(data.total.total_bayar);

      const diskonContainer = document.getElementById("summary-discount-container");
      if (data.total.harga_diskon > 0) {
        document.getElementById("summary-total-diskon").textContent =
          "- Rp " + formatRupiah(data.total.harga_diskon);
        diskonContainer.classList.remove("hidden");
        diskonContainer.classList.add("flex");
      } else {
        diskonContainer.classList.add("hidden");
        diskonContainer.classList.remove("flex");
      }
    }
  };

  const modal = document.getElementById("custom-confirm-modal");
  const modalBox = modal.querySelector(".modal-box");
  const btnCancel = document.getElementById("btn-cancel-modal");
  const btnConfirm = document.getElementById("btn-confirm-modal");

  let actionToExecute = null;

  const showConfirmModal = (onConfirm) => {
    actionToExecute = onConfirm;
    modal.classList.remove("hidden");
    modal.classList.add("flex");
    setTimeout(() => {
      modal.classList.remove("opacity-0");
      modalBox.classList.remove("translate-y-10");
    }, 10);
  };

  const hideConfirmModal = () => {
    modal.classList.add("opacity-0");
    modalBox.classList.add("translate-y-10");
    setTimeout(() => {
      modal.classList.add("hidden");
      modal.classList.remove("flex");
      actionToExecute = null;
    }, 300);
  };

  btnCancel.addEventListener("click", hideConfirmModal);
  btnConfirm.addEventListener("click", () => {
    if (actionToExecute) actionToExecute();
    hideConfirmModal();
  });

  // ==========================================
  // AJAX UPDATE QTY
  // ==========================================
  const updateForms = document.querySelectorAll(".ajax-update-form");
  updateForms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const btnClicked = e.submitter;
      const actionValue = btnClicked.value;

      const cartId = form.querySelector('input[name="cart_id"]').value;
      const displayQty = document.getElementById("display-qty-" + cartId);
      const inputHiddenQty = document.getElementById("current-qty-" + cartId);

      const formData = new FormData(form);
      formData.append("action", actionValue);

      const executeUpdate = () => {
        const allBtns = form.querySelectorAll("button");
        allBtns.forEach((b) => (b.disabled = true));

        fetch(form.getAttribute("action"), {
          method: "POST",
          body: formData,
          headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
        })
          .then(async (response) => {
            const rawText = await response.text();
            let jsonResponse;
            try {
              jsonResponse = JSON.parse(rawText);
            } catch (e) {
              throw { status: 500, message: "Terjadi kesalahan respon server." };
            }
            if (!response.ok) throw { status: response.status, data: jsonResponse };
            return jsonResponse;
          })
          .then((data) => {
            allBtns.forEach((b) => (b.disabled = false));

            if (data.status === "success") {
              if (data.new_quantity === undefined && actionValue === "decrement") {
                const card = document.getElementById("cart-card-" + cartId);
                card.style.transition = "all 0.3s ease";
                card.style.transform = "scale(0.9) rotate(-2deg)";
                card.style.opacity = "0";
                setTimeout(() => {
                  card.remove();
                  const headerCount = document.getElementById("header-item-count");
                  if (headerCount) headerCount.textContent = data.cart_count + " ITEMS";
                  if (data.cart_count === 0) window.location.reload();
                }, 300);
              } else {
                displayQty.textContent = data.new_quantity;
                inputHiddenQty.value = data.new_quantity;
                displayQty.classList.add("bg-[#FFE600]"); // Efek kedip kuning
                setTimeout(() => displayQty.classList.remove("bg-[#FFE600]"), 200);
              }
              updateSummaryUI(data);
            }
          })
          .catch((error) => {
            allBtns.forEach((b) => (b.disabled = false));
            if (error.status === 401) window.location.href = error.data?.redirect || "/auth";
            else if (error.status === 400)
              showError(error.data?.message || "Gagal mengubah jumlah.");
            else showError("Koneksi ke server terputus.");
          });
      };

      if (actionValue === "decrement" && parseInt(inputHiddenQty.value) <= 1) {
        showConfirmModal(executeUpdate);
      } else {
        executeUpdate();
      }
    });
  });

  const removeForms = document.querySelectorAll(".ajax-remove-form");
  removeForms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      showConfirmModal(() => {
        const btn = form.querySelector("button");
        btn.disabled = true;

        fetch(form.getAttribute("action"), {
          method: "POST",
          headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
        })
          .then(async (response) => {
            const rawText = await response.text();
            let jsonResponse;
            try {
              jsonResponse = JSON.parse(rawText);
            } catch (e) {
              throw { status: 500, message: "Server error." };
            }
            if (!response.ok) throw { status: response.status, data: jsonResponse };
            return jsonResponse;
          })
          .then((data) => {
            if (data.status === "success") {
              const card = form.closest(".cart-item-card");
              card.style.transition = "all 0.3s ease";
              card.style.transform = "scale(0.9) rotate(2deg)";
              card.style.opacity = "0";

              setTimeout(() => {
                card.remove();
                const headerItemCount = document.getElementById("header-item-count");
                if (headerItemCount) headerItemCount.textContent = data.cart_count + " ITEMS";
                updateSummaryUI(data);
                if (data.cart_count <= 0) window.location.reload();
              }, 300);
            }
          })
          .catch((error) => {
            btn.disabled = false;
            if (error.status === 401) window.location.href = "/auth";
            else showError("Gagal menghapus produk dari keranjang.");
          });
      });
    });
  });
});
