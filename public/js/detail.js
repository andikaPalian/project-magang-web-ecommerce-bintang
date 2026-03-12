document.addEventListener("DOMContentLoaded", function () {
  // === LOGIKA TAB ===
  const tabBtns = document.querySelectorAll(".tab-btn");
  const tabContents = document.querySelectorAll(".tab-content");

  if (tabBtns.length > 0) {
    tabBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        tabBtns.forEach((b) => {
          b.classList.remove("bg-[#FFE600]", "shadow-[4px_-4px_0_0_#000]", "translate-y-1", "z-10");
          b.classList.add("bg-white");
        });
        tabContents.forEach((c) => c.classList.add("hidden"));

        btn.classList.remove("bg-white");
        btn.classList.add("bg-[#FFE600]", "shadow-[4px_-4px_0_0_#000]", "translate-y-1", "z-10");

        const targetId = "content-" + btn.getAttribute("data-target");
        document.getElementById(targetId).classList.remove("hidden");
      });
    });
  }

  const formAddCart = document.getElementById("form-add-cart");
  const btnAddCart = document.getElementById("btn-add-cart");
  const btnBuyNow = document.getElementById("btn-buy-now");

  if (formAddCart) {
    if (btnAddCart) {
      btnAddCart.addEventListener("click", function (e) {
        e.preventDefault(); // Jangan refresh halaman

        const textBtn = document.getElementById("text-add-cart");
        const iconDefault = document.getElementById("icon-cart-default");
        const iconSuccess = document.getElementById("icon-cart-success");
        const alertBox = document.getElementById("ajax-alert");

        btnAddCart.disabled = true;
        btnAddCart.classList.add("opacity-50", "cursor-not-allowed");
        if (alertBox) alertBox.classList.add("hidden");

        const formData = new FormData(formAddCart);
        formData.append("action", "add_to_cart");

        // URL Harus mengandung parameter ?ajax=1
        const actionUrl = formAddCart.action.includes("?ajax=1")
          ? formAddCart.action
          : formAddCart.action + "?ajax=1";

        fetch(actionUrl, {
          method: "POST",
          body: formData,
          headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
        })
          .then(async (res) => {
            if (res.status === 401) {
              const data = await res.json();
              window.location.href = data.redirect;
              throw new Error("Unauthorized");
            }
            return res.json();
          })
          .then((data) => {
            btnAddCart.disabled = false;
            btnAddCart.classList.remove("opacity-50", "cursor-not-allowed", "bg-[#FFE600]");
            btnAddCart.classList.add("bg-[#A6FAAE]");
            if (textBtn) textBtn.textContent = "DITAMBAHKAN!";
            if (iconDefault) iconDefault.classList.add("hidden");
            if (iconSuccess) iconSuccess.classList.remove("hidden");

            updateCartBadge(data.cart_count);

            setTimeout(() => {
              btnAddCart.classList.add("bg-[#FFE600]");
              btnAddCart.classList.remove("bg-[#A6FAAE]");
              if (textBtn) textBtn.textContent = "ADD TO CART";
              if (iconDefault) iconDefault.classList.remove("hidden");
              if (iconSuccess) iconSuccess.classList.add("hidden");
            }, 2500);
          })
          .catch((err) => {
            if (err.message !== "Unauthorized") console.error(err);
            btnAddCart.disabled = false;
            btnAddCart.classList.remove("opacity-50", "cursor-not-allowed");
          });
      });
    }

    if (btnBuyNow) {
      btnBuyNow.addEventListener("click", function (e) {
        e.preventDefault();

        const actionInput = document.createElement("input");
        actionInput.type = "hidden";
        actionInput.name = "action";
        actionInput.value = "buy_now";
        formAddCart.appendChild(actionInput);

        formAddCart.submit();
      });
    }
  }

  const ajaxSimilarForms = document.querySelectorAll(".ajax-add-cart");
  ajaxSimilarForms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const currentForm = this;
      const btn = currentForm.querySelector(".btn-submit");
      const iconCart = currentForm.querySelector(".icon-cart");
      const iconSuccess = currentForm.querySelector(".icon-success");

      btn.disabled = true;
      btn.classList.add("opacity-50");

      const actionUrl = currentForm.action.includes("?ajax=1")
        ? currentForm.action
        : currentForm.action + "?ajax=1";

      fetch(actionUrl, {
        method: "POST",
        body: new FormData(currentForm),
        headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
      })
        .then(async (res) => {
          if (res.status === 401) {
            const data = await res.json();
            window.location.href = data.redirect;
            throw new Error("Unauthorized");
          }
          return res.json();
        })
        .then((data) => {
          btn.disabled = false;
          btn.classList.remove("opacity-50", "bg-white");
          btn.classList.add("bg-[#A6FAAE]");
          if (iconCart) iconCart.classList.add("hidden");
          if (iconSuccess) iconSuccess.classList.remove("hidden");

          updateCartBadge(data.cart_count);

          setTimeout(() => {
            btn.classList.remove("bg-[#A6FAAE]");
            btn.classList.add("bg-white");
            if (iconCart) iconCart.classList.remove("hidden");
            if (iconSuccess) iconSuccess.classList.add("hidden");
          }, 2000);
        })
        .catch((err) => {
          if (err.message !== "Unauthorized") alert("Gagal menambahkan produk.");
          btn.disabled = false;
          btn.classList.remove("opacity-50");
        });
    });
  });

  function updateCartBadge(count) {
    const badge = document.getElementById("nav-cart-badge");
    if (badge) {
      badge.textContent = count;
      badge.classList.remove("hidden");
      badge.classList.add("flex", "scale-150");
      setTimeout(() => badge.classList.remove("scale-150"), 300);
    }
  }
});

window.incrementQty = (max) => {
  const input = document.getElementById("qty-input");
  if (input && parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
};
window.decrementQty = () => {
  const input = document.getElementById("qty-input");
  if (input && parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
};
