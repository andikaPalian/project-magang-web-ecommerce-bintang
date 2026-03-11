document.addEventListener("DOMContentLoaded", function () {
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

      btn.disabled = true;
      btn.classList.add("opacity-50", "cursor-not-allowed");
      alertBox.classList.add("hidden");

      fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
      })
        .then((res) => res.json())
        .then((data) => {
          btn.disabled = false;
          btn.classList.remove("opacity-50", "cursor-not-allowed", "bg-[#FFE600]");
          btn.classList.add("bg-[#A6FAAE]");
          textBtn.textContent = "DITAMBAHKAN!";
          iconDefault.classList.add("hidden");
          iconSuccess.classList.remove("hidden");

          updateCartBadge(data.cart_count);

          setTimeout(() => {
            btn.classList.add("bg-[#FFE600]");
            btn.classList.remove("bg-[#A6FAAE]");
            textBtn.textContent = "ADD TO LOADOUT";
            iconDefault.classList.remove("hidden");
            iconSuccess.classList.add("hidden");
          }, 2500);
        })
        .catch((err) => console.error(err));
    });
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

      fetch(currentForm.action, {
        method: "POST",
        body: new FormData(currentForm),
        headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
      })
        .then((res) => res.json())
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
        .catch((err) => alert("Gagal menambahkan produk."));
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
