document.addEventListener("DOMContentLoaded", function () {
  const tabBtns = document.querySelectorAll(".tab-btn");
  const tabContents = document.querySelectorAll(".tab-content");

  tabBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      tabBtns.forEach((b) => {
        b.classList.remove("text-[#ef4444]", "font-semibold");
        b.classList.add("text-gray-500", "font-medium");
        b.querySelector(".tab-indicator").classList.remove("bg-[#ef4444]");
        b.querySelector(".tab-indicator").classList.add("bg-transparent");
      });

      tabContents.forEach((c) => c.classList.add("hidden"));

      btn.classList.remove("text-gray-500", "font-medium");
      btn.classList.add("text-[#ef4444]", "font-semibold");
      btn.querySelector(".tab-indicator").classList.remove("bg-transparent");
      btn.querySelector(".tab-indicator").classList.add("bg-[#ef4444]");

      const targetId = "content-" + btn.getAttribute("data-target");
      document.getElementById(targetId).classList.remove("hidden");
    });
  });
});

function incrementQty(maxStok) {
  const input = document.getElementById("qty-input");
  if (parseInt(input.value) < maxStok) {
    input.value = parseInt(input.value) + 1;
  }
}

function decrementQty() {
  const input = document.getElementById("qty-input");
  if (parseInt(input.value) > 1) {
    input.value = parseInt(input.value) - 1;
  }
}

const formAddCart = document.getElementById("form-add-cart");
if (formAddCart) {
  formAddCart.addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this;
    const btn = document.getElementById("btn-add-cart");
    const textBtn = document.getElementById("text-add-cart");
    const iconDefault = document.getElementById("icon-cart-default");
    const iconSuccess = document.getElementById("icon-cart-success");
    const alertBox = document.getElementById("ajax-alert");
    const alertText = document.getElementById("ajax-alert-text");

    const formData = new FormData(form);

    btn.disabled = true;
    btn.classList.add("opacity-75", "cursor-not-allowed");

    alertBox.classList.add("hidden");
    alertBox.classList.remove("flex");

    fetch(form.action, {
      method: "POST",
      body: formData,
      headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then(async (response) => {
        const rawText = await response.text();
        let data;

        try {
          data = JSON.parse(rawText);
        } catch (e) {
          throw {
            status: 500,
            message: "Respons server tidak valid.",
          };
        }

        if (!response.ok) {
          throw {
            status: response.status,
            data: data,
          };
        }

        return data;
      })
      .then((data) => {
        btn.disabled = false;
        btn.classList.remove("opacity-75", "cursor-not-allowed");

        btn.classList.remove("bg-[#ef4444]", "hover:bg-red-600");
        btn.classList.add("bg-[#10b981]", "hover:bg-[#059669]");
        textBtn.textContent = "Ditambahkan!";

        iconDefault.classList.add("hidden");
        iconSuccess.classList.remove("hidden");

        const badge = document.getElementById("nav-cart-badge");
        if (badge) {
          badge.textContent = data.cart_count;
          badge.classList.remove("hidden");
          badge.classList.add("flex");
          badge.classList.add("scale-150");
          setTimeout(() => badge.classList.remove("scale-150"), 300);
        }

        setTimeout(() => {
          btn.classList.add("bg-[#ef4444]", "hover:bg-red-600");
          btn.classList.remove("bg-[#10b981]", "hover:bg-[#059669]");
          textBtn.textContent = "Tambah ke Keranjang";
          iconDefault.classList.remove("hidden");
          iconSuccess.classList.add("hidden");
        }, 2500);
      })
      .catch((error) => {
        btn.disabled = false;
        btn.classList.remove("opacity-75", "cursor-not-allowed");

        if (error.status === 401) {
          window.location.href = error.data.redirect;
        } else if (error.status === 400) {
          alertText.textContent = error.data?.message || "Gagal menambahkan produk.";
          alertBox.classList.remove("hidden");
          alertBox.classList.add("flex");
          window.scrollTo({
            top: 0,
            behavior: "smooth",
          });
        } else {
          console.error("AJAX System Error:", error);
          alert("Terjadi kesalahan koneksi server.");
        }
      });
  });
}
